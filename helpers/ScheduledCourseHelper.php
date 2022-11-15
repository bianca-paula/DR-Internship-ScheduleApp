<?php
function createScheduledCourseTable(){
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

function getScheduledCoursesQuery(){
    return "SELECT *
            FROM ScheduledCourse;";
}

function getScheduledCourseQuery(int $scheduled_course_ID){
    return "SELECT *
            FROM ScheduledCourse
            WHERE id = $scheduled_course_ID;";
}

function insertMockDataScheduledCourse(){
    return "INSERT IGNORE INTO ScheduledCourse(room_id, course_id, from_date, until_date) values 
    (1, 1, '2022-10-27 10:00:00', '2022-10-27 12:00:00'), 
    (2, 2, '2022-10-28 14:00:00', '2022-10-28 16:00:00'), 
    (4, 3, '2022-10-28 18:00:00', '2022-10-28 20:00:00')";
}


function getScheduledCoursesForUserIdQuery(int $user_id){
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

function getScheduledForUserQuery(int $user_id){
    return "SELECT scheduledcourse.id as id, scheduledcourse.course_id as course_id, room_id, from_date, until_date FROM scheduledcourse INNER JOIN
                    (
                        SELECT course_id FROM
                        groupuser INNER JOIN groupcourse ON groupuser.group_id = groupcourse.group_id
                        WHERE user_id = " . $user_id . "
                    ) as assignedcourses
                            
            ON assignedcourses.course_id = scheduledcourse.course_id";
}


function getUnfilteredAlternativesForCourse(string $course_name, string $course_type){
    // Returns the query for selecting all alternative scheduled courses for a given name and type
    // [course_id, room_id, from_date, until_date]
    
    return "SELECT scheduledcourse.id as scheduled_id, from_date, until_date FROM scheduledcourse
                INNER JOIN course ON scheduledcourse.course_id = course.id
                WHERE course.name = '". $course_name ."' AND course.type = '". $course_type ."'";
}



function getProfessorForScheduledCourse(int $course_id){
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


?>