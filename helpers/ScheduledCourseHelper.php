<?php

class ScheduledCourseHelper{
    
    public static function createScheduledCourseTable(){
        return "CREATE TABLE IF NOT EXISTS ScheduledCourse(
                id INT AUTO_INCREMENT PRIMARY KEY,
                room_id INT NOT NULL,
                course_id INT NOT NULL,
                from_date DATETIME NOT NULL,
                until_date DATETIME NOT NULL,
                FOREIGN KEY (course_id) REFERENCES course(id),
                FOREIGN KEY (room_id) REFERENCES room(id)
        );";
    }
    
    public static function getScheduledCoursesQuery(){
        return "SELECT id, room_id, course_id, from_date, until_date FROM ScheduledCourse;";
    }

    // function getScheduledCoursesQuery(){
    //     return "SELECT *
    //             FROM ScheduledCourse;";
    // }
    
    
    public static function getScheduledCourseQuery(){
        return "SELECT id, room_id, course_id, from_date, until_date 
                FROM ScheduledCourse WHERE id = :scheduled_course_ID;";
    }
    
    public static function insertMockDataScheduledCourse(){
        return "INSERT IGNORE INTO ScheduledCourse(room_id, course_id, from_date, until_date) values 
                (1, 1, '2022-10-27 10:00:00', '2022-10-27 12:00:00'), 
                (2, 2, '2022-10-28 14:00:00', '2022-10-28 16:00:00'), 
                (4, 3, '2022-10-28 18:00:00', '2022-10-28 20:00:00')";
    }

    public static function getScheduledCourseDetails(){
        return "SELECT ScheduledCourse.id as 'scheduled_course_id',  
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
                FROM ScheduledCourse
                INNER JOIN Course on ScheduledCourse.course_id = Course.id 
                INNER JOIN  Room on ScheduledCourse.room_id = Room.id
                WHERE ScheduledCourse.id = :scheduled_course_id;";
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
}
?>





