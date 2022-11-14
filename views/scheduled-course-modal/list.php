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
</div>

<?php
include_once './views/medical-leave-modal/list.php'
?>
