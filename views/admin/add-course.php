<!-- Add Courses -->
<div class="row course-input justify-content-center mb-5 p-2">
    <form action="./delete-course.php" method="POST">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-4 ">
                <div class="mb-0 px-4">
                    <label class="form-label" for="course-name">Course Name</label>
                </div>
                <div class="px-4 ">
                    <input class="form-input inpt" type="text" name="course-name" id="course-name">
                </div>
            </div>
            <div class="col-4 ">
                <div class="px-3">
                    <label class="form-label" for="course-type">Course type </label>
                </div>
                <div class="px-3 ">
                    <input class="form-input inpt" type="text" name="course-type" id="course-type">

                </div>
            </div>
            <div class="col-3 px-4  d-flex align-bottom">
                <button class="px-4 py-1" name="submit-add-course" type="submit">ADD COURSE</button>
            </div>
        </div>
    </form>
</div>