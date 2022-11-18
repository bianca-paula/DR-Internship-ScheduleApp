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
        <button type="button" class="btn btn-secondary cancel-button " data-dismiss="modal">Cancel</button>
        <button type="submit" form="leave-form" class="btn btn-primary upload-button ml-auto">Upload</button>
      </div>
    </div>
  </div>
</div>

