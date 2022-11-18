<!DOCTYPE html>
<html lang="en">


<?php include "../page-parts/header.php"; ?>

<body>



    <div class="container mt-4 align-items-center">
        <div class="row m-auto title-color align-items-center p-2">
            <div class="col-1 d-flex justify-content-center">
                <a href="#">
                    <i class="fa-solid fa-caret-left fa-xl"></i>
                </a>
            </div>
            <div class="col-10 d-flex align-content-center justify-content-center">
                <h1 class="fs-5 title-content m-auto">See Scheduled for - <span class="course-title"></span> - <span class="course-type"></span>
                </h1>
            </div>
            <div class="col-1 d-flex justify-content-center ">
                <a href="#">
                    <i class="fa-solid fa-caret-right fa-xl"></i>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <?php include "./table.php"; ?>
            </div>
        </div>
    </div>

    <!-- Modal on Delete Course -->
    <?php include './delete-modal.php' ?>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>

    <script src="../../assets/JS/admin/admin.js"></script>

</body>

</html>