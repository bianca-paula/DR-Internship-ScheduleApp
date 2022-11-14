<!-- <?php

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

?> -->




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.1.js"
        integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">


    <!-- Fontawesome -->
    <script src="https://kit.fontawesome.com/57ff89206e.js" crossorigin="anonymous"></script>
    <!-- <link href="/views/fontawesome-free-6.2.0-web/css/fontawesome.css" rel="stylesheet">
    <link href="/views/fontawesome-free-6.2.0-web/css/brands.css" rel="stylesheet">
    <link href="/views/fontawesome-free-6.2.0-web/css/solid.css" rel="stylesheet"> -->

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400;500;600;700;900&family=Righteous&display=swap"
        rel="stylesheet">
    <!-- CSS stylesheet -->
    <link rel="stylesheet" href="../../assets/CSS/admin/admin.css">
    <title>Profesor</title>
</head>

<body>
    
    <?php include "../page-parts/header.php"; ?>

    <div class="container-fluid  d-flex justify-content-center">
        <div class="row main d-flex justify-content-center py-0 mx-0 w-100 ">
            <!-- <div class="col"></div> -->

            <div class="col-lg-8 m-5">
                <div class="row ">
                    <div class="col">
                        <?php include './add-course.php'?>

                        <!-- Courses Table -->
                        <?php include './course-table.php' ?>
                    </div>
                </div>


                <!-- Pagination -->
                <?php include './pagination.php' ?>

            </div>

            <!-- Assigned To  -->
            <?php include './assigned-to.php' ?>


        </div>
    </div>

    <!-- Modal on Delete Course -->
    <?php include './delete-modal.php' ?>


    <!-- Modal on See Scheduled -->

    <!-- <div class="modal fade " id="schedule-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header schedule-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">See Scheduled for - <span
                            class="course-title"></span>
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row py-3 px-5">
                        <div class="col mx-0">
                            <table class="w-100" data-toggle="table" id="schedule-table">
                                <thead>
                                    <tr data-height="1" class="table-head">
                                        <th data-field="hour" data-width="80">
                                             <div onclick="download_PDF()">
                                                    <i class="fa fa-download"
                                                        style="font-size:25px;color: #FFFBD6;"></i>
                                                </div>
                                         </th>
                                        <th data-field="monday" data-width="150">Monday</th>
                                        <th data-field="tuesday" data-width="150">Tuesday</th>
                                        <th data-field="wednesday" data-width="150">Wednesday</th>
                                        <th data-field="thursday" data-width="150">Thursday</th>
                                        <th data-field="friday" data-width="150">Friday</th>
                                    </tr>
                                </thead>
                                <tr>
                                    <th>8-9</th>
                                    <td data-row-id="1" data-toggle="modal" data-target="#courseModal"></td>
                                    <td data-row-id="2" data-toggle="modal" data-target="#courseModal"></td>
                                    <td data-row-id="3" data-toggle="modal" data-target="#courseModal">ISS</td>
                                    <td data-row-id="4" data-toggle="modal" data-target="#courseModal"></td>
                                    <td data-row-id="5" data-toggle="modal" data-target="#courseModal">OS</td>
                                </tr>
                                <tr>
                                    <th>9-10</th>
                                    <td class="table-data" data-row-id="6" data-toggle="modal"
                                        data-target="#courseModal">
                                        <div class="container">
                                            <div class="row justify-content-end">
                                                <div class="col-4 justify-content-end">AI</div>
                                                <div class="col-4 justify-content-center">
                                                    <form action="#" method="post">
                                                        <button class="delete-from-schedule" type="submit">
                                                             <p hidden>delete</p> 
                                                             <i class="fa-solid fa-trash-can"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                    <td data-row-id="7" data-toggle="modal" data-target="#courseModal">ASC</td>
                                    <td data-row-id="8" data-toggle="modal" data-target="#courseModal"></td>
                                    <td data-row-id="9" data-toggle="modal" data-target="#courseModal">OS</td>
                                    <td data-row-id="10" data-toggle="modal" data-target="#courseModal"></td>
                                </tr>
                                <tr>
                                    <th>10-11</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>11-12</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>12-13</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>13-14</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>14-15</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>15-16</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>16-17</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>17-18</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>18-19</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>19-20</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
             <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div> 
        </div>
    </div> -->


    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"
        integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk"
        crossorigin="anonymous"></script>

    <script src="../../assets/JS/admin/admin.js"></script>

</body>

</html>