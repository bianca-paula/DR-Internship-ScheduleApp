<?php

include './helpers/CourseHelper.php';

class AdminController
{
    private DBConfiguration $db;

    public  function __construct(DBConfiguration $db)
    {
        $this->db = $db;
        $this->course_helper = new CourseHelper($db);
    }

    //delete course by id
    public function deleteCourse($course_id)
    {
        return $this->course_helper->deleteCourse($course_id);
    }

    //add course
    public function addCourse($course_name, $course_type)
    {
        return $this->course_helper->addCourse($course_name, $course_type);
    }

    //get all courses
    public function getAllCourses()
    {
        return $this->course_helper->getAllCourses();
    }
}
