<?php 
error_reporting(E_ERROR | E_PARSE);
include_once '../../utils/DBConfiguration.php';
include_once '../../models/Course.php';
include_once '../../models/ScheduledCourse.php';
include_once '../../helpers/GeneralHelper.php';
include_once '../../controllers/ScheduledCourseController.php';
$user_id = 634;

$db = new DbConfiguration();
$scheduled_courses = new ScheduledCourseController($db);
$results = $scheduled_courses->getScheduleForUser($user_id); //getScheduledCourses();


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
                                <?php
                                    $has_value=false;
                                    $tdString='<td data-toggle="modal" data-target="#courseModal"';
                                    foreach ($results as $course){
                                      $from_hour = getHour($course->getFromDate());
                                      $until_hour = getHour($course->getUntilDate());
                                      $day_of_week = getDayOfWeek($course->getFromDate());
                                      if($day_of_week === $day){
                                        if(($from_hour === $hour || $until_hour === $hour+1)&& $has_value === false){
                                          $courseObj=$scheduled_courses->getCourseById($course->getCourseID());
                                          $course_id=$course->getID();
                                          $tdString = $tdString . " data-object=$course_id " .'>' .$courseObj->getName() . ' | ' . $courseObj->getType() ;
                                          $has_value=true;
                                        } 
                                      }
                                    }
                                    if($has_value===false){
                                      $tdString = $tdString . '>';
                                    }
                                    $tdString = $tdString . '</td>';
                                    echo $tdString;
                                ?>
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
      <div id="course-details" class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary upload-button" data-dismiss="modal" data-toggle="modal" data-target="#exampleModal">Add Medical Leave</button>
        <button type="button" class="btn btn-primary upload-button ml-auto" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
<div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/bootstrap-table@1.21.1/dist/bootstrap-table.min.js"></script>
    <script src="https://kit.fontawesome.com/aca3ebed9c.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
    <script src="https://unpkg.com/jspdf-autotable@3.5.22/dist/jspdf.plugin.autotable.js"></script>

    <!-- <script src="https://unpkg.com/jspdf-autotable@3.5.25/dist/jspdf.plugin.autotable.js"></script> -->
    <!-- <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.0/html2canvas.min.js" integrity="sha512-UcDEnmFoMh0dYHu0wGsf5SKB7z7i5j3GuXHCnb3i4s44hfctoLihr896bxM0zL7jGkcHQXXrJsFIL62ehtd6yQ==" crossorigin="anonymous"
    referrerpolicy="no-referrer"></script> -->
    <script>

        function downloadPDF(){
            alert("Download PDF!");
            // var pdf = new jsPDF();
            // source = $('#schedule-table')[0];
            // console.log(source);
            // //pdf.fromHTML(source);
            // pdf.autoTable(source);
            // pdf.save('Test.pdf');

            var pdfsize = 'a0';
            var pdf = new jsPDF('l', 'pt', pdfsize);

            pdf.autoTable({
              html: '#schedule-table',
              startY: 60,
              styles: {
                fontSize: 50,
                cellWidth: 'wrap',
                fillColor: [172, 112, 136]

              },
              columnStyles: {
                1: {columnWidth: 'auto'}
              }
            });

            pdf.save("MySchedule.pdf");

            
        }

        function logoutPage(){
            alert("Logout!");
        }


		function populateAlternatives(course_id){
			var table = document.getElementById("alternatives");
			for(var i = 1; i < table.rows.length;)
            {   
               table.deleteRow(i);
            }
            
            $.get('../AjaxRequests/GetAlternativeCourses.php', {"scheduled_id": course_id, "user_id": <?php echo $user_id?>} , function(data){
            	var table = document.getElementById("alternatives");
              	table.innerHTML = data;
            });
		}

		
		
		function changeCourse(name, type, weekday, start_hour, end_hour){
			var table = document.getElementById("schedule-table");
			var row_idx_to_attach = 0;
			var column_idx_to_attach = 0;
			
			
			var r=0; //start counting rows in table
			while(row=table.rows[r++]){
				hour_interval = row.cells[0].innerHTML;
				if(hour_interval.charAt(0) == start_hour.charAt(0) && hour_interval.charAt(1) == start_hour.charAt(1))
					row_idx_to_attach = r-1; // row uses r before the incrementation
			}
			
			var c=1; // start counting columns in table
			while(c<=5){
				var day = table.rows[0].cells[c].querySelector('.th-inner ').textContent;
				if (weekday == day)
					column_idx_to_attach = c;
				c++;
				
			}
			
			course_length = end_hour - start_hour;
			for(var hours_added = 0; hours_added < course_length; hours_added++)
				table.rows[row_idx_to_attach + hours_added].cells[column_idx_to_attach].innerHTML = name + " | " + type;

		}
		
		

        $('#courseModal').on('show.bs.modal', function (event){
            var selectedCourseID = $(event.relatedTarget).data('object') // Button that triggered the modal
            populateAlternatives(selectedCourseID);
            $.get('../AjaxRequests/GetCourseDetails.php', {"id": selectedCourseID} , function(data){
              $("#course-details").html(data);
            });
        });
        
        
        
    </script>
</body>
</html>




