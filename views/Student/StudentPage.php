<?php 
error_reporting(E_ERROR | E_PARSE);
include_once '../../utils/DBConfiguration.php';
include_once '../../models/Course.php';
include_once '../../models/ScheduledCourse.php';
include_once '../../controllers/ScheduledCourseController.php';

function getLogo(){
    return '<img src="../../assets/images/logo_books.png" alt="Logo Books" height="40em">';
}
// function getCourses(){
    $db = new DbConfiguration();
    $scheduled_courses = new ScheduledCourseController($db);
    
    $results = $scheduled_courses->getScheduledCourses();
    echo "aaaaaaaaa";
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap and Bootstrap Table -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.21.1/dist/bootstrap-table.min.css">
    <!-- App Style -->
    <link rel="stylesheet" href="../../assets/style/style.css">
    <!-- Google Fonts && Font Awesome -->
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <!-- <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" /> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Student Page</title>
</head>
<body>
    <div class="container-fluid">
        <header>
            <div class="row header-container py-3">
                <div class="col-4 pl-5">
                    <h3><?= getLogo() ?>&nbsp;ScheduleApp</h3>
                </div>
                <div class="col-4"></div>
                <div class="col-4 pr-5">
                    <h3 class="float-right">Username &nbsp;<span onclick="logoutPage()"><i class="fa-solid fa-right-from-bracket"></span></i></h3>
                </div>
            </div>
        </header>
        <div class="row px-4 py-4">
            <div class="col-9">
                <table data-toggle="table" id="schedule-table">
                    <thead>
                        <tr>
                          <th data-field="hour" data-width="80"><div onclick="downloadPDF()"><i class="fa fa-download" style="font-size:25px;color: #FFFBD6;"></i></div></th>
                          <?php 
                            $weekdays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
                            foreach($weekdays as $day){
                          ?>
                              <th data-width="150"><?php print($day)?></th>
                            <?php 
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                      for($hour = 8; $hour <= 19; $hour++) {
                      ?>
                        <tr>
                          <th><?php print $hour; ?>-<?php print ($hour+1) ?></th>
                          <?php
                            foreach($weekdays as $day) {
                            ?>
                              <!-- <td data-toggle="modal" data-target="#courseModal"> -->
                                <?php
                                
                                    // iterate throug results . find the one that is for current day (si week)
                                    // pop-it out so iteration decrease
                                    // print "b";
                                    // $tdString='<td data-toggle="modal" data-target="#courseModal"';
                                    $bool=0;
                                    $tdString='<td data-toggle="modal" data-target="#courseModal"';
                                    foreach ($results as $course) {
                                      
                                      if($course["week_day"] === $day && ($course["from_hour"] === $hour || $course["until_hour"]==$hour+1)){
                                        $courseObj=$scheduled_courses->getCourseById($course["course_id"]);
                                        $course_id=$course["id"];
                                        $tdString = $tdString . " data-object=$course_id " .">" .$courseObj->name . "|" . $courseObj->type;
                                        $bool=1;
                                        // print $courseObj->name . "|" . $courseObj->type;
                                      }
                                      // else {
                                      //   $tdString = $tdString . ">";
                                      // }
                                      
                                    }
                                    if($bool===0){
                                      $tdString = $tdString . ">";
                                    }
                                    $tdString = $tdString . "</td>";
                                    echo $tdString;
                         
                                ?>
                              <!-- </td> -->
                              <?php
                            }
                          ?>
                        </tr>
                        <?php
                      }
                        ?>   
                    </tbody> 
                </table>
            </div>
            <div class="col-3">
                <table data-toggle="table" id="alternatives">
                    <tr>
                        <th>Alternatives</th>
                    </tr>
                    <tr>
                        <td>Laborator AI grupa 255</td>
                    </tr>
                    <tr>
                        <td>Laborator AI grupa 256</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
  <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Medical Leave</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form id="leave-form" action="" method="POST">
            <label for="medical-leave">In order to add a medical leave, please upload the medical document.</label>
            <input type="file" id="medical-leave" name="medical-leave"> 
        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary cancel-button" data-dismiss="modal">Cancel</button>
        <button type="submit" form="leave-form" class="btn btn-primary upload-button">Upload</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="courseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h2 id="modal-course-name">Course</h2>
        <div id="course-details">
            <p>Type: </p>
            <p>Room: </p>
            <p>Professor: </p>
            <p>Date: </p>
            <p>Time: </p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary upload-button" data-dismiss="modal" data-toggle="modal" data-target="#exampleModal">Add Medical Leave</button>
        <button type="button" class="btn btn-primary upload-button ml-auto" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
<div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/bootstrap-table@1.21.1/dist/bootstrap-table.min.js"></script>
    <script src="https://kit.fontawesome.com/aca3ebed9c.js" crossorigin="anonymous"></script>
    <!-- <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script> -->
    <script>
        console.log("YESS");
        $(document).ready(function() {
            console.log("Before Call");
            setCellByID(15, "AI-Course");
        });

        function downloadPDF(){
            alert("Download PDF!");
        }

        function logoutPage(){
            alert("Logout!");
        }

        function setCellByID(cellID, data){
            console.log("In functiion");
            var cell = $("td:data(row-id)")
                .filter(function () {
                    return $(this).data("row-id") === cellID;
                });
            console.log("CELL value: ", cell);
        }

        $('#courseModal').on('show.bs.modal', function (event){
            var row_id = $(event.relatedTarget).data('object') // Button that triggered the modal
            window.alert(row_id); 
        });

    </script>
</body>
</html>