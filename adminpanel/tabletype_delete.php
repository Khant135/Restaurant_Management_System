<?php
	session_start();
	include('../connect.php');

	$tabletypeid=$_GET['tabletypeid'];

	$delete="DELETE FROM tabletype WHERE tabletypeid='$tabletypeid'";
	$result=mysqli_query($connection,$delete);

	if ($result) {
		echo "<script>window.alert('Successfully Deleted!!')</script>";
		echo "<script>window.location='tabletype_detail.php'</script>";
	}
	else{
		echo "<p>Something went wrong in TableType Delete : " . mysqli_error($connection) . "</p>";		
	}
?>