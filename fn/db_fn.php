<?php
//session_start();
include_once 'encrypt_fn.php';
function ConnectDB($database){
    $servername = "localhost";
    $username = "root";
    $password = "myphpadminp@ssw0rd";
    //$username = "dbuseronly";
    //$password = 'U$er0nly';
    //$password = "";
    // Create connection
    $conn = mysqli_connect($servername, $username, $password,$database);

    // Check connection
    if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    }else{
        return $conn;
    }
}

function GetPatientList(){
  $conn = ConnectDB('pads_db');
  $sql = 'SELECT * FROM patient ORDER BY `lname`';
  //$sql = 'SELECT * FROM '.$datatb;
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    while( $row = mysqli_fetch_assoc( $result)){
      $row += ["hasdata" => 1]; 
      $new_array[] = $row; // Inside while loop
    }
  }else{
    $new_array[] = ["hasdata"=> 0,"result"=>"no records found"]; // Inside while loop
  }
  mysqli_close($conn);
  return $new_array;
}

function SearchPatient($lname,$fname,$mname){
  $conn = ConnectDB('pads_db');
  $sql = 'SELECT * FROM patient WHERE `lname` LIKE "'.$lname.'%" AND `fname` LIKE "'.$fname.'%" AND `mname` LIKE "'.$mname.'%" ORDER BY `lname`';
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    while( $row = mysqli_fetch_assoc( $result)){
      $row += ["hasdata" => 1]; 
      $new_array[] = $row; // Inside while loop
    }
  }else{
    $new_array[] = ["hasdata"=> 0,"result"=>"no records found"]; // Inside while loop
  }
  mysqli_close($conn);
  return $new_array;
}

function UpdatePatient($profilearray){
    $arrayresult = array();
    $conn = ConnectDB('pads_db');
    if(!$profilearray[5]){
      $sql = 'INSERT INTO patient (fname,mname,lname,suffname,birthdate) 
                          VALUES ("'.$profilearray[0].'","'.$profilearray[1].'","'.$profilearray[2].'","'.$profilearray[3].'","'.$profilearray[4].'"'.')';
    }else{
      $sql = 'UPDATE patient SET fname="'.$profilearray[0].'",mname="'.$profilearray[1].'",lname="'.$profilearray[2].'",
              suffname="'.$profilearray[3].'",birthdate="'.$profilearray[4].'" WHERE id ='.$profilearray[5];      
    }

    if (mysqli_query($conn, $sql)) {
      if($profilearray[5]){
        $arrayresult = ['success'=>'old',
        'result'=>'<div class="alert alert-success alert-dismissible fade show">
                      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                      <strong>Success!</strong> Patient updated succesfully.
                    </div>'];
      }else{
        $arrayresult = ['success'=>'new',
        'result'=>'<div class="alert alert-success alert-dismissible fade show">
                      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                      <strong>Success!</strong> Patient added succesfully.
                    </div>'];
      }
      /*$arrayresult = ['success'=>1,
        'result'=>'<div class="alert alert-success alert-dismissible fade show">
                      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                      <strong>Success!</strong> Product updated succesfully.
                    </div>'];*/
    }else{
        //echo mysqli_error($conn);
      $arrayresult = ['success'=>'non',
        'result'=>'<div class="alert alert-warning alert-dismissible fade show" role="alert">
         <strong>Unsuccessful.</strong> Error on updating product.
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>'];
    }

    mysqli_close($conn);

    return $arrayresult;
}

function GetPatientInfo($dataid){
  $dataarray = array();
  $conn = ConnectDB('pads_db');
  $sql = 'SELECT * FROM patient WHERE id = '.$dataid;
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
  // output data of each row
      while($row = mysqli_fetch_assoc($result)) {
  /*            $row += ["access" => 1];
              $row += ["usertype" => 'admin'];*/
              $row += ["hasdata" => 1];
              $dataarray = $row;

      }
  } else {
      $dataarray = ['hasdata' => 0,
      'result' =>
      '<div class="alert alert-warning alert-dismissible fade show" role="alert">
       <strong>Product not found.</strong> Kindly contact admin to add product.
       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>'
      ];
  }
  mysqli_close($conn);
  return $dataarray;
}

function DeletePatient($dataid){
  $conn = ConnectDB('pads_db');
  $sql_user = 'DELETE FROM patient WHERE id='.$dataid;
  if (mysqli_query($conn, $sql_user)) {
    //echo "Record deleted successfully";
  } else {
    //echo "Error deleting record: " . mysqli_error($conn);
  }
  mysqli_close($conn);
}

function GetPatientStatus($dataid){
  $dataarray = array();
  $conn = ConnectDB('pads_db');
  $sql = 'SELECT * FROM `patient` A, `patient_status` B WHERE A.id = B.patient_id AND B.patient_id ='. $dataid .' ORDER BY `time_admitted` DESC LIMIT 1';
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
  // output data of each row
      while($row = mysqli_fetch_assoc($result)) {
  /*            $row += ["access" => 1];
              $row += ["usertype" => 'admin'];*/
              $row += ["hasdata" => 1];
              $dataarray = $row;

      }
  } else {
      $dataarray = ['hasdata' => 0,
      'result' =>
      '<div class="alert alert-warning alert-dismissible fade show" role="alert">
       <strong>Product not found.</strong> Kindly contact admin to add product.
       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>'
      ];
  }
  mysqli_close($conn);
  return $dataarray;
}

function AddPatientStatus($patientid,$isadmitted,$enteredby){
  $conn = ConnectDB('pads_db');
  $sql = 'INSERT INTO patient_status (patient_id,is_admitted,entered_by) VALUES ('.$patientid.','.$isadmitted.',"'.$enteredby.'")';

  if (mysqli_query($conn, $sql)) {
    $arrayresult = ['success'=>'yes',
        'result'=>'<div class="alert alert-success alert-dismissible fade show">
                      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                      <strong>Success!</strong> Patient Admission updated succesfully.
                    </div>'];
  }else{
    //echo mysqli_error($conn);
    $arrayresult = ['success'=>'non',
        'result'=>'<div class="alert alert-warning alert-dismissible fade show" role="alert">
         <strong>Unsuccessful.</strong> Error on updating product.
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>'];
    }
  mysqli_close($conn);

  return $arrayresult;
}

function GetPatientEncounter($dataid){
  $conn = ConnectDB('pads_db');
  $sql = 'SELECT * FROM `patient_encounter` A, `patient_status` B WHERE A.ps_id = B.id AND A.patient_id ='. $dataid;
  //$sql = 'SELECT * FROM '.$datatb;
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    while( $row = mysqli_fetch_assoc( $result)){
      $row += ["hasdata" => 1]; 
      $new_array[] = $row; // Inside while loop
    }
  }else{
    $new_array[] = ["hasdata"=> 0,"result"=>"no records found"]; // Inside while loop
  }
  mysqli_close($conn);
  return $new_array;
}

function UpdateEncounter($profilearray){
    $arrayresult = array();
    $conn = ConnectDB('pads_db');
    if(!$profilearray[0]){
      $sql = 'INSERT INTO patient_encounter (patient_id,ps_id,encounter,entered_by) 
                          VALUES ('.$profilearray[1].','.$profilearray[2].',"'.$profilearray[3].'","'.$profilearray[3].'")';
    }else{
      $sql = 'UPDATE patient SET fname="'.$profilearray[0].'",mname="'.$profilearray[1].'",lname="'.$profilearray[2].'",
              suffname="'.$profilearray[3].'",birthdate="'.$profilearray[4].'" WHERE id ='.$profilearray[5];      
    }

    if (mysqli_query($conn, $sql)) {
      if($profilearray[0]){
        $arrayresult = ['success'=>'old',
        'result'=>'<div class="alert alert-success alert-dismissible fade show">
                      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                      <strong>Success!</strong> Patient Encounter updated succesfully.
                    </div>'];
      }else{
        $arrayresult = ['success'=>'new',
        'result'=>'<div class="alert alert-success alert-dismissible fade show">
                      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                      <strong>Success!</strong> Patient Encounter added succesfully.
                    </div>'];
      }
      /*$arrayresult = ['success'=>1,
        'result'=>'<div class="alert alert-success alert-dismissible fade show">
                      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                      <strong>Success!</strong> Product updated succesfully.
                    </div>'];*/
    }else{
        //echo mysqli_error($conn);
      $arrayresult = ['success'=>'non',
        'result'=>'<div class="alert alert-warning alert-dismissible fade show" role="alert">
         <strong>Unsuccessful.</strong> Error on updating product.
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>'];
    }

    mysqli_close($conn);

    return $arrayresult;
}

?>