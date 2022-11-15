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
                case '/student':
                    $this->scheduled_course_controller->view();
                    break;
                // TO DO
                case '/get-course-details':
                    $this->scheduled_course_controller->getScheduledCourseDetails();
                    break;
                default:
                    http_response_code(404);
                    ErrorPageController::view("Invalid URL!");
                    break;
            }
        }
    }
    
?>
