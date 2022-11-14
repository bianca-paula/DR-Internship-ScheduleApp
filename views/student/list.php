<div class="container-fluid">
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
                                      $from_hour = DateTimeHelper::getHour($course->getFromDate());
                                      $until_hour = DateTimeHelper::getHour($course->getUntilDate());
                                      $day_of_week = DateTimeHelper::getDayOfWeek($course->getFromDate());
                                      if($day_of_week === $day){
                                        if(($from_hour === $hour || $from_hour === $hour+1)&& $has_value === false){
                                          $courseObj=$scheduled_courses->getCourseById($course->getCourseID());
                                          $course_id=$course->getID();
                                          $tdString = $tdString . " data-object=$course_id " .'>' .$courseObj->getName() . ' ' . $courseObj->getType() ;
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
      <div id="course-details" class="modal-body">
        <h2 id="modal-course-name" class="text-center">Course</h2>
        <div id="course-details" class="pl-2">
            <p id="modal-course-type">Type: </p>
            <p id="modal-course-room">Room: </p>
            <p id="modal-course-professor">Professor: </p>
            <p id="modal-course-date">Date: </p>
            <p id="modal-course-time">Time: </p>
        </div>
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
<script>

        function downloadPDF(){
            alert("Download PDF!");
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

        $('#courseModal').on('show.bs.modal', function (event){
            var modal = $(this);
            var selected_course_ID = $(event.relatedTarget).data('object') // Button that triggered the modal
            $.get('./controllers/AjaxRequests/GetCourseDetails.php', {"id": selected_course_ID} , function(data){
              // $("#course-details").html(data);
              console.log("In Footer");
              console.log($.parseJSON(data));
              var scheduled_course_json=$.parseJSON(data);
              console.log(scheduled_course_json["course_type"]);
              // modal.find('.modal-title').text('New message to ');
              modal.find('#modal-course-name').text(scheduled_course_json["course_name"]);
              modal.find('#modal-course-type').text("Type: " + scheduled_course_json["course_type"]);
              modal.find('#modal-course-room').text("Room: " + scheduled_course_json["room_name"]);
              modal.find('#modal-course-professor').text("Professor: ");
              modal.find('#modal-course-date').text("Date: " + scheduled_course_json["from_date"]);
              modal.find('#modal-course-time').text("Time: " + scheduled_course_json["from_hour"] + " - " + scheduled_course_json["until_hour"]);
            });
        });
    </script>