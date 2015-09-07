<?php
$siteName = 'Shirts 4 Mike'; ?>

<!DOCTYPE html>
<html>
<head>
    <title><?= $pageTitle ?></title>
    <link rel="stylesheet" href="<?= BASE_URL ?>css/style.css" type="text/css">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,700" type="text/css">
    <link rel="shortcut icon" href="<?= BASE_URL ?>favicon.ico">
</head>
<body>

<div class="header">
    <div class="wrapper">

        <h1 class="branding-title"><a href="<?= BASE_URL ?>"><?= $siteName ?></a></h1>

        <ul class="nav">
           <!-- <li class="about <?/*= 'about' == $section ? 'on' : '' */?>"><a href="<?/*= BASE_URL */?>about/">About</a></li>-->
            <li class="shirts <?= 'shirts' == $section ? 'on' : '' ?>"><a href="<?= BASE_URL ?>shirts/">Shirts</a></li>
            <li class="contact <?= 'contact' == $section ? 'on' : '' ?>"><a href="<?= BASE_URL ?>contact/">Contact</a></li>
            <li class="search <?= 'search' == $section ? 'on' : '' ?>"><a href="<?= BASE_URL ?>search/">Search</a></li>
            <li class="cart"><a href="https://www.paypal.com/cgi-bin/webscr?cmd=_cart&amp;business=Q6NFNPFRBWR8S&amp;display=1">Shopping Cart</a></li>
        </ul>

    </div>
</div>

<div id="content">