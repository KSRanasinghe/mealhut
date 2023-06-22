<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" href="./css/style.css" />
    <link rel="stylesheet" href="./css/bootstrap.css" />
    <link rel="stylesheet" href="./css/alertify.css" />
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" />
</head>

<body>
	<footer class="bg-dark text-light pt-5 pb-4">
		<div class="container text-center text-lg-start">

			<div class="row text-center text-lg-start">

				<div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3 d-none d-lg-block">
					<h5 class="text-uppercase fw-semibold mb-4 text-success">Order Now</h5>
					<hr class="mb-4">
					<?php
					$category_rs = Database::search("SELECT * FROM `category` LIMIT 4");
					$category_num = $category_rs->num_rows;
					if ($category_num > 0) {

						for ($i = 1; $i <= $category_num; $i++) {
							$category_data = $category_rs->fetch_assoc();
							$id = $category_data["id"];
					?>
							<p>
								<a href="menuitem-<?php echo $id; ?>.php" class="text-light text-capitalize" style="text-decoration: none;"><?php echo $category_data["name"]; ?></a>
							</p>
					<?php
						}
					}
					?>
				</div>

				<div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3 d-none d-lg-block">
					<h5 class="text-uppercase mb-4 fw-semibold text-success">Policy</h5>
					<hr class="mb-4">
					<p>
						<a href="terms.php" class="text-light" style="text-decoration: none;">Terms & Conditions</a>
					</p>
					<p>
						<a href="privacy.php" class="text-light" style="text-decoration: none;">Privacy Policy</a>
					</p>
				</div>

				<div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3 d-none d-lg-block">
					<h5 class="text-uppercase mb-4 fw-semibold text-success">about</h5>
					<hr class="mb-4">
					<p>
						<a href="aboutus.php" class="text-light" style="text-decoration: none;">About Us</a>
					</p>
					<p>
						<a href="feedback.php" class="text-light" style="text-decoration: none;">Feedback</a>
					</p>
				</div>

				<div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3 d-none d-lg-block">
					<h5 class="text-uppercase mb-4 fw-semibold text-success">my meal hut</h5>
					<hr class="mb-4">
					<p>
						<a href="signIn.php" class="text-light" style="text-decoration: none;">Sign In / Register</a>
					</p>
				</div>

				<div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3 d-lg-none">
					<h5 class="text-uppercase mb-4 fw-semibold text-success">rapid links</h5>
					<hr class="mb-4">
					<p>
						<a href="menu.php" class="text-light" style="text-decoration: none;">Menu</a>
					</p>
					<p>
						<a href="aboutus.php" class="text-light" style="text-decoration: none;">About Us</a>
					</p>
					<p>
						<a href="terms.php" class="text-light" style="text-decoration: none;">Terms & Conditions</a>
					</p>
					<p>
						<a href="feedback.php" class="text-light" style="text-decoration: none;">Contact Us</a>
					</p>
				</div>

			</div>

			<hr class="mb-4">
			<div class=" row d-flex justify-content-center">
				<div>
					<p class="text-center text-uppercase fw-semibold">follow us on social media</p>
				</div>
				<div class="text-center ">
					<ul class="list-unstyled list-inline">
						<li class="list-inline-item">
							<a href="#" class="text-light"><i class="fab fa-facebook"></i></a>
						</li>
						<li class="list-inline-item">
							<a href="#" class="text-light"><i class="fab fa-instagram"></i></a>
						</li>
					</ul>
				</div>

				<div class="row d-flex justify-content-center d-none d-lg-block">
					<div>
						<p class="text-center" style="font-size: 12px;">
							Copyright &copy; MealHut &trade;. All rights reserved. The MealHut name, logos, and related marks are trademarks of MealHut, Inc.
						</p>
					</div>
				</div>

				<div class=" row d-flex justify-content-center d-lg-none">
					<div>
						<p class="text-center" style="font-size: 13px;">
							Copyright &copy; MealHut Sri Lanka.
						</p>
					</div>
				</div>
			</div>

		</div>
	</footer>


	<script src="scripts/script.js"></script>
</body>

</html>