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
  location.href = "/login";
}

$('#courseModal').on('show.bs.modal', function (event){
    var modal = $(this);
    var selected_course_ID = $(event.relatedTarget).data('object') // Button that triggered the modal
    $.get('/schedule/get-course-details', {"scheduled_course_id" : selected_course_ID}, function(data){
      var scheduled_course_json=$.parseJSON(data);
      modal.find('#modal-course-name').text(scheduled_course_json["course_name"]);
      modal.find('#modal-course-type').text("Type: " + scheduled_course_json["course_type"]);
      modal.find('#modal-course-room').text("Room: " + scheduled_course_json["room_name"]);
      // modal.find('#modal-course-professor').text("Professor: ");
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
  console.log(selected_course_ID);
  console.log(selected_course_name);
  console.log(selected_course_type);


});


  $("#remove-course-id").submit(function( event ) {
  event.preventDefault();
  var formData=$("form#remove-course-id").serializeArray();
  const newObject = {};
  for(let i=0; i<formData.length; i++){
    console.log(i);
    newObject[$("form#remove-course-id").serializeArray()[i].name] = $("form#remove-course-id").serializeArray()[i].value;

  }
  console.log("My object is:");
  console.log(newObject);

  $.post( "/schedule/delete-course", newObject,function( data ) {
    console.log(data);
    if(data!==""){
      location.reload();
      alert("Your course was successfully deleted!");
    }

  });
});


function emptyAlternatives(){
  var table = document.getElementById("alternatives");
  for(var i = 1; i < table.rows.length;)
      {   
          table.deleteRow(i);
      }
}

function getCookie(cname) {
  let name = cname + "=";
  let decodedCookie = decodeURIComponent(document.cookie);
  let ca = decodedCookie.split(';');
  for(let i = 0; i <ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

function populateAlternatives(course_id){
  var user_id = getCookie('user_id');
  $.get('/schedule/alternative-courses', {"course_id" : course_id, "user_id" : user_id}, function(data){
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

  $.post( "/schedule/replace-course", {
    "previous_course_id" : previous_id,
    "alternative_course_id":id,
    "course_name":name,
    "course_type":type
  },function( data ) {
    console.log(data);
    if(data!==""){
      location.reload();
      console.log("Success!");
    }
  });
}