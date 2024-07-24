<?php
include_once 'db_fn.php';

function DisplayHome($username){
?>	
			<div class="p-1 mx-auto bg-light rounded-3 col-md-6 alert alert-dismissible fade show">
    	  <div class="container-fluid py-1">
	      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
		    	<h1 class="display-5 fw-bold text-center">Welcome!</h1>
		        <p class="col-md-12 fs-4">
		        	Welcome <?php echo $username; ?> Navigate on the menu for your inventory concerns. Come back to this page for important alerts and announcements.
		        </p>
		      </div>
		    </div>
	
<?php 
}

function DisplayPatientList(){
	
}
?>