<?php
  session_start();
	include('header.php');
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
            <h1 class="mb-2 bread">Contact Us</h1>
            <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Contact <i class="ion-ios-arrow-forward"></i></span></p>
          </div>
        </div>
      </div>
    </section>
	
		<section class="ftco-section contact-section bg-light">
      <div class="container">
        <div class="row d-flex contact-info">
          <div class="col-md-12 mb-4">
            <h2 class="h4 font-weight-bold">Contact Information</h2>
          </div>
          <div class="w-100"></div>
          <div class="col-md-3 d-flex">
          	<div class="dbox">
	            <p><span>Address:</span> 198 West 21th Street, Suite 721 New York NY 10016</p>
            </div>
          </div>
          <div class="col-md-3 d-flex">
          	<div class="dbox">
	            <p><span>Phone:</span> <a href="tel://0978987564234">0978987564234</a></p>
            </div>
          </div>
          <div class="col-md-3 d-flex">
          	<div class="dbox">
	            <p><span>Email:</span> <a href="mailto:morningrestaurant@gmail.com">morningrestaurant@gmail.com</a></p>
            </div>
          </div>
          <div class="col-md-3 d-flex">
          	<div class="dbox">
	            <p><span>Website:</span> <a href="#">morningrestaurant.com</a></p>
            </div>
          </div>
        </div>
      </div>
    </section>
		<section class="ftco-section ftco-no-pt ftco-no-pb contact-section">
			<div class="container">
				<div class="row d-flex align-items-stretch no-gutters">
					<div class="col-md-6 p-5 order-md-last">
						<h2 class="h4 mb-5 font-weight-bold">Contact Us</h2>
						<form action="#">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Your Name">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Your Email">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Subject">
              </div>
              <div class="form-group">
                <textarea name="" id="" cols="30" rows="7" class="form-control" placeholder="Message"></textarea>
              </div>
              <div class="form-group">
                <input type="submit" value="Send Message" class="btn btn-primary py-3 px-5">
              </div>
            </form>
					</div>
					<div class="col-md-6 d-flex align-items-stretch">
						<div id="map"></div>
					</div>
				</div>
			</div>
		</div>
		
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