<?php
	function AddMenu($menuid,$quantity)
	{
		include('../connect.php');

		$query="SELECT * FROM menu WHERE menuid='$menuid'";
		$result=mysqli_query($connection,$query);
		$count=mysqli_num_rows($result);
		$arr=mysqli_fetch_array($result);

		if ($count<1) {
			echo "<p>No Product Found.</p>";
			exit();
		}
		if ($quantity<1) {
			echo "<p>Incorrect Quantity!!</p>";
			exit();
		}
		if (isset($_SESSION['menuorderfunction'])) {
			$index=IndexOf($menuid);

			if ($index == -1) {
				$count=count($_SESSION['menuorderfunction']);

				$_SESSION['menuorderfunction'][$count]['menuid']=$menuid;
				$_SESSION['menuorderfunction'][$count]['quantity']=$quantity;

				$_SESSION['menuorderfunction'][$count]['menuname']=$arr['menuname'];
				$_SESSION['menuorderfunction'][$count]['price']=$arr['price'];
				$_SESSION['menuorderfunction'][$count]['image']=$arr['menuimage'];
			}
			else{
				$_SESSION['menuorderfunction'][$index]['quantity']+=$quantity;
			}
		}
		else{
			$_SESSION['menuorderfunction']=array();

			$_SESSION['menuorderfunction'][0]['menuid']=$menuid;
			$_SESSION['menuorderfunction'][0]['quantity']=$quantity;

			$_SESSION['menuorderfunction'][0]['menuname']=$arr['menuname'];
			$_SESSION['menuorderfunction'][0]['price']=$arr['price'];
			$_SESSION['menuorderfunction'][0]['image']=$arr['menuimage'];			
		}
		echo "<script>window.location='menucart.php'</script>";
	}

	function IndexOf($menuid){
		if (!isset($_SESSION['menuorderfunction'])) {
			return -1;
		}

		$count=count($_SESSION['menuorderfunction']);

		if ($count<1) {
			return -1;
		}
		else{
			for ($i=0; $i < $count ; $i++) { 
				
				if ($menuid == $_SESSION['menuorderfunction'][$i]['menuid']) {
					return $i;
				}
			}
			return -1;
		}
	}

	function CalculateTotalAmount(){
		$TotalAmount=0;

		$count=count($_SESSION['menuorderfunction']);
		for ($i=0; $i <$count ; $i++) { 
			$price=$_SESSION['menuorderfunction'][$i]['price'];
			$quantity=$_SESSION['menuorderfunction'][$i]['quantity'];

			$TotalAmount += ($price * $quantity);
		}
		return $TotalAmount;
	}

	function CalculateTotalQuantity(){
		$TotalQuantity=0;

		$count=count($_SESSION['menuorderfunction']);
		for ($i=0; $i < $count ; $i++) { 
			$quantity=$_SESSION['menuorderfunction'][$i]['quantity'];

			$TotalQuantity += ($quantity);
		}
		return $TotalQuantity;
	}

	function RemoveMenu($menuid){
		$index=IndexOf($menuid);

		unset($_SESSION['menuorderfunction'][$index]);
		$_SESSION['menuorderfunction']=array_values($_SESSION['menuorderfunction']);

		echo "<script>window.location='menucart.php'</script>";
	}

	function ClearAll()
	{
		unset($_SESSION['menuorderfunction']);
		echo "<script>window.location='menucart.php'</script>";
	}
?>