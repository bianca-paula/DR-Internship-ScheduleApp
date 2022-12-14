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
        <h4 id="confirm-message"> Are you sure you want to delete this course? </h4>

        <form id="remove-course-id" method="POST">
            <label for="course_name">Course name</label><br>
            <input type="text" id="course_name" name="course_name" readonly><br><br>

            <label for="course_type">Course type</label><br>
            <input type="text" id="course_type" name="course_type" readonly>
        </form>
      </div>
      <div class="modal-footer">
        <button form="remove-course-id" type="submit" class="btn btn-primary upload-button">Yes</button>
        <button type="button" class="btn btn-secondary cancel-button ml-auto" data-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>



