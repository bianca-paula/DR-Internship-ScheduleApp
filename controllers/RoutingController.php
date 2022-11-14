<?php 
    include_once './controllers/ScheduledCourseController.php';
    include_once './controllers/ErrorPageController.php';
    class RoutingController {

        static $baseURL="/internship/DR-Internship-ScheduleApp/";
        
        public DbConfiguration $db;
        public ScheduledCourseController $scheduled_courses;
        public function __construct(DbConfiguration $db, ScheduledCourseController $scheduled_courses){
            $this->db= $db;
            $this->scheduled_courses= $scheduled_courses;
        }

        public function getRouteHandler(string $request){
            switch ($request) {
                case self::$baseURL:
                    $this->scheduled_courses->view();
                    break;
                case (self::$baseURL.'student'):
                    $this->scheduled_courses->view();
                    break;
            
                default:
                    http_response_code(404);
                    ErrorPageController::view("Invalid URL!");
                    break;
            }
        }
    }
    
?>
