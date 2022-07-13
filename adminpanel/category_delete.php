<?php
	session_start();
	include('../connect.php');

	$categoryid=$_GET['categoryid'];

	$delete="DELETE FROM category WHERE categoryid='$categoryid'";
	$result=mysqli_query($connection,$delete);

	if ($result) {
		echo "<script>window.alert('Successfully Deleted!!')</script>";
		echo "<script>window.location='category_detail.php'</script>";
	}
	else{
		echo "<p>Something went wrong in Category Delete : " . mysqli_error($connection) . "</p>";		
	}
?>