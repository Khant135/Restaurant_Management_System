<?php
	function AddMenu($menuid,$quantity)
	{
		include('connect.php');

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
		if (isset($_SESSION['orderfunction'])) {
			$index=IndexOf($menuid);

			if ($index == -1) {
				$count=count($_SESSION['orderfunction']);

				$_SESSION['orderfunction'][$count]['menuid']=$menuid;
				$_SESSION['orderfunction'][$count]['quantity']=$quantity;

				$_SESSION['orderfunction'][$count]['menuname']=$arr['menuname'];
				$_SESSION['orderfunction'][$count]['price']=$arr['price'];
				$_SESSION['orderfunction'][$count]['image']=$arr['menuimage'];
			}
			else{
				$_SESSION['orderfunction'][$index]['quantity']+=$quantity;
			}
		}
		else{
			$_SESSION['orderfunction']=array();

			$_SESSION['orderfunction'][0]['menuid']=$menuid;
			$_SESSION['orderfunction'][0]['quantity']=$quantity;

			$_SESSION['orderfunction'][0]['menuname']=$arr['menuname'];
			$_SESSION['orderfunction'][0]['price']=$arr['price'];
			$_SESSION['orderfunction'][0]['image']=$arr['menuimage'];			
		}
		echo "<script>window.location='menucart.php'</script>";
	}

	function IndexOf($menuid){
		if (!isset($_SESSION['orderfunction'])) {
			return -1;
		}

		$count=count($_SESSION['orderfunction']);

		if ($count<1) {
			return -1;
		}
		else{
			for ($i=0; $i < $count ; $i++) { 
				
				if ($menuid == $_SESSION['orderfunction'][$i]['menuid']) {
					return $i;
				}
			}
			return -1;
		}
	}

	function CalculateTotalAmount(){
		$TotalAmount=0;

		$count=count($_SESSION['orderfunction']);
		for ($i=0; $i <$count ; $i++) { 
			$price=$_SESSION['orderfunction'][$i]['price'];
			$quantity=$_SESSION['orderfunction'][$i]['quantity'];

			$TotalAmount += ($price * $quantity);
		}
		return $TotalAmount;
	}

	function CalculateTotalQuantity(){
		$TotalQuantity=0;

		$count=count($_SESSION['orderfunction']);
		for ($i=0; $i < $count ; $i++) { 
			$quantity=$_SESSION['orderfunction'][$i]['quantity'];

			$TotalQuantity += ($quantity);
		}
		return $TotalQuantity;
	}

	function RemoveMenu($menuid){
		$index=IndexOf($menuid);

		unset($_SESSION['orderfunction'][$index]);
		$_SESSION['orderfunction']=array_values($_SESSION['orderfunction']);

		echo "<script>window.location='menucart.php'</script>";
	}

	function ClearAll()
	{
		unset($_SESSION['orderfunction']);
		echo "<script>window.location='menucart.php'</script>";
	}
?>