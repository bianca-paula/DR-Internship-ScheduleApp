<?php
include_once './controllers/ScheduledCourseController.php';
include_once './controllers/ErrorPageController.php';
class RoutingController
{

    public DbConfiguration $db;
    public ScheduledCourseController $scheduled_course_controller;
    public AdminController $admin_controller;
    public function __construct(DbConfiguration $db,
    $scheduled_course_controller,AdminController $admin_controller)
    {
        $this->db = $db;
        $this->scheduled_course_controller = $scheduled_course_controller;
        $this->admin_controller = $admin_controller;
    }

    public function getRouteHandler(string $request)
    {
        switch ($request) {
            case '/':
                $this->scheduled_course_controller->view();
                break;
            case '/schedule':
                $this->scheduled_course_controller->view();
                break;

            case '/admin':
                $this->admin_controller->view();
                break;

            case '/admin/add-course':
                $this->admin_controller->addCourse();
                break; 
            case '/admin/delete-course':
                // var_dump(true);
                // die();
                $this->admin_controller->deleteCourse();
                break;
            default:
                if (strpos($request, "/get-course-details") === 0) {
                    $this->scheduled_course_controller->getScheduledCourseDetails();
                } else if (strpos($request, "/alternative-courses/") === 0) {
                    $params = str_replace("/alternative-courses/", "", $request);
                    $params_array = explode('&', $params);
                    $this->scheduled_course_controller->getAlternativesForCourse($params_array[0]);
                } else {
                    http_response_code(404);
                    ErrorPageController::view("Invalid URL!");
                }
                break;
        }
    }
}
