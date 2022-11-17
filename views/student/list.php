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
                                    foreach ($results as $course){
                                      $from_hour = DateTimeHelper::getHour($course->getFromDate());
                                      $until_hour = DateTimeHelper::getHour($course->getUntilDate());
                                      $day_of_week = DateTimeHelper::getDayOfWeek($course->getFromDate());
                                      if($day_of_week === $day){
                                        if(($from_hour === $hour || $until_hour === $hour+1)&& $has_value === false){
                                          $courseObj=$scheduled_courses->getCourseById($course->getCourseID());
                                          $course_id=$course->getID();
                                          $course_name=$courseObj->getName();
                                          $course_type=$courseObj->getType();
                                          $tdString = $tdString . " id=" . $course_id . " onclick = populateAlternatives($course_id)>" .$course_name . ' ' . $course_type . "</div>".
                                          '<div class=" d-inline float-right align-middle">
                                            <div class="dropright show">
                                                  <a href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                      <i class="fa fa-ellipsis-v"></i>
                                                  </a>

                                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <a class="dropdown-item" data-toggle="modal" data-target="#courseModal" '. " data-object=$course_id " .'>Course Details</a>
                                                    <a class="dropdown-item" data-toggle="modal" data-target="#removeScheduledCourseModal" '. " data-object=$course_id data-name=$course_name data-type=$course_type" .' >Remove Course</a>
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
?>
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
            $.get('/get-course-details', {"scheduled_course_id" : selected_course_ID}, function(data){
              var scheduled_course_json=$.parseJSON(data);
              modal.find('#modal-course-name').text(scheduled_course_json["course_name"]);
              modal.find('#modal-course-type').text("Type: " + scheduled_course_json["course_type"]);
              modal.find('#modal-course-room').text("Room: " + scheduled_course_json["room_name"]);
              modal.find('#modal-course-professor').text("Professor: ");
              modal.find('#modal-course-date').text("Date: " + scheduled_course_json["from_date"]);
              modal.find('#modal-course-time').text("Time: " + scheduled_course_json["from_hour"] + " - " + scheduled_course_json["until_hour"]);
            });
        });

        $('#removeScheduledCourseModal').on('show.bs.modal', function (event){
            var modal = $(this);
            var selected_course_ID = $(event.relatedTarget).data('object') // Button that triggered the modal
            var selected_course_name = $(event.relatedTarget).data('name') // Button that triggered the modal
            var selected_course_type = $(event.relatedTarget).data('type') // Button that triggered the modal
            modal.find('#course_name').val(selected_course_name);
            modal.find('#course_type').val(selected_course_type);
            // modal.find('#course_id').val(selected_course_ID);
            console.log(selected_course_ID);
            console.log(selected_course_name);
            console.log(selected_course_type);


        });



        function emptyAlternatives(){
		var table = document.getElementById("alternatives");
			for(var i = 1; i < table.rows.length;)
            {   
               table.deleteRow(i);
            }
		}


    <?php $user_id = 634; ?>
		function populateAlternatives(course_id){
			var table = document.getElementById("alternatives");
            $.get('/alternative-courses/'+course_id+'&'+<?php echo $user_id?>, 
             function(data){
            	var table = document.getElementById("alternatives");
              	table.innerHTML = data;
            });
		}


    

		function addCourseToCell(cell, id, name, type){

        var burger_menu = "<div class=\" d-inline float-right align-middle\">" +
                                            "<div class=\"dropright show\">" +
                                                  "<a href=\"#\" id=\"dropdownMenuLink\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">" +
                                                      "<i class=\"fa fa-ellipsis-v\"></i>" +
                                                  "</a>" +

                                                  "<div class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuLink\">" +
                                                    "<a class=\"dropdown-item\" data-toggle=\"modal\" data-target=\"#courseModal\" data-object=" + id +  " >Course Details</a>" +
                                                    "<a class=\"dropdown-item\" data-toggle=\"modal\" data-target=\"#removeScheduledCourseModal\" data-object=" + id + " data-name=" + name + " data-type=" + type + " >Remove Course</a>" +
                                                  "</div>" +
                                            "</div>" +
                                          "</div> ";
        
        cell.setAttribute("id", id);
				cell.innerHTML = "<div class=\"d-inline align-middle\" id=" + id + " onclick = populateAlternatives(" + id + ")>" + name  +  ' ' +  type + "</div>";
        cell.children[0].insertAdjacentHTML('afterend', burger_menu);
		}
		
		
		function emptyCell(cell){
				cell.removeAttribute("id");
				cell.innerHTML = "";
		}
		
		function checkStartHourIsFirstInInterval(hour_interval, start_hour){
			if(hour_interval.charAt(0) == start_hour.charAt(0) && hour_interval.charAt(1) == start_hour.charAt(1))
				return true;
			if(hour_interval.charAt(0) == start_hour)
				return true;
			return false;
		}
		
		function emptyCellWithID(id){
			var table = document.getElementById("schedule-table");
			
			var r = 1;
			while(row=table.rows[r++]){
				var c = 0;
				while(cell=row.cells[c++]){
          if(cell.children.length == 2){
            if(cell.children[0].getAttribute("id") == id){
              emptyCell(cell);
            }
          }
        }   
      }
    }
		
		
		
		function changeCourse(previous_id, id, name, type, weekday, start_hour, end_hour){
			var table = document.getElementById("schedule-table");
			var row_idx_to_attach = 0;
			var column_idx_to_attach = 0;
			
			
			var r=0; //start counting rows in table
			while(row=table.rows[r++]){
				hour_interval = row.cells[0].innerHTML;
				if(checkStartHourIsFirstInInterval(hour_interval, start_hour))
					row_idx_to_attach = r-1; // row uses r before the incrementation
			}
			
			var c=1; // start counting columns in table
			while(c<=5){
				var day = table.rows[0].cells[c].querySelector('.th-inner ').textContent;
				if (weekday == day)
					column_idx_to_attach = c;
				c++;
				
			}
			
			emptyAlternatives();
			emptyCellWithID(previous_id);
			
			course_length = end_hour - start_hour;
			for(var hours_added = 0; hours_added < course_length; hours_added++){
				var cell = table.rows[row_idx_to_attach + hours_added].cells[column_idx_to_attach];
				addCourseToCell(cell, id, name, type);
			}
			

		}
		


    </script>

<?php
include_once './views/page-parts/Footer.php';
?>