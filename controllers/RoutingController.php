<?php 
    include_once './controllers/ScheduledCourseController.php';
    include_once './controllers/ErrorPageController.php';
    class RoutingController {
        
        public DbConfiguration $db;
        public ScheduledCourseController $scheduled_course_controller;
        public function __construct(DbConfiguration $db, ScheduledCourseController $scheduled_course_controller){
            $this->db= $db;
            $this->scheduled_course_controller= $scheduled_course_controller;
        }

        public function getRouteHandler(string $request){
            switch ($request) {
                case '/':
                    $this->scheduled_course_controller->view();
                    break;
                case '/schedule':
                    $this->scheduled_course_controller->view();
                    break;

                default:
                    if(strpos($request, "/get-course-details") === 0)
                    {
                        $this->scheduled_course_controller->getScheduledCourseDetails();
                    }

                    else if (strpos($request, "/alternative-courses/") === 0){
                        $params = str_replace("/alternative-courses/", "",$request);
                        $params_array = explode('&', $params);
                        $this->scheduled_course_controller->getAlternativesForCourse($params_array[0]);
                    }
                    else{
                        http_response_code(404);
                        ErrorPageController::view("Invalid URL!");
                    }
                    break;
            }
        }
    }
    
?>
