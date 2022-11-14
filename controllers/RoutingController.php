<?php 
    class RoutingController {

        static $baseURL="/internship/DR-Internship-ScheduleApp/";
        public function __construct(){}

        public static function getRouteHandler(string $request){
            $myfile="";
            switch ($request) {
                case self::$baseURL:
                    $myfile='./views/student/list.php';
                    break;
            
                case (self::$baseURL.'student'):
                    $myfile='./views/student/list.php';
                    break;
            
                default:
                    http_response_code(404);
                    $myfile='./views/error-page/404.php';
                    break;
            }

            print TemplateEngine::template($myfile);
        }
    }
    
?>
