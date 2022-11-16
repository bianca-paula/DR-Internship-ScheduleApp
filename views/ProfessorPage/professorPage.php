<?php

include_once "../../models/Course.php";

$groups = array('231', '232', '233', '234', '235', '236', '237');
$WEEKDAYS = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday');

?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../assets/images/logo_books.png" type="image/icon type">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400;500;600;700;900&family=Righteous&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.7/css/all.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ab-datepicker@latest/css/datepicker.css"
        type="text/css" />
    <link rel="stylesheet" href="../../assets/style/professorPage.css" />


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/ab-datepicker@latest"></script>
    <script src="../ProfessorPage/professorPage.js"></script>

    <title>ScheduleApp</title>
</head>


<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="navbar-left">
            <img src="../../assets/images/logo_books.png" class="img-fluid logo" alt="App Logo">
            <span class="navbar-brand mb-0 h1 navbar-left">ScheduleApp</span>
        </div>

        <div class="navbar-right">
            <span class="navbar-brand mb-0 h1">username</span>
            <span class="material-symbols-outlined logout" onclick="logoutPage()">
                logout
            </span>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="content">
            <div class="row">
                <div class="col-sm-4">

                    <div>
                        <label class="schedule-header list-group-item">Courses to schedule</label>
                    </div>

                    <div class="list-group" id="list-tab" role="tablist">
                        <form method="post">
                        <?php
                        foreach ($groups as $group) {
                        ?>
                            <div class="list">
                                <ul class="list-group-item list-group-item-action" id="<?php print($group) ?>"> <?php print($group) ?> </ul>
                            </div>
                            <?php } ?>
                        </form>



                    </div>

                    <div class="card" id="card">
                        <form method="post" id="card-form">
                            <div class="card-body">
                                <div class="input-group mb-3">
                                    <select class="custom-select" id="select-day">
                                        <option selected>Select day of week</option>
                                        <?php
                                            foreach($WEEKDAYS as $day){
                                        ?>
                                        <option value="1" id="mon"><?php print($day)?></option>
                                        <?php 
                                            } 
                                        ?>
                                    </select>
                                </div>

                                <div class="input-group mb-3">
                                    <select class="custom-select" id="select-hour-interval">
                                        <option selected>Select hour interval</option>
                                        <?php
                                            for($hour = 8; $hour <= 19; $hour++) {
                                        ?>
                                        <option value="1" id="8-9"><?php print $hour; ?>-<?php print ($hour+1) ?></option>
                                        
                                        <?php 
                                            } 
                                        ?>
                                    </select>
                                </div>

                                <div class="input-group mb-3">
                                    <select class="custom-select" id="select-room">
                                        <option selected>Select room</option>
                                        <?php
                                            foreach ($groups as $group) {
                                        ?>
                                        <option value="1" class="room" id="<?php print($group) ?>"><?php print($group) ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                        </form>
                        <div class="button">
                            <input type="submit" form="card-form" value="Schedule" class="card-submit" />
                        </div>

                    </div>

                </div>
            </div>

            <div class="col-sm-8">
                <div class="content-table">
                    <section class="table-responsive">
                        <table class="courses-table table" id="schedule-table">
                            <thead>
                                <tr class="table-head">
                                    <th id="download-icon" scope="col"><i class="fa fa-download" aria-hidden="true" onclick="downloadPDF()"></i></th>
                                    
                                    <?php 
                                        foreach($WEEKDAYS as $day){
                                    ?>
                                    <th scope="col"><?php print($day)?></th>
                                    <?php 
                                        }
                                    ?>

                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                for($hour = 8; $hour <= 19; $hour++) {
                            ?>
                                <tr class="table-left-section">
                                    <th scope="row" class="table-head"><?php print $hour; ?>-<?php print ($hour+1) ?></th>
                                    <td class="row">
                                        <div class="col-sm-10 cell-content">
                                            <p></p>
                                        </div>

                                        <div class="col-sm-2 trash-can">
                                            <a href="#trash" id="showModal" data-toggle="modal"
                                                data-target="#trashModal" data-pesti-attribute="another_attribute">
                                                <span class="material-symbols-outlined trash-icon" id="trash-can">
                                                    delete_sweep
                                                </span>
                                            </a>

                                        </div>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <?php
                            }
                          ?>
                                </tr>
                            </tbody>
                        </table>
                    </section>
                </div>
            </div>
        </div>

        <footer class="footer">
            <div class="alert alert-success alert-dismissible fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                Course was cancelled successfully!
            </div>
            <div class="alert alert-danger alert-dismissible fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                Course could not be cancelled. Try again!
            </div>
        </footer>

    </div>

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" id="close" data-dismiss="modal"><span
                            aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Cancel Course</h4>
                </div>
                <div class="modal-body">
                    <div class="modal-text">
                        <p>In order to cancel “Inteligenta Artificiala” - Seminar with gr. 225, please select a date
                            interval.</p>
                    </div>
                    <div class="modal-col">
                        <form method="post" id="date">
                            <div class="row">
                                <div class="col-sm-4 text">
                                    <label class="date-label" for="date-from">From</label>
                                </div>
                                <div class="col-sm-8 datetime">
                                    <input class="date" type="text" id="fromDateId">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 text">
                                    <label class="date-label" for="date-until">Until</label>
                                </div>
                                <div class="col-sm-8 datetime">
                                    <input class="date" type="text" id="toDateId">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" form="date" value="Submit" class="modal-submit" />
                </div>
            </div>
        </div>
    </div>

</body>

</html>

