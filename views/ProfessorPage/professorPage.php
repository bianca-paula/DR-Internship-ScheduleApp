<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../utils/appLogo/logo_books.png" type="image/icon type">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400;500;600;700;900&family=Righteous&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.7/css/all.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ab-datepicker@latest/css/datepicker.css"
        type="text/css" />
    <link rel="stylesheet" href="../../utils/css/professorPage.css" />


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/ab-datepicker@latest"></script>
    <script src="../ProfessorPage/professorPage.js"></script>

    <title>ScheduleApp</title>
</head>


<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="navbar-left">
            <img src="../../utils/appLogo/logo_books.png" class="img-fluid logo" alt="App Logo">
            <span class="navbar-brand mb-0 h1 navbar-left">ScheduleApp</span>
        </div>

        <div class="navbar-right">
            <span class="navbar-brand mb-0 h1">username</span>
            <span class="material-symbols-outlined">
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
                            <div class="list">
                                <ul class="list-group-item list-group-item-action" id="1">22A - Curs - Inteligenta
                                    artificiala
                                </ul>
                                <ul class="list-group-item list-group-item-action" id="2">13A -Curs - Servere de date
                                </ul>
                                <ul class="list-group-item list-group-item-action" id="3">222 - Seminar - Inteligenta
                                    artificiala </ul>
                                <ul class="list-group-item list-group-item-action" id="4">225 - Seminar - Inteligenta
                                    artificiala</ul>
                                <ul class="list-group-item list-group-item-action" id="5">231 - Laborator - Inteligenta
                                    artificiala</ul>
                                <ul class="list-group-item list-group-item-action" id="6">232 - Laborator - Inteligenta
                                    artificiala</ul>
                                <ul class="list-group-item list-group-item-action" id="7">232 - Laborator - Inteligenta
                                    artificiala</ul>
                                <ul class="list-group-item list-group-item-action" id="8">232 - Laborator - Inteligenta
                                    artificiala</ul>
                                <ul class="list-group-item list-group-item-action" id="9">232 - Laborator - Inteligenta
                                    artificiala</ul>
                                <ul class="list-group-item list-group-item-action" id="10">232 - Laborator - Inteligenta
                                    artificiala</ul>
                            </div>
                        </form>



                    </div>

                    <div class="card" id="card">
                        <form method="post" id="card-form">
                            <div class="card-body">
                                <div class="input-group mb-3">
                                    <select class="custom-select" id="select-day">
                                        <option selected>Select day of week</option>
                                        <option value="1" id="mon">Monday</option>
                                        <option value="2" id="tue">Tuesday</option>
                                        <option value="3" id="wed">Wednesday</option>
                                        <option value="4" id="thu">Thursday</option>
                                        <option value="5" id="fri">Friday</option>
                                    </select>
                                </div>

                                <div class="input-group mb-3">
                                    <select class="custom-select" id="select-hour-interval">
                                        <option selected>Select hour interval</option>
                                        <option value="1" id="8-9">8-9</option>
                                        <option value="2" id="9-10">9-10</option>
                                        <option value="3" id="10-11">10-11</option>
                                        <option value="4" id="11-12">11-12</option>
                                        <option value="5" id="12-13">12-13</option>
                                        <option value="6" id="13-14">13-14</option>
                                        <option value="7" id="14-15">14-15</option>
                                        <option value="8" id="15-16">15-16</option>
                                        <option value="9" id="16-17">16-17</option>
                                        <option value="10" id="17-18">17-18</option>
                                        <option value="11" id="18-19">18-19</option>
                                        <option value="12" id="19-20">19-20</option>
                                    </select>
                                </div>

                                <div class="input-group mb-3">
                                    <select class="custom-select" id="select-room">
                                        <option selected>Select room</option>
                                        <option value="1" class="room" id="505">505</option>
                                        <option value="2" class="room" id="505a">505a</option>
                                        <option value="3" class="room" id="505b">505b</option>
                                        <option value="4" class="room" id="302">302</option>
                                        <option value="5" class="room" id="304">304</option>
                                        <option value="6" class="room" id="H02">H02</option>
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
                        <table class="courses-table table table-bordered">
                            <thead>
                                <tr class="table-head">
                                    <th id="download-icon" scope="col"><i class="fa fa-download" aria-hidden="true"></i>
                                    </th>
                                    <th scope="col">Mon</th>
                                    <th scope="col">Tue</th>
                                    <th scope="col">Wed</th>
                                    <th scope="col">Thu</th>
                                    <th scope="col">Fri</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr class="table-left-section">
                                    <th scope="row" class="table-head">8-9</th>
                                    <td class="row">
                                        <div class="col-sm-10">
                                            <p class="cell-content">225AI - S 505a</p>
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="trash-can">
                                                <a href="#trash" id="showModal" data-toggle="modal"
                                                    data-target="#trashModal" data-pesti-attribute="another_attribute">
                                                    <span class="material-symbols-outlined trash-icon" id="trash-can">
                                                        delete_sweep
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="table-head">9-10</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="table-head">10-11</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="table-head">11-12</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="table-head">12-13</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="table-head">13-14</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="table-head">14-15</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="table-head">15-16</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="table-head">16-17</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="table-head">17-18</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="table-head">18-19</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="table-head">19-20</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </section>
                </div>
            </div>
        </div>
    </div>

</body>

</html>

