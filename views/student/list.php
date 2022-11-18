<?php
include_once './views/page-parts/header.php';
?>
<div class="container-fluid">
        <div class="row px-4 py-4">
            <div class="col-9">
                <table data-toggle="table" id="schedule-table">
                    <thead>
                        <tr>
                          <th data-field="hour" data-width="80"><div onclick="downloadPDF()"><i class="fa fa-download" style="font-size:25px;color: #FFFBD6;"></i></div></th>
                          <?php 
                            foreach(WEEKDAYS as $day){
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
                            foreach(WEEKDAYS as $day) {
                            ?>
                                <?php
                                    $has_value=false;
                                    $tdString='<td> <div class="d-inline align-middle" ';
                                    foreach ($all_scheduled_courses as $scheduled_course){
                                      if($scheduled_course["day_of_week"] === $day){
                                        if(($scheduled_course["from_hour"] === $hour || $scheduled_course["until_hour"] === $hour+1)&& $has_value === false){
                                          $scheduled_course_object = $scheduled_course["scheduled_course"];
                                          $tdString = $tdString . " id=" . $scheduled_course_object->getID() . " onclick = populateAlternatives(".$scheduled_course_object->getID() . ")>" .$scheduled_course_object->getCourseName() . ' ' . $scheduled_course_object->getCourseType() . "</div>".
                                          '<div class=" d-inline float-right align-middle">
                                            <div class="dropright show">
                                                  <a href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                      <i class="fa fa-ellipsis-v"></i>
                                                  </a>

                                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <a class="dropdown-item" data-toggle="modal" data-target="#courseModal" '. " data-object=" . $scheduled_course_object->getID().'>Course Details</a>
                                                    <a class="dropdown-item" data-toggle="modal" data-target="#removeScheduledCourseModal" '. " data-object=" .$scheduled_course_object->getID()." data-name=" . $scheduled_course_object->getCourseName()." data-type=" . $scheduled_course_object->getCourseType().' >Remove Course</a>
                                                  </div>
                                            </div>
                                          </div> 
                                         ' ;
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
                        <td>Select a course to see alternatives</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

<?php
include_once './views/scheduled-course-modal/list.php';
include_once './views/remove-scheduled-course-modal/list.php';
include_once './views/page-parts/Footer.php';
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://unpkg.com/bootstrap-table@1.21.1/dist/bootstrap-table.min.js"></script>
<script src="https://kit.fontawesome.com/aca3ebed9c.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
<script src="https://unpkg.com/jspdf-autotable@3.5.22/dist/jspdf.plugin.autotable.js"></script>
<script type="text/javascript" src="./assets/JS/student/student.js"></script>