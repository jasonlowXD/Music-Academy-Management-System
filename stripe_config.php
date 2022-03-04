<?php
    require ("assets/stripe-php-7.116.0/init.php");

    $publishableKey="pk_test_51KZc3LEuamBM2g34CwD4yPW37AQc0Bg48IgLsmvINoGoNp1n87HCyiyhfwXl97CCD9sUvsV1RXWZBsWoqF75dZc4001cH0Kq0D";

    $secretKey="sk_test_51KZc3LEuamBM2g34rq56XpiAoQ8UHHgbTlxRZDaDK3Mh8vQU8GivMH7zfBXdsnSmpuHjtg7xe0jVVvbWqIrBQevX00aE26yFVy";

    \Stripe\Stripe::setApiKey($secretKey);
?>