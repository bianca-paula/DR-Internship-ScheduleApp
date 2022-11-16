<?php
class CourseAttendanceHelper{

    const COURSE_ATTENDANCE_TABLE = "CREATE TABLE IF NOT EXISTS Course_Attendance(
                                    user_id INT,
                                    scheduled_course_id INT,
                                    PRIMARY KEY(user_id, scheduled_course_id));";

    const COURSE_ATTENDANCE_INSERT_MOCK_DATA = "INSERT IGNORE INTO Course_Attendance(user_id, scheduled_course_id) 
                                                values (2, 1), (3, 1), (3, 2), (3, 3)";
}
?>