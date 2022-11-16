<?php

class ScheduledCourseHelper{

    private DbConfiguration $db;
    const SCHEDULED_COURSE_BY_ID = "SELECT id, room_id, course_id, from_date, until_date 
                                    FROM Scheduled_Course WHERE id = :scheduled_course_id;";

    const SCHEDULED_COURSES = "SELECT id, room_id, course_id, from_date, until_date 
                                FROM Scheduled_Course;";

    const SCHEDULED_COURSE_DETAILS = "SELECT Scheduled_Course.id as 'scheduled_course_id',  
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
                                    FROM Scheduled_Course
                                    INNER JOIN Course on Scheduled_Course.course_id = Course.id 
                                    INNER JOIN  Room on Scheduled_Course.room_id = Room.id
                                    WHERE Scheduled_Course.id = :scheduled_course_id;";
    
    const SCHEDULED_COURSE_TABLE = "CREATE TABLE IF NOT EXISTS Scheduled_Course(
                                    id INT AUTO_INCREMENT PRIMARY KEY,
                                    room_id INT NOT NULL,
                                    course_id INT NOT NULL,
                                    from_date DATETIME NOT NULL,
                                    until_date DATETIME NOT NULL,
                                    FOREIGN KEY (course_id) REFERENCES course(id),
                                    FOREIGN KEY (room_id) REFERENCES room(id));";

    const SCHEDULED_COURSE_INSERT_MOCK_DATA = "INSERT IGNORE INTO Scheduled_Course(room_id, course_id, from_date, until_date) values 
                                                (1, 1, '2022-10-27 10:00:00', '2022-10-27 12:00:00'), 
                                                (2, 2, '2022-10-28 14:00:00', '2022-10-28 16:00:00'), 
                                                (4, 3, '2022-10-28 18:00:00', '2022-10-28 20:00:00')";
    public function __construct(DbConfiguration $db){
        $this->db = $db;
    }

    public function getScheduledCourseByID(int $scheduled_coourse_id){
        $sql = self::SCHEDULED_COURSE_BY_ID;
        $scheduled_course_object = $this->db->execute($sql, array('scheduled_course_id' => $scheduled_coourse_id))->fetch();
        $scheduled_course = $this->convertToScheduledCourses($scheduled_course_object);
        return $scheduled_course;
    }

    public function getScheduledCourses(){
        $sql = self::SCHEDULED_COURSES;
        $scheduled_courses_array = $this->db->execute($sql)->fetchAll();
        $scheduled_courses = $this->convertToScheduledCourses($scheduled_courses_array);
        return $scheduled_courses;
    }

    public function convertToScheduledCourses($scheduled_courses){
        $courses = [];
        foreach($scheduled_courses as $course){
            
            $courses[] =new ScheduledCourse($course['id'], $course['room_id'], $course['course_id'], $course['from_date'], $course['until_date']);
        }
        return $courses;
    }
}
