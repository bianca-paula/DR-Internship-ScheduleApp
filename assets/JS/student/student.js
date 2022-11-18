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
    $.get('/schedule/get-course-details', {"scheduled_course_id" : selected_course_ID}, function(data){
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
    console.log(selected_course_name);
    var remove_message = "Are you sure you want to remove "+ selected_course_name +" "+selected_course_type+" from your schedule?";
    modal.find('#confirm-message').text(remove_message);

    console.log($('div[data-object="1"]')); 
    $('[data-object="1"]').removeAttr('data-object', 'data-name', 'data-type');
});

function emptyAlternatives(){
  var table = document.getElementById("alternatives");
  for(var i = 1; i < table.rows.length;)
      {   
          table.deleteRow(i);
      }
}

function populateAlternatives(course_id){
  var user_id = "634";
  $.get('/schedule/alternative-courses', {"course_id" : course_id}, function(data){
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