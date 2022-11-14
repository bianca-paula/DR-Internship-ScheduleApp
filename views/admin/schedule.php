<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">


    <!-- Fontawesome -->
    <script src="https://kit.fontawesome.com/57ff89206e.js" crossorigin="anonymous"></script>
    <!-- <link href="/views/fontawesome-free-6.2.0-web/css/fontawesome.css" rel="stylesheet">
    <link href="/views/fontawesome-free-6.2.0-web/css/brands.css" rel="stylesheet">
    <link href="/views/fontawesome-free-6.2.0-web/css/solid.css" rel="stylesheet"> -->

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400;500;600;700;900&family=Righteous&display=swap" rel="stylesheet">
    <!-- CSS stylesheet -->
    <link rel="stylesheet" href="../../assets/CSS/admin/admin.css">
    <title>Profesor</title>
</head>

<body>

    <?php include "../page-parts/header.php"; ?>


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
    <div class="modal fade" id="delete-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <h5 class="modal-title"></h5> -->
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                </div>
                <div class="modal-body" id="some-id">
                    Are you sure you want to delete
                    <span class="course-title"></span> - Type <span class="course-type"> ?</span>
                </div>
                <div class="modal-footer justify-content-around">
                    <form action="#" method="post">
                        <button type="submit" class="btn px-4 btn-yes" data-bs-dismiss="modal">Yes</button>
                    </form>
                    <button type="button" class="btn px-4 btn-no" data-bs-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>

    <script src="../../assets/JS/admin/admin.js"></script>

</body>

</html>