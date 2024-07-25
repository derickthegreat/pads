<?php
//session_start();
include_once 'db_fn.php';

function DisplayWelcome($username){
?>	
	<div class="p-1 mx-auto bg-light rounded-3 col-md-6 alert alert-dismissible fade show">
	  <div class="container-fluid py-1">
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    	<h1 class="display-5 fw-bold text-center">Welcome!</h1>
        <p class="col-md-12 fs-4">
        	Welcome <?php echo $username; ?> Navigate on the menu for your patients information. Come back to this page for important alerts and announcements.
        </p>
      </div>
    </div>
<?php 
}

function DisplayPatientList(){
?>
	
	<div class="input-group mb-3 row">
		<input type="text" class="form-control col-lg-4 m-1 lname" placeholder="Last Name" name="lname">
  	<input type="text" class="form-control col-lg-4 m-1 fname" placeholder="First Name" name="fname">
  	<input type="text" class="form-control col-lg-4 m-1 mname" placeholder="Middle Name" name="mname">
	</div>
	<div class='row'>
	  <div class="col-md-12 p-0">
	  	<div class="col-sm-12 p-0 border border-1">
	  		<div class="row m-0">
	  			<div class="p-2 mb-0 bg-secondary text-white col-md-10">Patient List</div>
					<div class="col-md-2 text-center"><button type="button" class="btn btn-primary addpatient m-1" name="addpatient" id="0">Add Patient</button></div>
	  		</div>
				<div class="col table displayPatientSearch">
					<?php DisplayPatientListTable(GetPatientList()); ?>
				</div>
	    </div>
	  </div>
	</div>

<?php
}

function DisplayPatientListTable($dataarray){
?>

	<table class="table table-hover">
			<thead class="table-primary">
			  <tr>
		      <th scope="col">hospital #</th>
		      <th scope="col">last name</th>
		      <th scope="col">first name</th>
		      <th scope="col">middle name</th>
		      <th scope="col">suffix</th>
		      <th scope="col">birthday</th>
		      <th scope="col" class="text-end">View</th>
		      <th scope="col" class="text-end">Edit</th>
		      <th scope="col" class="text-end">✖</th>
		    </tr>
	  	</thead>
	  <tbody>
	  	<?php
		  	foreach ($dataarray as $data) {
		  		if($data['hasdata']){
		  	?>
		    <tr id="patient">
		      <th scope="row"><?php echo $data['id'];?></th>
		      <td scope="row"><?php echo $data['lname'];?></th>
		      <td scope="row"><?php echo $data['fname'];?></th>
		      <td scope="row"><?php echo $data['mname'];?></th>
		      <td scope="row"><?php echo $data['suffname'];?></th>
		      <td scope="row"><?php echo $data['birthdate'];?></th>
  		      <td class="text-end" id="viewpatient"><img class="imgview" id="<?php echo $data['id'];?>" src="img/checklist.png" alt="del"></td>
		      <td class="text-end" id="editpatient"><img class="imgedit" id="<?php echo $data['id'];?>" src="img/edit.png" alt="edit"></td>
		      <td class="text-end" id="delpatient"><img class="imgdel" id="<?php echo $data['id'];?>" src="img/delete.png" alt="del"></td>
		    </tr>
		  <?php 
						}else{
							echo 'no record found';
						}
					}?>
	  </tbody>
	</table>
	<?php
}

function DisplayAddPatient($ifupdate){
	$dataarray = GetPatientInfo($ifupdate);
?>
 <div class="row justify-content-md-center">
  <div class="col col-lg-6">
	  <div class="col-sm-12 p-0 border border-1">
	    <h4 class="p-2 mb-0 bg-info text-white"><?php if($ifupdate){echo 'Update Patient';}else{echo 'Add New Patient';}?></h4>
	    <div class="alert-here pb-0 p-1 mb-0">
	    </div>	
			<form class="row g-3 pt-0 p-1 m-0 form-addnew">
					<input type="hidden" name="action" value="<?php if($ifupdate){echo 'updatepatient';}else{echo 'addnewpatient';}?>">
					<input type="hidden" name="dataid" value="<?php if($ifupdate){echo $ifupdate;}else{echo 0;}?>">

				  <div class="col-md-12">
				    <label for="fname" class="form-label">First Name</label>
				    <input type="text" class="form-control input-data fname" id="fname" name="fname" placeholder="First Name" value="<?php if($ifupdate){echo $dataarray['fname'];}?>" required>
				    <div class="valid-feedback">
				      Looks good!
				    </div>
				    <div class="invalid-feedback">
			        Please provide user name.
				    </div>
				  </div>
				  <div class="col-md-12">
				    <label for="mname" class="form-label">Middle Name</label>
				    <input type="text" class="form-control input-data mname" id="mname" name="mname" placeholder="Middle Name" value="<?php if($ifupdate){echo $dataarray['mname'];}?>" required>
				    <div class="valid-feedback">
				      Looks good!
				    </div>
				    <div class="invalid-feedback">
			        Please provide user name.
				    </div>
				  </div>
				  <div class="col-md-12">
				    <label for="lname" class="form-label">Last Name</label>
				    <input type="text" class="form-control input-data lname" id="lname" name="lname" placeholder="Last Name" value="<?php if($ifupdate){echo $dataarray['lname'];}?>" required>
				    <div class="valid-feedback">
				      Looks good!
				    </div>
				    <div class="invalid-feedback">
			        Please provide user name.
				    </div>
				  </div>
				  <div class="col-md-2">
				    <label for="suffix" class="form-label">Suffix</label>
				    <select class="form-select input-data" name="suffix" id="suffix">
				      <option value=" " disabled>eg. Sr, Jr</option>
				      <option value=" "></option>
				      <option value="Sr" <?php if($ifupdate){if($dataarray['suffname']=='Sr'){echo 'selected';}}?>>Sr</option>
				      <option value="Jr" <?php if($ifupdate){if($dataarray['suffname']=='Jr'){echo 'selected';}}?>>Jr</option>
				      <option value="II" <?php if($ifupdate){if($dataarray['suffname']=='II'){echo 'selected';}}?>>II</option>
				      <option value="III" <?php if($ifupdate){if($dataarray['suffname']=='III'){echo 'selected';}}?>>III</option>
				      <option value="Iv" <?php if($ifupdate){if($dataarray['suffname']=='IV'){echo 'selected';}}?>>IV</option>
				    </select>
				  </div>
				  <div class="col-md-5">
				    <label for="bdate" class="form-label">Birth Date</label>
				    <!-- <input type="hidden" name="hidbdate" value="0000-00-00"> -->
				    <div class="input-group has-validation">
				      <span class="input-group-text" id="inputGroupPrepend3" style="font-size: 15px;">📅</span>
				      <input type="date" class="form-control input-data" id="bdate" name="bdate" value="<?php if($ifupdate){echo $dataarray['birthdate'];}?>" aria-describedby="validationServer03Feedback" required>
				        <div class="valid-feedback">
				          Looks good!
				        </div>
				        <div class="invalid-feedback">
				          Input valid date.
				        </div>
				    </div>
				  </div>			  
				  <div class="col-12">
				    <button class="btn btn-primary submit-user add" type="submit"><?php if($ifupdate){echo 'Update';}else{echo 'Add';}?></button>
				    <button type="button" class="btn btn-secondary back">Back</button>
				  </div>
			</form>
		</div>
	</div>
</div>
<?php
}

function DisplayPatienEncounter($dataid){
	$dataarray = GetPatientInfo($dataid);
	$psarray = GetPatientStatus($dataid);
	$date= new DateTime($dataarray['birthdate']);

 	$bday = new DateTime(date_format($date,"m/d/Y")); // Your date of birth
	$today = new Datetime(date('m/d/y'));
	$diff = $today->diff($bday);

	if(!$psarray['hasdata']){
		AddPatientStatus($dataid,0,$_SESSION['myusername']);
		$psarray = GetPatientStatus($dataid);
	}
?>
<div class="col-md-12 p-0">
	<div class="col-sm-12 p-0 border border-1">
		<div class="p-3 mb-0 bg-secondary text-white">
			<div class="row">
			<div class="col-2">
				Patient ID: <?php echo $dataarray['id'];?>
			</div>
			<div class="col-3">
				<strong><?php echo $dataarray['lname'].', '.$dataarray['fname'].' '.$dataarray['suffname'].', '.$dataarray['mname'];?></strong>
			</div>
			<div class="col-2">
				<strong><?php echo date_format($date,"m/d/Y").' Age: '; printf('%d', $diff->y);?></strong>
			</div>
			<div class="col-5">
				<div class="row">
					<div class="col-8">
					<?php if($psarray['is_admitted']){echo 'Admitted: '. $psarray['time_admitted'];}else{ echo 'Last Admitted: '.$psarray['time_admitted'];}?>	
					</div>
					<div class="col-4">
					<?php if($psarray['is_admitted'] == 0){?><button type="button" class="admit btn btn-primary" id="<?php echo $dataid;?>">Admit</button><?php }else{?><button type="button" class="discharge btn btn-primary" id="<?php echo $dataid;?>">Discharge</button><?php }?>
					</div>
				</div>
			</div>      
			</div>
		</div>
		<div class="col-sm-12 p-3 disencounter">
		<?php DisplayPatientEncounter($dataid);?>
		</div>
	</div>
</div>
<form class="form-addstatus">
	<input type="hidden" name="userid" class="userid" value="<?php echo $_SESSION['myusername'];?>">
	<input type="hidden" name="dataid" class="dataid" value="<?php echo $dataid;?>">
	<input type="hidden" name="action" value="addstatus">
	<input type="hidden" name="isadmitted" class="isadmitted" value="">
</form>
<form class="form-displaypatient">
	<input type="hidden" name="dataid" class="dataid" value="<?php echo $dataid;?>">
	<input type="hidden" name="action" value="viewpatient">
</form>
<form class="form-addencounter">
	<input type="hidden" name="userid" class="userid" value="<?php echo $_SESSION['myusername'];?>">
	<input type="hidden" name="dataid" class="dataid" value="<?php echo $dataid;?>">
	<input type="hidden" name="action" value="addencounter">
	<input type="hidden" name="psid" class="psid" value="<?php echo $psarray['id'];?>">
</form>
<?php
}

function DisplayPatientEncounterList($dataarray){
?>
	
	<table class="table table-hover">
			<thead class="table-primary">
			  <tr>
		      <th scope="col">Date/Time</th>
		      <th scope="col">Encounter</th>
		      <th scope="col">Is Admitted</th>
		      <th scope="col">Entered By</th>
		    </tr>
	  	</thead>
	  <tbody>
	  	<?php
		  	foreach ($dataarray as $data) {
		  		if($data['hasdata']){
		  	?>
		    <tr id="patient">
		      <th scope="row"><?php echo $data['time'];?></th>
		      <td scope="row"><?php echo $data['encounter'];?></th>
		      <td scope="row"><?php if($data['is_admitted'] == 0){echo 'NO';}else{ echo 'YES';};?></th>
		      <td scope="row"><?php echo $data['entered_by'];?></th>
		    </tr>
		  <?php 
				}else{
					echo 'no record found';
				}
			}?>
	  </tbody>
	</table>
	<?php
}

function DisplayPatientEncounter($dataid){
?>
	
	<div class='row'>
	  <div class="col-md-12 p-0">
	  	<div class="col-sm-12 p-0 border border-1">
	  		<div class="row m-0">
	  			<div class="p-2 mb-0 bg-secondary text-white col-md-10">Patient Encounter</div>
					<div class="col-md-2 text-center"><button type="button" class="btn btn-primary addencounter m-1" name="addencounter" id="0">Add Encounter</button></div>
	  		</div>
				<div class="col table displayPatientSearch">
					<?php DisplayPatientEncounterList(GetPatientEncounter($dataid)); ?>
				</div>
	    </div>
	  </div>
	</div>

<?php
}

function DisplayAddEncounter($ifupdate,$dataid,$userid,$psid){
	$dataarray = GetPatientEncounter($ifupdate);
?>
 <div class="row justify-content-md-center">
  <div class="col col-lg-6">
	  <div class="col-sm-12 p-0 border border-1">
	    <h4 class="p-2 mb-0 bg-info text-white"><?php if($ifupdate){echo 'Update Encounter';}else{echo 'Add New Encounter';}?></h4>
	    <div class="alert-here pb-0 p-1 mb-0">
	    </div>	
			<form class="row g-3 pt-0 p-1 m-0 form-addnew">
					<input type="hidden" name="action" value="<?php if($ifupdate){echo 'updateencounter';}else{echo 'addnewencounter';}?>">
					<input type="hidden" name="encounterid" value="<?php if($ifupdate){echo $ifupdate;}else{echo 0;}?>">
					<input type="hidden" name="dataid" value="<?php echo $dataid;?>">
					<input type="hidden" name="psid" value="<?php echo $psid;?>">
					<input type="hidden" name="userid" value="<?php echo $userid;?>">

				  <div class="col-md-12">
				  	<label for="encounter" class="form-label">Type Encounter Here:</label>
  					<textarea class="form-control input-data" id="encounter" rows="3" name="encounter" required></textarea>
  				  </div>
				  <div class="col-12">
				    <button class="btn btn-primary submit-user add" type="submit"><?php if($ifupdate){echo 'Update';}else{echo 'Add';}?></button>
				    <button type="button" class="btn btn-secondary backpatient" id="<?php echo $dataid;?>">Back</button>
				  </div>
			</form>
		</div>
	</div>
</div>
<?php
}
?>