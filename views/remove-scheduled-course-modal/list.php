<!-- Modal -->
<div class="modal fade" id="removeScheduledCourseModal" tabindex="-1" role="dialog" aria-labelledby="removeScheduledCourseModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="removeScheduledCourseModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h4 id="confirm-message"> REMOVE </h4>

<!-- 
          <input type="hidden" id="course_id" name="course_id"><br>

          <label for="course_name">Course name</label><br>
          <input type="text" id="course_name" name="course_name"><br><br>

          <label for="course_type">Course type</label><br>
          <input type="text" id="course_type" name="course_type"><br><br> -->
        <form id="remove-course-id" action="/delete-course" method="POST">
            <!-- <label for="course_name">Course name</label><br> -->
            <input type="hidden" id="course_name" name="course_name"><br><br>

            <!-- <label for="course_type">Course type</label><br> -->
            <input type="hidden" id="course_type" name="course_type">
        </form>
      </div>
      <div class="modal-footer">
        <button form="remove-course-id" type="submit" class="btn btn-primary upload-button">Yes</button>
        <button type="button" class="btn btn-secondary cancel-button ml-auto" data-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>

