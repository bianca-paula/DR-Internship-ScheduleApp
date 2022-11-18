<?php 
    include_once './controllers/StudentController.php';
    include_once './controllers/ErrorPageController.php';
    class RoutingController {
        public static StudentController $student_controller;
        public static LoginController $login_controller;
        public function __construct(){}
        public static function getRouteHandler(){
            $request = $_SERVER['REQUEST_URI'];
            $request_array = explode('/', $request);
            array_shift($request_array);
            $position = 0;
            switch($request_array[$position]){
                case 'login':
                    self::$login_controller = new LoginController();
                    self::$login_controller->view();
                    break;
                case 'schedule':
                    self::$student_controller= new StudentController();
                    $position++;
                    if(array_key_exists($position, $request_array)){
                        $path = strtok($request_array[$position], '?');
                        switch($path){
                            case 'get-course-details':
                                self::$student_controller->getScheduledCourseDetails();
                                break;
                            case 'alternative-courses':
                                self::$student_controller->getAlternativesForCourse();
                                break;
                            default:
                                http_response_code(404);
                                ErrorPageController::view("Invalid URL!");
                                break;
                        }
                    }
                    else{
                        self::$student_controller->view();
                    }
                    break;
                default:
                    http_response_code(404);
                    ErrorPageController::view("Invalid URL!");
                    break;
            }
        }
    }
?>
