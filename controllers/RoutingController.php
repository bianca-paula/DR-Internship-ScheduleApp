<?php
include_once './controllers/StudentController.php';
include_once './controllers/ErrorPageController.php';
include_once './controllers/LoginController.php';
include_once './controllers/AdminController.php';

class RoutingController
{
    public static StudentController $student_controller;
    public static LoginController $login_controller;
    public static AdminController $admin_controller;
    public function __construct()
    {
    }
    public static function getRouteHandler()
    {
        $request = $_SERVER['REQUEST_URI'];
        $request_array = explode('/', $request);
        array_shift($request_array);
        $position = 0;
        switch ($request_array[$position]) {
            case 'login':
                self::$login_controller = new LoginController();
                self::$login_controller->login();
                break;
            case 'schedule':
                if (
                    !isset($_COOKIE['user_role']) || $_COOKIE['user_role'] != "student"
                    || !isset($_COOKIE['logged_in']) || $_COOKIE['logged_in'] == "false"
                ) {
                    header("Location: http://scheduleapp.com/login");
                    exit();
                }
                self::$student_controller = new StudentController();
                $position++;
                if (array_key_exists($position, $request_array)) {
                    $path = strtok($request_array[$position], '?');

                    switch ($path) {

                        case 'get-course-details':
                            self::$student_controller->getScheduledCourseDetails();
                            break;
                        case 'alternative-courses':
                            self::$student_controller->getAlternativesForCourse();
                            break;
                        case 'delete-course':
                            self::$student_controller->updateCourseAttendanceForUser();
                            self::$student_controller->view();
                        case 'replace-course':
                            self::$student_controller->replaceCourseWithAlternative();
                            self::$student_controller->view();
                        default:
                            http_response_code(404);
                            ErrorPageController::view("Invalid URL!");
                            break;
                    }
                } else {
                    self::$student_controller->view();
                }
                break;



            case 'admin':
                // if (
                //     !isset($_COOKIE['user_role']) || $_COOKIE['user_role'] != "admin"
                //     || !isset($_COOKIE['logged_in']) || $_COOKIE['logged_in'] == "false"
                // ) {
                //     header("Location: http://scheduleapp.com/login");
                //     exit();
                // }
                self::$admin_controller = new AdminController();
                $position++;
                if (array_key_exists($position, $request_array)) {
                    $path = strtok($request_array[$position], '?');

                    switch ($path) {

                        case 'add-course':
                            self::$admin_controller->addCourse();
                            break;
                        case 'delete-course':
                            self::$admin_controller->deleteCourse();
                            break;
                        
                        default:
                            http_response_code(404);
                            ErrorPageController::view("Invalid URL!");
                            break;
                    }
                } else {
                    self::$admin_controller->view();
                }
                break;
            default:
                http_response_code(404);
                ErrorPageController::view("Invalid URL!");
                break;
        }
    }
}
