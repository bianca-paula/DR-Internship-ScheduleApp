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

    static function createStructure($db)
    {
        $db->execute(self::COURSE_ATTENDANCE_TABLE);
    }

    static function insertData($db)
    {
        $db->execute(self::COURSE_ATTENDANCE_INSERT_MOCK_DATA);
    }


    const GET_STUDENTS_FROM_GROUP = "SELECT user_id FROM GroupUser WHERE group_id = :group_id";
    const GET_GROUP_SCHEDULED_COURSES = "SELECT scheduledcourse.id  from scheduledcourse INNER JOIN groupcourse 
                                        on scheduledcourse.course_id = groupcourse.course_id
                                        WHERE groupcourse.group_id = :group_id;";

    const INSERT_INTO_ATTENDANCE = "INSERT IGNORE INTO CourseAttendance(user_id, scheduled_course_id) values (:user_id, :scheduled_course_id);";


    function getUsersFromGroup($group_id){
        $query = self::GET_STUDENTS_FROM_GROUP;
        $users_in_group = $this->db->execute($query, array("group_id" => $group_id)) -> fetchAll();
        return $users_in_group;
    }

    function getScheduledCoursesForGroup($group_id){
        $query = self::GET_GROUP_SCHEDULED_COURSES;
        $group_scheduled_courses = $this->db->execute($query, array("group_id" => $group_id)) -> fetchAll();
        return $group_scheduled_courses;
    }

    function populateAttendanceTable(){
        $group_id=1;
        $users = $this->getUsersFromGroup($group_id);
        $scheduled_courses=$this->getScheduledCoursesForGroup($group_id);
        foreach ($users as $user) {
            foreach ($scheduled_courses as $course){
                $query = self::INSERT_INTO_ATTENDANCE;
                $this->db->execute($query, array("user_id" => $user["user_id"], "scheduled_course_id"=> $course["id"]));
            }
        }
    }
}