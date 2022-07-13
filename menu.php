<?php
session_start();
include('header.php');
include ('connect.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style>
		a span:hover{
			color: white;
		}
	</style>
</head>
<body>

	<section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_3.jpg');" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="row no-gutters slider-text align-items-end justify-content-center">
				<div class="col-md-9 ftco-animate text-center">
					<h1 class="mb-2 bread">Our Specialties</h1>
					<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Menu <i class="ion-ios-arrow-forward"></i></span></p>
				</div>
			</div>
		</div>
	</section>
	
	<section class="ftco-section">
		<div class="container-fluid px-4">
			<div class="row justify-content-center mb-5 pb-2">
				<div class="col-md-7 text-center heading-section ftco-animate">
					<span class="subheading">Specialties</span>
					<h2 class="mb-4">Our Menu</h2>
				</div>
			</div>
			<form action="menu.php" method="post">
				<div class="row">
					<div class="col-6 text-left">
						<label>Sort By: </label>
						<select name="cbocategory">
							<option>Choose Category</option>
							<?php
							$fquery="SELECT * FROM category";
							$fresult=mysqli_query($connection,$fquery);
							$fcount=mysqli_num_rows($fresult);
							for ($i=0; $i < $fcount ; $i++) { 
								$frows=mysqli_fetch_array($fresult);
								$categoryid=$frows['categoryid'];
								$category=$frows['category'];
								?>
								<option value="<?= $categoryid?>"><?php echo $category; ?></option>
								<?php
							}
							?>
						</select>
						<input type="submit" name="btnfilter" class="btn btn-primary" value="Filter">
					</div>                
					<div class="col-6 text-right">
						<label>Seach By: </label>
						<input type="search" placeholder="Menu Name" name="txtsearch">
						<input type="submit" name="btnsearch" class="btn btn-primary" value="Search">
					</div>
				</div>
			</form>
			<br>
			<div class="row">

				<?php
				if (isset($_POST['btnfilter'])) {
					$cbocategory=$_POST['cbocategory'];
					$select2="SELECT * FROM menu WHERE categoryid='$cbocategory'";
					$result2=mysqli_query($connection,$select2);
					$count2=mysqli_num_rows($result2);
					if ($count2<0) {
						echo "<p>No Record Found!!</p>";
					}
					else{
						for ($i=0; $i < $count2 ; $i++) { 
							$rows2=mysqli_fetch_array($result2);
							$menuid=$rows2['menuid'];
							$image=$rows2['menuimage'];
							$name=$rows2['menuname'];
							$price=$rows2['price'];
							$main=$rows2['mainingredient'];
							?>
							<div class="col-md-4 col-lg-4 menu-wrap">
								<div class="menus d-flex ftco-animate">
									<div class="menu-img img" style="background-image: url(adminpanel/<?php echo $image ?>);"></div>
									<div class="text">
										<div class="d-flex">
											<div class="one-half">
												<h3><?php echo $name ?></h3>
											</div>
											<div class="one-forth">
												<span class="price"><?php echo $price ?> $</span>
											</div>
										</div>
										<p><span>Main Ingredient:</span> <?php echo $main ?><br><a id="detail" href="menudetail.php?menuid=<?php echo $menuid ?>" style="color: blue;"><span>Detail >></span></a></p>
									</div>
								</div>
							</div>
							<?php
						}
					}

				}
				else if (isset($_POST['btnsearch'])) {
					$txtsearch=$_POST['txtsearch'];
                    // echo "<script>window.alert('Hello')</script>";

					$select1="SELECT * FROM menu WHERE menuname LIKE '%$txtsearch%'";
					$result1=mysqli_query($connection,$select1);
					$count1=mysqli_num_rows($result1);
					if ($count1<0) {
						echo "<p>No Record Found!!</p>";
					}
					else{
						for ($i=0; $i < $count1 ; $i++) { 
							$rows1=mysqli_fetch_array($result1);
							$menuid=$rows1['menuid'];
							$image=$rows1['menuimage'];
							$name=$rows1['menuname'];
							$price=$rows1['price'];
							$main=$rows1['mainingredient'];
							?>
							<div class="col-md-4 col-lg-4 menu-wrap">
								<div class="menus d-flex ftco-animate">
									<div class="menu-img img" style="background-image: url(adminpanel/<?php echo $image ?>);"></div>
									<div class="text">
										<div class="d-flex">
											<div class="one-half">
												<h3><?php echo $name ?></h3>
											</div>
											<div class="one-forth">
												<span class="price"><?php echo $price ?> $</span>
											</div>
										</div>
										<p><span>Main Ingredient:</span> <?php echo $main ?><br><a id="detail" href="menudetail.php?menuid=<?php echo $menuid ?>" style="color: blue;"><span>Detail >></span></a>
									</div>
								</div>
							</div>
							<?php
						}
					}
				}
				else{
					$select="SELECT * FROM menu";
					$query=mysqli_query($connection,$select);
					$count=mysqli_num_rows($query);
					if ($count<0) {
						echo "<p>No Record Found!!</p>";
					}
					else{
						for ($i=0; $i < $count ; $i++) { 
							$rows=mysqli_fetch_array($query);
							$menuid=$rows['menuid'];
							$image=$rows['menuimage'];
							$name=$rows['menuname'];
							$price=$rows['price'];
							$main=$rows['mainingredient'];
							?>
							<div class="col-md-4 col-lg-4 menu-wrap">
								<div class="menus d-flex ftco-animate">
									<div class="menu-img img" style="background-image: url(adminpanel/<?php echo $image ?>);"></div>
									<div class="text">
										<div class="d-flex">
											<div class="one-half">
												<h3><?php echo $name ?></h3>
											</div>
											<div class="one-forth">
												<span class="price"><?php echo $price ?> $</span>
											</div>
										</div>
										<p><span>Main Ingredient:</span> <?php echo $main ?><br><a id="detail" href="menudetail.php?menuid=<?php echo $menuid ?>" style="color: blue;"><span>Detail >></span></a>
									</div>

								</div>
							</div>
							<?php
						}
					}
				}
				?>


			</div>
		</div>
	</section>

</body>
</html>
<?php
include('footer.php');
?>