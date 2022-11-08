<?php
include_once '../utils/DBConfiguration.php';
include_once '../models/Course.php';
class ScheduledCourseController{

    private DbConfiguration $db;

    public function __construct(DbConfiguration $db){
        $this->db=$db;
    }
    public function getCourseById(int $course_id){
        $sql = "SELECT name, type
                FROM Course
                WHERE id = $course_id;";
        $statement = $this->db->connection->query($sql);
        $statement->setFetchMode(PDO::FETCH_OBJ);
        $course = $statement->fetch();
        // $statement->setFetchMode(PDO::FETCH_CLASS, 'Course');
        // $member = $statement->fetchObject('Course', [$this->db]);
        return $course;
    }

    public function getCourses(){
        $sql = "SELECT *
                FROM Course;";
        $statement = $this->db->connection->query($sql);
        $courses = $statement->fetchAll();
        foreach ($courses as $row) {
            echo $row['name']. "|" .$row['type'] ."<br />\n";
        }
        return $courses;
    }

    public function getScheduledCourses(){
        $sql = "SELECT id as 'id',
        room_id as 'room_id',
        course_id as 'course_id',
        from_date as 'from_date',
        until_date as 'until_date',
        HOUR(from_date) as 'from_hour',
        HOUR(until_date) as 'until_hour',
        DAYNAME(from_date) as 'week_day'
                FROM Scheduled_Course;";
        $statement = $this->db->connection->query($sql);
        $scheduled_courses = $statement->fetchAll();
        foreach ($scheduled_courses as $row) {
            echo $row['course_id']. "|" .$row['from_date']. "|" .$row['until_date'].$row['week_day'] .$row['from_hour']."<br />\n";
        }
        return $scheduled_courses;
    }
}
?>