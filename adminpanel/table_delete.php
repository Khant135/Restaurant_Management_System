<?php
	session_start();
	include('../connect.php');
	include('autoid_function.php');

	$tableid=$_GET['tableid'];

	$delete="DELETE FROM restauranttable WHERE tableid='$tableid'";
	$result=mysqli_query($connection,$delete);

	if ($result) {
		echo "<script>window.alert('Successfully Deleted!!')</script>";
		echo "<script>window.location='table_detail.php'</script>";
	}
	else{
		echo "<p>Something went wrong in Table Delete : " . mysqli_error($connection) . "</p>";		
	}
?>