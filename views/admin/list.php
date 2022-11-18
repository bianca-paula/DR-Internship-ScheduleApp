<!DOCTYPE html>
<html lang="en">

<?php include "./views/page-parts/header.php"; ?>

<body>


    <div class="container-fluid  d-flex justify-content-center">
        <div class="row main d-flex justify-content-center py-0 mx-0 w-100 ">

            <div class="col-lg-8 m-5">
                <div class="row ">
                    <div class="col">
                        <?php include './views/admin/add-course.php' ?>

                        <!-- Courses Table -->
                        <?php
                        include './views/admin/course-table.php' ?>
                    </div>
                </div>


                <!-- Pagination -->
                <?php include './views/admin/pagination.php' ?>

            </div>

            <!-- Assigned To  -->
            <?php include './views/admin/assigned-to.php' ?>


        </div>
    </div>


    <!-- Modal on Delete Course -->
    <?php include './views/admin/delete-modal.php' ?>


    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
    
    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="../../assets/JS/admin/admin.js"></script>

</body>

</html>