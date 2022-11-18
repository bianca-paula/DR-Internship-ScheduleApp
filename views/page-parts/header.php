<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap and Bootstrap Table -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.21.1/dist/bootstrap-table.min.css">
    <!-- Google Fonts && Font Awesome -->
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="./assets/style/style.css">
    <link rel="stylesheet" href="../../assets/CSS/admin/admin.css">



</head>
<div class="container-fluid">
    <header>
        <div class="row header-container py-3 d-flex align-items-center justify-content-center">
            <div class="col-6 d-flex align-items-center justify-content-start ps-4 py-auto">
                <h3><img src="./assets/images/logo_books.png" alt="Logo Books" height="40em">&nbsp;ScheduleApp</h3>
            </div>
            <!-- <div class="col-4"></div> -->
            <div class="col-6 d-flex align-items-center justify-content-end pe-4 py-auto">
                <h3 class="float-right"><?php echo $_COOKIE["user_email"]; ?> &nbsp;<span onclick="logoutPage()"><i class="fa-solid fa-right-from-bracket"></span></i></h3>
            </div>
        </div>
    </header>
</div>