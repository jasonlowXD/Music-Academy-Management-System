<?php
// require("assets/stripe-php-7.116.0/init.php");
require 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$publishableKey = $_ENV['STRIPE_PUBISHABLE_KEY'];

$secretKey = $_ENV['STRIPE_SECRET_KEY'];

\Stripe\Stripe::setApiKey($secretKey);
