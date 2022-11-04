  
  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.21.1/dist/bootstrap-table.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="StudentPage.css">
    <title>Student Page</title>
</head>

<body>

    <div class="container-fluid">
        <header>
            <div class="row header-container py-3">
                <div class="col-4 logo">
                    <h3>ScheduleApp</h3>
                </div>
                <div class="col-4"></div>
                <div class="col-4">
                    <h3 class="float-right">Username &nbsp;<span onclick="myFunction()"><i class="fa-solid fa-right-from-bracket"></span></i></h3>
                </div>
            </div>
        </header>
        <div class="row px-4 pt-4">
            <div class="col-9">
                <table data-toggle="table" data-height="520">
                    <thead>
                        <tr>
                            <th data-field="hour" data-width="80"><div onclick="myFunction()"><i class="fa fa-download" style="font-size:25px;color: #FFFBD6;"></i></div></th>
                            <th data-field="monday" data-width="150">Monday</th>
                            <th data-field="tuesday" data-width="150">Tuesday</th>
                            <th data-field="wednesday" data-width="150">Wednesday</th>
                            <th data-field="thursday" data-width="150">Thursday</th>
                            <th data-field="friday" data-width="150">Friday</th>
                        </tr>
                    </thead>
                    <tr>
                        <th>8-9</th><td></td><td></td><td></td><td></td><td></td>
                    </tr>
                    <tr>
                        <th>9-10</th><td>AI | 431</td><td>AI | 431</td><td>AI | 431</td><td>AI | 431</td><td>AI | 431</td>
                    </tr>
                    <tr>
                        <th>10-11</th><td></td><td></td><td></td><td></td><td></td>
                    </tr>
                    <tr>
                        <th>11-12</th><td></td><td></td><td></td><td></td><td></td>
                    </tr>
                    <tr>
                        <th>12-13</th><td></td><td></td><td></td><td></td><td></td>
                    </tr>
                    <tr>
                        <th>13-14</th><td></td><td></td><td></td><td></td><td></td>
                    </tr>
                    <tr>
                        <th>14-15</th><td></td><td></td><td></td><td></td><td></td>
                    </tr>
                    <tr>
                        <th>15-16</th><td></td><td></td><td></td><td></td><td></td>
                    </tr>
                    <tr>
                        <th>16-17</th><td></td><td></td><td></td><td></td><td></td>
                    </tr>
                    <tr>
                        <th>17-18</th><td></td><td></td><td></td><td></td><td></td>
                    </tr>
                    <tr>
                        <th>18-19</th><td></td><td></td><td></td><td></td><td></td>
                    </tr>
                    <tr>
                        <th>19-20</th><td></td><td></td><td></td><td></td><td></td>
                    </tr>
                </table>
            </div>
            <div class="col-3">
                <table data-toggle="table" id="alternatives">
                    <tr>
                        <th>Alternatives</th>
                    </tr>
                    <tr>
                        <td>Laborator AI grupa 255</td>
                    </tr>
                    <tr>
                        <td>Laborator AI grupa 256</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="row px-4 pt-4">
            <div class="col-12">
                <button type="button" class="btn btn-primary button-leave" data-toggle="modal" data-target="#exampleModal">
                    Add Medical Leave
                    </button>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                    Course details
                </button>
            </div>
        </div>
    </div>



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
        <p>In order to add a medical leave, please upload the medical document.</p>
        <!-- <label for="medical-leave" class="custom-file-upload">
            Custom Upload
        </label> -->
        <input type="file" id="medical-leave" name="medical-leave">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary cancel-button" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary upload-button">Upload</button>
      </div>
    </div>
  </div>
</div>



<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h2 id="modal-course-name">Course</h2>
        <div id="course-details">
            <p>Type: </p>
            <p>Room: </p>
            <p>Professor: </p>
            <p>Date: </p>
            <p>Time: </p>
        </div>

      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <button type="button" class="btn btn-primary upload-button mr-auto">OK</button>
      </div>
    </div>
  </div>

<div>

    <script>
        function myFunction(){
            alert("Clicked!");
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/bootstrap-table@1.21.1/dist/bootstrap-table.min.js"></script>
    <script src="https://kit.fontawesome.com/aca3ebed9c.js" crossorigin="anonymous"></script>
</body>
</html>