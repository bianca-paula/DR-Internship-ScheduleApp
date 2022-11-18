<?php

include '../helpers/CourseHelper.php';

class AdminController
{
    private DBConfiguration $db;

    public  function __construct(DBConfiguration $db)
    {
        $this->db = $db;
        $this->course_helper = new CourseHelper($db);
    }

    //delete course by id
    public function deleteCourse()
    {
        // var_dump(true);
        if (isset($_POST['course-id'])) {
            $course_id = $_POST['course-id'];
            return $this->course_helper->deleteCourse($course_id);
        }
    }

    //add course
    public function addCourse()
    {
        if (isset($_POST['course-name']) && isset($_POST['course-type'])) {
            echo $_POST;
            $course_name = $_POST['course-name'];
            $course_type = $_POST['course-type'];
            return $this->course_helper->addCourse($course_name, $course_type);
        }
    }

    //get all courses
    public function getAllCourses()
    {
        return $this->course_helper->getAllCourses();
    }

    public function view()
    {
        $results = $this->getAllCourses();
        print TemplateEngine::template('./views/admin/list.php', array("results" => $results));
    }
}
