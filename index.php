<?php
/*session_start();
$userid = NULL;
$username = NULL;
$usertype = NULL;
if(isset($_GET['log_out'])){
    unset($_SESSION['userid']);
    unset($_SESSION['myusername']);
    unset($_SESSION['usertype']);
    header("Location: ".$_SERVER['PHP_SELF']);
}elseif(isset($_POST['userid'])){
    $_SESSION['userid'] = $_POST['userid'];
    $_SESSION['myusername'] = $_POST['myusername'];
    $_SESSION['usertype'] = $_POST['usertype'];
    header("Location: user/");
    //$userid = $_POST['userid'];
    /*if ($_SESSION['usertype']=='admin') {
        header("Location: admin/");
    } else {
        header("Location: user/");
    }
}elseif(isset($_SESSION['userid'])){
    header("Location: user/");
    /*if ($_SESSION['usertype']=='admin') {
        header("Location: admin/");
    } else {
        header("Location: user/");
    }
}*/
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Patient Admit/Discharge System</title>
    <link rel="icon" href="favicon_io/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/bootstrap/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <script src="js/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.7.0.min.js"></script>
    <script src="js/user.main.jq.js"></script>
</head>
<body>

<div class="container-fluid">
    <div class="row p-4 pb-0">
        <div class="col">
          <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
            <!-- Navbar content -->
            <div class="container-fluid">
                <a class="navbar-brand" href="#">PatientAdmiting/DischargeSystem</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                  <ul class="navbar-nav">
                    <li class="nav-item">
                      <a class="nav-link active mymenu" aria-current="page" href="#" id="home">Home</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link mymenu" href="#" id="patient">Patient</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link mymenu" href="#" id="edit">Edit</a>
                    </li>
                    <li class="right"><a href="../wgs-project/is?log_out=1" class="nav-link">Logout <i class="fa-solid fa-right-from-bracket fa-sm"></i></a></li>
                  </ul>
                </div>
            </div>
         </nav>
        </div>
    </div>
    <div class="row p-4 pt-0 divdisplay">
        <div class="col-md-9">
          display list patient
        </div>
        <div class="col-md-3">
          display encounters
        </div>
    </div>
</div>
<form class="user">
   <input type="hidden" name="action" class="action" value="">
</form>
</body>
</html>