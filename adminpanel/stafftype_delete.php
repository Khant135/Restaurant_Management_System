<?php
	session_start();
	include('../connect.php');

	$stafftypeid=$_GET['stafftypeid'];

	$delete="DELETE FROM stafftype WHERE stafftypeid='$stafftypeid'";
	$result=mysqli_query($connection,$delete);

	if ($result) {
		echo "<script>window.alert('Successfully Deleted!!')</script>";
		echo "<script>window.location='stafftype_detail.php'</script>";
	}
	else{
		echo "<p>Something went wrong in StaffType Delete : " . mysqli_error($connection) . "</p>";		
	}
?>