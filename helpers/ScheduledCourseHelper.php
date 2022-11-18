<?php

class ScheduledCourseHelper{

    const SCHEDULED_COURSE_BY_ID = "SELECT id, room_id, course_id, from_date, until_date 
                                    FROM scheduledcourse WHERE id = :scheduled_course_id;";

    const SCHEDULED_COURSE_BY_USER = "SELECT scheduledcourse.id as id, scheduledcourse.course_id as course_id, room_id, from_date, until_date FROM scheduledcourse INNER JOIN(
                                        SELECT course_id FROM
                                        groupuser INNER JOIN groupcourse ON groupuser.group_id = groupcourse.group_id
                                        WHERE user_id = :user_id
                                    ) as assignedcourses         
                                    ON assignedcourses.course_id = scheduledcourse.course_id";

    const SCHEDULED_COURSES = "SELECT scheduledcourse.id as 'id', room_id, course_id, Course.name as 'course_name', 
                               Course.type as 'course_type', from_date, until_date 
                                FROM scheduledcourse
                                INNER JOIN Course on scheduledcourse.course_id = Course.id;";

    const SCHEDULED_COURSE_DETAILS = "SELECT scheduledcourse.id as 'scheduled_course_id',  
                                    DATE(from_date) as 'from_date', 
                                    DATE(until_date) as 'until_date',
                                    date_format(from_date, '%H:%i') as 'from_hour',
                                    date_format(until_date, '%H:%i') as 'until_hour',
                                    course_id as 'course_id',
                                    Course.name as 'course_name',
                                    Course.type as 'course_type',
                                    room_id as 'room_id', 
                                    Room.name as 'room_name',
                                    Room.capacity as 'room_capacity'
                                    FROM scheduledcourse
                                    INNER JOIN Course on scheduledcourse.course_id = Course.id 
                                    INNER JOIN  Room on scheduledcourse.room_id = Room.id
                                    WHERE scheduledcourse.id = :scheduled_course_id;";
    
    const SCHEDULED_COURSE_TABLE = "CREATE TABLE IF NOT EXISTS scheduledcourse(
                                    id INT AUTO_INCREMENT PRIMARY KEY,
                                    room_id INT NOT NULL,
                                    course_id INT NOT NULL,
                                    from_date DATETIME NOT NULL,
                                    until_date DATETIME NOT NULL,
                                    FOREIGN KEY (course_id) REFERENCES course(id),
                                    FOREIGN KEY (room_id) REFERENCES room(id));";

    const SCHEDULED_COURSE_INSERT_MOCK_DATA = "INSERT IGNORE INTO scheduledcourse(room_id, course_id, from_date, until_date) values 
                                                (1, 1, '2022-10-27 10:00:00', '2022-10-27 12:00:00'), 
                                                (2, 2, '2022-10-28 14:00:00', '2022-10-28 16:00:00'), 
                                                (4, 3, '2022-10-28 18:00:00', '2022-10-28 20:00:00')";

    const COURSE_BY_ID = "SELECT id, name, type FROM Course WHERE id = :course_id;";
    
    const SCHEDULED_COURSES_FOR_USER="SELECT
                                        scheduledcourse.id as 'id', 
                                        scheduledcourse.from_date as 'from_date',
                                        scheduledcourse.until_date as 'until_date',
                                        scheduledcourse.course_id as 'course_id',
                                        room_id as 'room_id',
                                        course.name as 'course_name',
                                        course.type as 'course_type'
                                    FROM scheduledcourse 
                                    INNER JOIN courseattendance ON scheduledcourse.id = courseattendance.scheduled_course_id
                                    INNER JOIN Course on scheduledcourse.course_id = course.id
                                    WHERE courseattendance.user_id = :user_id AND courseattendance.attended = 1";

    const UPDATE_USER_COURSE_ATTENDANCE = "UPDATE courseattendance
                                                set `attended`=0
                                                where courseattendance.scheduled_course_id IN (
                                                SELECT
                                                scheduledcourse.id as 'scheduled_course_id'
                                                FROM scheduledcourse 
                                                INNER JOIN courseattendance ON scheduledcourse.id = courseattendance.scheduled_course_id
                                                INNER JOIN course on scheduledcourse.course_id = course.id 
                                                WHERE courseattendance.attended = 1
                                                AND course.name= :course_name AND course.type= :course_type
                                                -- AND scheduledcourse.from_date >= NOW()
                                                )
                                                AND
                                                courseattendance.user_id = :user_id
                                                ;";

    const SCHEDULED_COURSE_INFO_BY_ID= "SELECT
                                        scheduledcourse.from_date,
                                        course.name,
                                        course.type
                                        from scheduledcourse
                                        inner join course on scheduledcourse.course_id=course.id
                                        where scheduledcourse.id = :scheduled_course_id;";

    const SAME_HOUR_AND_DAY_SCHEDULED_COURSES = "SELECT scheduledcourse.id
                                                from scheduledcourse
                                                inner join course on scheduledcourse.course_id=course.id
                                                where course.type= :course_type and course.name = :course_name
                                                and HOUR(scheduledcourse.from_date) = HOUR(:from_date)
                                                and WEEKDAY(scheduledcourse.from_date) = WEEKDAY(:from_date1);";

    const UPDATE_ALTERNATIVE_COURSE_ATTENDANCES = "INSERT IGNORE INTO CourseAttendance(user_id, scheduled_course_id) values
                                                    (:user_id, :scheduled_course_id);";
    
    const COURSE_UNFILTRED_ALTERNATIVES = "SELECT scheduledcourse.id as scheduled_id, from_date, until_date FROM scheduledcourse
                                            INNER JOIN course ON scheduledcourse.course_id = course.id
                                            WHERE course.name = :course_name  AND course.type = :course_type";

    const COURSE_PROFESSOR = "SELECT prefix, first_name, last_name FROM userrole INNER JOIN(
                                    SELECT user_id, first_name, last_name, prefix FROM user INNER JOIN(
                                        SELECT user_id FROM groupuser INNER JOIN groupcourse ON groupuser.group_id = groupcourse.group_id
                                        WHERE course_id = :course_id  
                                    ) as group_member
                                    ON user.id = group_member.user_id) as user
                                ON user.user_id = userrole.user_id
                                WHERE role_id = 2";
    
    private DbConfiguration $db;
    public function __construct(DbConfiguration $db){
        $this->db = $db;
    }

    public function createAttendancesForAlternativeCourse($user_id, $scheduled_course_id){
        $query = self::SCHEDULED_COURSE_INFO_BY_ID;
        $scheduled_course = $this->db->execute($query, array("scheduled_course_id" => $scheduled_course_id))->fetch();
        $course_name =  $scheduled_course["name"];
        $course_type =  $scheduled_course["type"];
        $from_date =  $scheduled_course["from_date"];
        $query_future_courses = self::SAME_HOUR_AND_DAY_SCHEDULED_COURSES;
        $future_courses = $this->db->execute($query_future_courses, array("course_type" => $course_type, "course_name"=>$course_name, "from_date"=>$from_date, "from_date1"=>$from_date))->fetchAll();
        $insert_query = self::UPDATE_ALTERNATIVE_COURSE_ATTENDANCES;

        foreach ($future_courses as $future_course) {
            $this->db->execute($insert_query, array("scheduled_course_id" => $future_course["id"], "user_id" => $user_id));
        }
        
    }
    public function getAlternatives($scheduled_id){
        printf("<tbody> <tr> <th> Alternatives </th> </tr>");
            
            // Get scheduled course
            $query = self::SCHEDULED_COURSE_BY_ID;
            $scheduled_course = $this->db->execute($query, array("scheduled_course_id" => $scheduled_id))->fetch();
            $course_id =  $scheduled_course["course_id"];
            
            // Get course from scheduled course
            $query = self::COURSE_BY_ID;
            $course = $this->db->execute($query, array('course_id' => $course_id))->fetch(); 
            $course_name = $course["name"];
            $course_type = $course["type"];
            
            // Get all courses of the same type and name
            $query = self::COURSE_UNFILTRED_ALTERNATIVES;
            $alternatives_array = $this->db->execute($query, array("course_name" => $course_name, "course_type" => $course_type))->fetchAll();
              
            // Add alternatives to the table
            foreach($alternatives_array as $alternative){
                    $scheduled_alternative_id = $alternative["scheduled_id"];
                    $from_date = $alternative["from_date"];
                    $until_date = $alternative["until_date"];
                    $weekday = DateTimeHelper::getDayOfWeek($from_date);
                    $start_hour = DateTimeHelper::getHour($from_date);
                    $end_hour = DateTimeHelper::getHour($until_date);
                    printf("<tr> <td ondblclick = changeCourse('%s') }> %s </td> </tr>",
                        $scheduled_id . "','" .$scheduled_alternative_id . "','" . $course_name . "','" . $course_type . "','" . $weekday . "','" . $start_hour . "','" . $end_hour, // changeCourse parameters
                        $weekday. ": ". $start_hour." - " . $end_hour); // table data
            }
            printf("</tbody><thead class=''></thead>");
    }

    public function getScheduledCourseByID(int $scheduled_coourse_id){
        $sql = self::SCHEDULED_COURSE_BY_ID;
        $scheduled_course_object = $this->db->execute($sql, array('scheduled_course_id' => $scheduled_coourse_id))->fetch();
        return $scheduled_course_object;
    }

    public function getScheduledCourseDetails(int $scheduled_course_id){
        $sql = self::SCHEDULED_COURSE_DETAILS;
        $scheduled_course_object = $this->db->execute($sql, array('scheduled_course_id' => $scheduled_course_id))->fetch();
        return $scheduled_course_object;
    }

    public function getScheduledCourses(){
        $sql = self::SCHEDULED_COURSES;
        $scheduled_courses_array = $this->db->execute($sql)->fetchAll();
        return $scheduled_courses_array;
    }

    public function getScheduledCoursesForUser($user_id){
        $sql = self::SCHEDULED_COURSES_FOR_USER;
        $scheduled_courses_array = $this->db->execute($sql, array('user_id' => $user_id))->fetchAll();
        return $scheduled_courses_array;
    }


    public function updateCourseAttendanceForUser($user_id, $course_name, $course_type){
        $sql = self::UPDATE_USER_COURSE_ATTENDANCE;
        $this->db->execute($sql, array('user_id' => $user_id,'course_name' => $course_name, 'course_type' => $course_type));
    }


    
    public static function getScheduledCoursesForUserIdQuery(int $user_id){
    // Returns the query for selecting all scheduled courses for a student
    // [course_id, course_name, type, room_name, from_date, until_date]
    
    return "SELECT course_id, scheduled.name as course_name, type, room.name as room_name, from_date, until_date FROM room INNER JOIN
            (
                SELECT course_id, name, type, room_id, from_date, until_date  FROM course  INNER JOIN
                (
                    SELECT scheduledcourse.course_id, room_id, from_date, until_date FROM scheduledcourse INNER JOIN 
                    (
                        SELECT course_id FROM 
                        groupuser INNER JOIN groupcourse ON groupuser.group_id = groupcourse.group_id
                        WHERE user_id = " . $user_id . "
                    ) as assignedcourses
            
                    ON assignedcourses.course_id = scheduledcourse.course_id
                ) as scheduled
            
                ON course.id = scheduled.course_id
            ) as scheduled
            ON scheduled.room_id = room.id";
}

public static function getScheduledForUserQuery(int $user_id){
    return "SELECT scheduledcourse.id as id, scheduledcourse.course_id as course_id, room_id, from_date, until_date FROM scheduledcourse INNER JOIN
                    (
                        SELECT course_id FROM
                        groupuser INNER JOIN groupcourse ON groupuser.group_id = groupcourse.group_id
                        WHERE user_id = " . $user_id . "
                    ) as assignedcourses
                            
            ON assignedcourses.course_id = scheduledcourse.course_id";
}


public static function getUnfilteredAlternativesForCourse(string $course_name, string $course_type){
    // Returns the query for selecting all alternative scheduled courses for a given name and type
    // [course_id, room_id, from_date, until_date]
    
    return "SELECT scheduledcourse.id as scheduled_id, from_date, until_date FROM scheduledcourse
                INNER JOIN course ON scheduledcourse.course_id = course.id
                WHERE course.name = '". $course_name ."' AND course.type = '". $course_type ."'";
}



public static function getProfessorForScheduledCourse(int $course_id){
    // Returns the query for selecting the teacher of a scheduled course
    // [prefix, first_name, last_name]
    return "SELECT prefix, first_name, last_name FROM userrole INNER JOIN 
            (
                SELECT user_id, first_name, last_name, prefix FROM user INNER JOIN 
                (
                    SELECT user_id FROM groupuser INNER JOIN groupcourse ON groupuser.group_id = groupcourse.group_id
                    WHERE course_id = " . $course_id . "  
                ) as group_member
                 ON user.id = group_member.user_id
                
            ) as user
            ON user.user_id = userrole.user_id
            WHERE role_id = 2";
}
    public function getScheduleCourseByUser(){
        $sql = self::SCHEDULED_COURSE_BY_USER;
        $scheduled_course_object = $this->db->connection->query($sql, array('user_id' => $user_id))->fetch();
        return $scheduled_course_object;
    }
}
?>





