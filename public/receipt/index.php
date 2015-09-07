<?php
require_once '../include/config.php';

$pageTitle = "Thank you for your order!";
$section = "none";

include ROOT_PATH . 'include/header.php'; ?>

	<div class="section page">
		<div class="wrapper">

			<h1>Thank You!</h1>

			<p>Thank you for your payment. Your transaction has been completed, and a receipt
                for your purchase has been emailed to you. You may log into your account at
                <a href="http://www.paypal.com/us">www.paypal.com/us</a> to view details of this transaction.</p>

			<p>Need another shirt already? Visit the <a href="<?= BASE_URL ?>shirts.php">Shirts Listing</a> page again.</p>

		</div>
	</div>

<? include ROOT_PATH . 'include/footer.php'; ?>