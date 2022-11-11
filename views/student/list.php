<?php
include_once '.\views\page-parts\Header.php';
?>
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
                                          $tdString = $tdString . " data-object=$course_id " .'>' .$courseObj->getName() . '|' . $courseObj->getType() ;
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
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary upload-button" data-dismiss="modal" data-toggle="modal" data-target="#exampleModal">Add Medical Leave</button>
        <button type="button" class="btn btn-primary upload-button ml-auto" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
<div>
<?php
include_once '.\views\page-parts\Footer.php'
?>