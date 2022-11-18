<div class="modal fade " id="delete-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <h5 class="modal-title"></h5> -->
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
            </div>
            <div class="modal-body" id="some-id">
                Are you sure you want to delete:
                <span class="course-id"></span> -
                <span class="course-title"></span> - Type <span class="course-type"> </span>
            </div>
            <div class="modal-footer justify-content-around">
                <form action="./delete-course.php" method="get" id="delete-course">
                    <input class="course-id" name="id" hidden>
                    <button type="submit" name="submit-delete-course" class="btn px-4 btn-yes delete" data-bs-dismiss="modal">Yes</button>
                </form>
                <button type="button" class="btn px-4 btn-no" data-bs-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>

