<?php
require_once 'include/config.php';

$pageTitle = 'Unique T-shirts designed by frog';

include ROOT_PATH . 'include/header.php';
include ROOT_PATH . 'include/products.php';

$products = getShirtsList(false, 4);

?>

		<div class="section banner">
			<div class="wrapper">
				<img class="hero" src="<?= BASE_URL ?>img/mike-the-frog.png" alt="Mike the Frog says:">

				<div class="button">
					<a href="<?= BASE_URL ?>shirts/">
						<h2>Hey, I&rsquo;m Mike!</h2>
						<p>Check Out My Shirts</p>
					</a>
				</div>

			</div>
		</div>

		<div class="section shirts latest">
			<div class="wrapper">

				<h2>Mike&rsquo;s Latest Shirts</h2>

				<? include ROOT_PATH . 'include/partials/partial-list.html.php'; ?>

			</div>
		</div>

<? include ROOT_PATH . 'include/footer.php'; ?>
