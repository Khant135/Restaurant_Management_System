<?php
session_start();
include('header.php');
include ('connect.php');
include('orderfunction.php');
include ('autoid_function.php');

if (isset($_POST['btnadd'])) {
	$menuid=$_POST['txtmenuid'];
	$quantity=$_POST['txtquantity'];
    // echo "<script>window.alert('$menuid')</script>";
    // echo "<script>window.alert('$quantity')</script>";
	AddMenu($menuid,$quantity);
}

if (isset($_POST['btncomment'])) {
	$commentid=$_POST['txtcommentid'];
	$menuid1=$_POST['txtmenuid1'];
	$comment=$_POST['txtcomment'];
	$customerid=$_SESSION['customerid'];
	$commentdate=date("Y-m-d");
	$commenttime=date("H:i");
    // echo "<script>window.alert('$customerid')</script>";

	$insert="INSERT INTO comment (commentid,comment,commentdate,commenttime,customerid,menuid)
	VALUES ('$commentid','$comment','$commentdate','$commenttime','$customerid','$menuid1')";
	$result=mysqli_query($connection,$insert);

	if ($result) {
		echo "<script>window.alert('Comment is Successfully Posted!!')</script>";
		echo "<script>window.location='menu.php'</script>";
	}
	else{
		echo "<p>Something went wrong in Posting Comments: ".msqli_error($connection)."</p>";
	}
}

if (isset($_GET['menuid'])) {
	// echo "<script>window.alert('Hello')</script>";
	$menuid=$_GET['menuid'];
	$query="SELECT m.*,c.category as category,r.region as region FROM menu m,category c,region r WHERE m.categoryid=c.categoryid AND m.regionid=r.regionid AND menuid='$menuid'";
	$result=mysqli_query($connection,$query);
	$arr=mysqli_fetch_array($result);

	$query1="SELECT c.*,cu.username as username,cu.image as image,m.menuname as menuname FROM comment c,customer cu,menu m WHERE c.customerid=cu.customerid AND c.menuid=m.menuid AND c.menuid='$menuid'";
	$result1=mysqli_query($connection,$query1);
	$count1=mysqli_num_rows($result1);

}
else{
	$menuid='';
	echo "<script>window.location='menu.php'</script>";
}

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_3.jpg');" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="row no-gutters slider-text align-items-end justify-content-center">
				<div class="col-md-9 ftco-animate text-center">
					<h1 class="mb-2 bread">Our Specialties</h1>
					<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Menu_Detail <i class="ion-ios-arrow-forward"></i></span></p>
				</div>
			</div>
		</div>
	</section>
	
	<section class="ftco-section">
		<div class="container px-4">
			<div class="row justify-content-center mb-5 pb-2">
				<div class="col-md-7 text-center heading-section ftco-animate">
					<span class="subheading">Detail</span>
					<h2 class="mb-4"><?php echo $arr['menuname']; ?></h2>
				</div>
			</div>
			<form action="menudetail.php" method="post">
				<div class="row">
					<div class="col-6">
						<img src="adminpanel/<?php echo $arr['menuimage']; ?>" class="img-fluid rounded mx-auto d-block">
					</div>                
					<div class="col-6">
						<input type="hidden" name="txtmenuid" value="<?php echo $arr['menuid']; ?>">
						<p><span class="font-weight-bold">ID:</span> <?php echo $arr['menuid']; ?></p>
						<p><span class="font-weight-bold">Name:</span> <?php echo $arr['menuname']; ?></p>
						<p><span class="font-weight-bold">Main Ingredient:</span> <?php echo $arr['mainingredient']; ?></p>
						<p><span class="font-weight-bold">Price:</span> <?php echo $arr['price']; ?> $</p>
						<p><span class="font-weight-bold">Category:</span> <?php echo $arr['category']; ?></p>
						<p><span class="font-weight-bold">Region:</span> <?php echo $arr['region']; ?></p>
						<p><span class="font-weight-bold">Description:</span> <?php echo $arr['description']; ?></p>
						<p>
							<span class="font-weight-bold">Quantity:</span> <input type="number" value="1" name="txtquantity">  
							<?php
							if (isset($_SESSION['customerid'])) {
								?>
								<input type="submit" name="btnadd" class="btn btn-primary" value="Add">
								<?php
							}else{
								?>
								<a href="customerlogin.php" name="btnadd" class="btn btn-primary" onclick="loginMessage()">Add</a>
								<?php
							}
							?>
						</p>
					</div>
				</div>
			</form>
			<br>
			<br>
			<form action="menudetail.php" method="post">
				<div class="row">
					<div class="col-md-8">
						<h3 style="text-decoration: underline; font-style: italic;">Comments</h3>
						<input type="hidden" name="txtcommentid" value="<?php echo AutoID('comment','commentid','C-',6) ?>" readonly="">
						<textarea style="width: 100%; height: 100px;" placeholder="Enter Comment" name="txtcomment" required=""></textarea>
						<input type="hidden" name="txtmenuid1" value="<?php echo $arr['menuid']; ?>">
						<?php
						if (isset($_SESSION['customerid'])) {
							?>
							<input type="submit" name="btncomment" class="btn btn-primary" value="Make Comment">
							<?php
						}else{
							?>
							<a href="customerlogin.php" name="btncomment" class="btn btn-primary" onclick="loginMessage()">Make Comment</a>
							<?php
						}
						?>
					</div>
					<div class="col-md-4"></div>
				</div>
				<hr>
				<div class="row">
					<?php
					if ($count1<1) {
						?>
						<div class="col-md-8">
							<p class="text-danger">
								No Comments are Found!!
							</p>
						</div>
						<div class="col-md-4"></div>
						<?php
					}
					else{
						for ($i=0; $i < $count1 ; $i++) { 
							$row1=mysqli_fetch_array($result1);
							$username=$row1['username'];
							$comment=$row1['comment'];
							$commentdate=$row1['commentdate'];
							$commenttime=$row1['commenttime'];
							$image=$row1['image'];
							$currentdate=date("Y-m-d");
							$currenttime=date("H:i");

							?>
							<div class="col-md-8">
								<div class="row">
									<div class="col-md-2">
										<img src="<?php echo $image ?>" style="width: 100px; height: 100px;" class="img-fluid rounded-circle">
									</div>
									<div class="col-md-10">
										<p>
											<h5 style="font-weight: bold;"><?php echo $username; ?></h5>
											<?php echo $commentdate; ?> | <?php echo $commenttime; ?> <br>
											<?php echo $comment; ?>
										</p>										
									</div>
								</div>
							</div>
							<div class="col-md-4"></div>
							<?php
						}
					}
					?>
				</div>
			</form>
		</div>
	</section>

</body>
</html>
<?php
include('footer.php');
?>