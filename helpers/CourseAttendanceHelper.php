<?php
class CourseAttendanceHelper{
    private DbConfiguration $db;

    public function __construct(DbConfiguration $db){
        $this->db = $db;
    }

    const COURSE_ATTENDANCE_TABLE = "CREATE TABLE IF NOT EXISTS Course_Attendance(
                                    user_id INT,
                                    scheduled_course_id INT,
                                    PRIMARY KEY(user_id, scheduled_course_id));";

    const COURSE_ATTENDANCE_INSERT_MOCK_DATA = "INSERT IGNORE INTO Course_Attendance(user_id, scheduled_course_id) 
                                                values (2, 1), (3, 1), (3, 2), (3, 3)";

    const GET_STUDENTS_FROM_GROUP = "SELECT user.id FROM GroupUser WHERE group_id = :group_id";


    function populateCourseAttendanceForGroup($group_id){
        $query = self::GET_STUDENTS_FROM_GROUP;
        $users_in_group = this->$db->execute($query, array("group_id" => $group_id)) -> fetchAll();

    }
}
?>