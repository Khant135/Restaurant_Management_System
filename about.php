<?php
  session_start();
	include('header.php');
	include('connect.php');
?>
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
            <h1 class="mb-2 bread">About</h1>
            <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>About <i class="ion-ios-arrow-forward"></i></span></p>
          </div>
        </div>
      </div>
    </section>
	

		<section class="ftco-section ftco-wrap-about ftco-no-pb">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-sm-10 wrap-about ftco-animate text-center">
	          <div class="heading-section mb-4 text-center">
	          	<span class="subheading">About</span>
	            <h2 class="mb-4">Morning Restaurant</h2>
	          </div>
						<p>Our Restaurant offers various kinds of Menus to the Customers. We Guarantee that Ours Foods are Hygienic, Clean & Good for Health. We only use the Base Ingredients that are Fresh & Clean. And We also order those Ingredients from the place that has its own standards. Ours Chefs are also very professional in the Restaurant Field. We only hire the Chef who has the most experienced in the Restaurant Industry. We care about Your's desire on foods & update everytime to match with Customers' Desire.</p>

<!-- 						<div class="video justify-content-center">
							<a href="https://vimeo.com/45830194" class="icon-video popup-vimeo d-flex justify-content-center align-items-center">
  							<span class="ion-ios-play"></span>
	  					</a>
						</div> -->
					</div>
				</div>
			</div>
		</section>

		
	  <section class="ftco-section ftco-counter img" id="section-counter" style="background-image: url(images/bg_4.jpg);" data-stellar-background-ratio="0.5">
	  	<!-- <section class="ftco-section ftco-counter img ftco-no-pt" id="section-counter"> -->
	  		<div class="container">
	  			<div class="row d-md-flex align-items-center justify-content-center">
	  				<div class="col-lg-10">
	  					<div class="row d-md-flex align-items-center">
	  						<div class="col-md d-flex justify-content-center counter-wrap ftco-animate">
	  							<div class="block-18">
	  								<div class="text">
	  									<strong class="number">2</strong>
	  									<span>Years of Experienced</span>
	  								</div>
	  							</div>
	  						</div>
	  						<div class="col-md d-flex justify-content-center counter-wrap ftco-animate">
	  							<div class="block-18">
	  								<div class="text">
	  									<?php
	  									$select="SELECT * FROM customer";
	  									$query=mysqli_query($connection,$select);
	  									$count=mysqli_num_rows($query);
	  									?>
	  									<strong class="number"><?php echo $count ?></strong>
	  									<span>Happy Customers</span>
	  								</div>
	  							</div>
	  						</div>
	  						<div class="col-md d-flex justify-content-center counter-wrap ftco-animate">
	  							<div class="block-18">
	  								<div class="text">
	  									<?php
	  									$select="SELECT * FROM menu";
	  									$query=mysqli_query($connection,$select);
	  									$count=mysqli_num_rows($query);
	  									?>
	  									<strong class="number"><?php echo $count ?></strong>
	  									<span>Menus</span>
	  								</div>
	  							</div>
	  						</div>
	  						<div class="col-md d-flex justify-content-center counter-wrap ftco-animate">
	  							<div class="block-18">
	  								<div class="text">
	  									<?php
	  									$select="SELECT * FROM staff";
	  									$query=mysqli_query($connection,$select);
	  									$count=mysqli_num_rows($query);
	  									?>
	  									<strong class="number"><?php echo $count ?></strong>
	  									<span>Staffs</span>
	  								</div>
	  							</div>
	  						</div>
	  					</div>
	  				</div>
	  			</div>
	  		</div>
	  	</section>

	  	<section class="ftco-section bg-light">
	  		<div class="container">
	  			<div class="row justify-content-center mb-5 pb-2">
	  				<div class="col-md-7 text-center heading-section ftco-animate">
	  					<span class="subheading">Services</span>
	  					<h2 class="mb-4">Catering Services</h2>
	  				</div>
	  			</div>
	  			<div class="row">
	  				<div class="col-md-4 d-flex align-self-stretch ftco-animate text-center">
	  					<div class="media block-6 services d-block">
	  						<div class="icon d-flex justify-content-center align-items-center">
	  							<span class="flaticon-cake"></span>
	  						</div>
	  						<div class="media-body p-2 mt-3">
	  							<h3 class="heading">Birthday Party</h3>
	  							<p>We also accept the events like Birthday Party according to Customer's Desire including Foods & Interiror Design.</p>
	  						</div>
	  					</div>      
	  				</div>
	  				<div class="col-md-4 d-flex align-self-stretch ftco-animate text-center">
	  					<div class="media block-6 services d-block">
	  						<div class="icon d-flex justify-content-center align-items-center">
	  							<span class="flaticon-meeting"></span>
	  						</div>
	  						<div class="media-body p-2 mt-3">
	  							<h3 class="heading">Business Meetings</h3>
	  							<p>We also accept the events like Business Meeting according to Customer's Desire including Foods & Interiror Design..</p>
	  						</div>
	  					</div>    
	  				</div>
	  				<div class="col-md-4 d-flex align-self-stretch ftco-animate text-center">
	  					<div class="media block-6 services d-block">
	  						<div class="icon d-flex justify-content-center align-items-center">
	  							<span class="flaticon-tray"></span>
	  						</div>
	  						<div class="media-body p-2 mt-3">
	  							<h3 class="heading">Wedding Party</h3>
	  							<p>We also accept the events like Wedding Party according to Customer's Desire including Foods & Interiror Design.</p>
	  						</div>
	  					</div>      
	  				</div>
	  			</div>
	  		</div>
	  	</section>

    
	  	<section class="ftco-section">
	  		<div class="container">
	  			<div class="row justify-content-center mb-5 pb-2">
	  				<div class="col-md-7 text-center heading-section ftco-animate">
	  					<span class="subheading">Chef</span>
	  					<h2 class="mb-4">Our Master Chef</h2>
	  				</div>
	  			</div>	
	  			<div class="row">
	  				<?php
	  				$select="SELECT s.*,st.stafftype as stafftype FROM staff s,stafftype st WHERE s.stafftypeid=st.stafftypeid AND (st.stafftype='Head Chef' OR st.stafftype='Chef')";
	  				$query=mysqli_query($connection,$select);
	  				$count=mysqli_num_rows($query);
	  				if ($count<1) {
	  					echo "<p style='color: red;'>No Chef is Found!!</p>";
	  				}
	  				else{
	  					for ($i=0; $i < $count ; $i++) { 
	  						$arr=mysqli_fetch_array($query);
	  						$staffname=$arr['staffname'];
	  						$staffimage=$arr['staffimage'];
	  						$stafftype=$arr['stafftype'];
	  						?>
	  						<div class="col-md-6 col-lg-3 ftco-animate">
	  							<div class="staff">
	  								<div class="img" style="background-image: url(adminpanel/<?php echo $staffimage ?>);"></div>
	  								<div class="text pt-4">
	  									<h3><?php echo $staffname ?></h3>
	  									<span class="position mb-2"><?php echo $stafftype ?></span>
	  									<!-- <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p> -->
	  									<div class="faded">
	  										<!-- <p>I am an ambitious workaholic, but apart from that, pretty simple person.</p> -->
	  										<ul class="ftco-social d-flex">
	  											<li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
	  											<li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
	  											<li class="ftco-animate"><a href="#"><span class="icon-google-plus"></span></a></li>
	  											<li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
	  										</ul>
	  									</div>
	  								</div>
	  							</div>
	  						</div>
	  						<?php
	  					}
	  				}
	  				?>
	  				
	  			</div>
	  		</div>
	  	</section>
		
		<section class="ftco-section ftco-no-pt ftco-no-pb">
			<div class="container-fluid px-0">
				<div class="row no-gutters">
					<div class="col-md">
						<a href="#" class="instagram img d-flex align-items-center justify-content-center" style="background-image: url(images/insta-1.jpg);">
							<span class="ion-logo-instagram"></span>
						</a>
					</div>
					<div class="col-md">
						<a href="#" class="instagram img d-flex align-items-center justify-content-center" style="background-image: url(images/insta-2.jpg);">
							<span class="ion-logo-instagram"></span>
						</a>
					</div>
					<div class="col-md">
						<a href="#" class="instagram img d-flex align-items-center justify-content-center" style="background-image: url(images/insta-3.jpg);">
							<span class="ion-logo-instagram"></span>
						</a>
					</div>
					<div class="col-md">
						<a href="#" class="instagram img d-flex align-items-center justify-content-center" style="background-image: url(images/insta-4.jpg);">
							<span class="ion-logo-instagram"></span>
						</a>
					</div>
					<div class="col-md">
						<a href="#" class="instagram img d-flex align-items-center justify-content-center" style="background-image: url(images/insta-5.jpg);">
							<span class="ion-logo-instagram"></span>
						</a>
					</div>
				</div>
			</div>
		</section>

</body>
</html>
<?php
	include('footer.php');
?>