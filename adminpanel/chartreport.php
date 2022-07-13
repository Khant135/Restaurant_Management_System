<?php
include('../connect.php');

$dataPoints = array();
$statusarray=array("Confirmed","Cancel");
foreach ($statusarray as $value){
	$chart1="SELECT COUNT(reserveid) as reservationcount FROM reservation WHERE confirmbycustomer='$value'";
	$chartresult1=mysqli_query($connection,$chart1);
	$chartcount1=mysqli_num_rows($chartresult1);
	for ($i=0; $i < $chartcount1 ; $i++) { 
		$chartarr1=mysqli_fetch_array($chartresult1);
		$reservationcount=$chartarr1['reservationcount'];
  // echo "<script>window.alert('$confirmbycustomer')</script>";

		array_push($dataPoints, array("label"=>$value,"y"=>$reservationcount));
	}
}

$dataPoints1 = array();
$statusarray1=array("Confirmed","Cancel");
$total="SELECT * FROM reservation";
$totalresult=mysqli_query($connection,$total);
$totalcount=mysqli_num_rows($totalresult);
foreach ($statusarray1 as $value){
	$chart1="SELECT COUNT(reserveid) as reservationcount FROM reservation WHERE confirmbycustomer='$value'";
	$chartresult1=mysqli_query($connection,$chart1);
	$chartcount1=mysqli_num_rows($chartresult1);
	for ($i=0; $i < $chartcount1 ; $i++) { 
		$chartarr1=mysqli_fetch_array($chartresult1);
		$reservationcount=$chartarr1['reservationcount'];
		$reservationpercentage=($reservationcount/$totalcount)*100;
  // echo "<script>window.alert('$reservationpercentage')</script>";

		array_push($dataPoints1, array("label"=>$value,"y"=>$reservationpercentage));
	}
}

$dataPoints2 = array();
$statusarray2=array("Yes","No");
$total1="SELECT * FROM customerorder";
$totalresult1=mysqli_query($connection,$total1);
$totalcount1=mysqli_num_rows($totalresult1);
foreach ($statusarray2 as $value2){
	$chart2="SELECT COUNT(orderid) as ordercount FROM customerorder WHERE cancel='$value2'";
	$chartresult2=mysqli_query($connection,$chart2);
	$chartcount2=mysqli_num_rows($chartresult2);
	for ($i=0; $i < $chartcount2 ; $i++) { 
		$chartarr2=mysqli_fetch_array($chartresult2);
		$ordercount=$chartarr2['ordercount'];
		$orderpercentage=($ordercount/$totalcount1)*100;
		array_push($dataPoints2, array("label"=>$value2,"y"=>$orderpercentage));
	}
}

$dataPoints3 =array();
$table="SELECT COUNT(tableorderid) as tableordercount FROM tableorder";
$tableresult=mysqli_query($connection,$table);
$tablearr=mysqli_fetch_array($tableresult);
$customer="SELECT COUNT(orderid) as ordercount FROM customerorder";
$customerresult=mysqli_query($connection,$customer);
$customerarr=mysqli_fetch_array($customerresult);
$totalorder=$tablearr['tableordercount']+$customerarr['ordercount'];
$tableper=($tablearr['tableordercount']/$totalorder)*100;
$cusper=($customerarr['ordercount']/$totalorder)*100;
// echo "<script>window.alert('$totalorder')</script>";
$ordertype=array("Table Order","Online Order");
array_push($dataPoints3, array("label"=>'Table Order',"y"=>$tableper));
array_push($dataPoints3, array("label"=>'Online Order',"y"=>$cusper));

$dataPoints4=array();
$menu="SELECT * FROM menu";
$menuresult=mysqli_query($connection,$menu);
$count=mysqli_num_rows($menuresult);
// echo "<script>window.alert('$menucount')</script>";
for ($i=0; $i < $count; $i++) { 
	$menuarr=mysqli_fetch_array($menuresult);
	$menuid=$menuarr['menuid'];
	$menuname=$menuarr['menuname'];
	// echo "<script>window.alert('$menuid')</script>";

	$chart3="SELECT COUNT(menuid) as menucount FROM tableorderdetail WHERE menuid='$menuid'";
	$chartresult3=mysqli_query($connection,$chart3);
	$chartcount3=mysqli_num_rows($chartresult3);

	for ($j=0; $j < $chartcount3 ; $j++) { 
		$chartarr3=mysqli_fetch_array($chartresult3);
		$menucount=$chartarr3['menucount'];

		array_push($dataPoints4, array("label"=>$menuname,"y"=>$menucount));
	}
}

$dataPoints5=array();
$menu="SELECT * FROM menu";
$menuresult=mysqli_query($connection,$menu);
$count=mysqli_num_rows($menuresult);
// echo "<script>window.alert('$menucount')</script>";
for ($i=0; $i < $count; $i++) { 
	$menuarr=mysqli_fetch_array($menuresult);
	$menuid=$menuarr['menuid'];
	$menuname=$menuarr['menuname'];
	// echo "<script>window.alert('$menuid')</script>";

	$chart4="SELECT COUNT(menuid) as menucount FROM customerorderdetail WHERE menuid='$menuid'";
	$chartresult4=mysqli_query($connection,$chart4);
	$chartcount4=mysqli_num_rows($chartresult4);

	for ($j=0; $j < $chartcount4 ; $j++) { 
		$chartarr4=mysqli_fetch_array($chartresult4);
		$menucount=$chartarr4['menucount'];

		array_push($dataPoints5, array("label"=>$menuname,"y"=>$menucount));
	}
}

$dataPoints6=array();
$customer="SELECT * FROM customer";
$customerresult=mysqli_query($connection,$customer);
$count2=mysqli_num_rows($customerresult);
// echo "<script>window.alert('$menucount')</script>";
for ($i=0; $i < $count2; $i++) { 
	$customerarr=mysqli_fetch_array($customerresult);
	$customerid=$customerarr['customerid'];
	$customername=$customerarr['customername'];
	// echo "<script>window.alert('$customername')</script>";

	$chart5="SELECT COUNT(orderid) as customercount FROM customerorder WHERE customerid='$customerid' AND cancel='No'";
	$chartresult5=mysqli_query($connection,$chart5);
	$chartcount5=mysqli_num_rows($chartresult5);

	for ($j=0; $j < $chartcount5 ; $j++) { 
		$chartarr5=mysqli_fetch_array($chartresult5);
		$customercount=$chartarr5['customercount'];

		array_push($dataPoints6, array("label"=>$customername,"y"=>$customercount));
	}
}

$dataPoints7=array();
$customer="SELECT * FROM customer";
$customerresult=mysqli_query($connection,$customer);
$count3=mysqli_num_rows($customerresult);
// echo "<script>window.alert('$menucount')</script>";
for ($i=0; $i < $count3; $i++) { 
	$customerarr=mysqli_fetch_array($customerresult);
	$customerid=$customerarr['customerid'];
	$customername=$customerarr['customername'];
	// echo "<script>window.alert('$customername')</script>";

	$chart6="SELECT COUNT(reserveid) as reservationcount FROM reservation WHERE customerid='$customerid' AND confirmbyrestaurant='Confirmed' AND confirmbycustomer='Confirmed'";
	$chartresult6=mysqli_query($connection,$chart6);
	$chartcount6=mysqli_num_rows($chartresult6);
	// echo "<script>window.alert('$chartcount6')</script>";

	for ($j=0; $j < $chartcount6 ; $j++) { 
		$chartarr6=mysqli_fetch_array($chartresult6);
		$reservationcount=$chartarr6['reservationcount'];

		array_push($dataPoints7, array("label"=>$customername,"y"=>$reservationcount));
	}
}
?>