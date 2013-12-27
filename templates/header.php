<!DOCTYPE html>

<html lang="en">

    <head>
        <meta charset="utf-8">
        <link href="css/bootstrap.min.css" rel="stylesheet"/>
        <link href="css/bootstrap-theme.min.css" rel="stylesheet"/>
        <link href="css/styles.css" rel="stylesheet"/>

        <?php if (isset($title)): ?>
            <title>C$50 Finance: <?= htmlspecialchars($title) ?></title>
        <?php else: ?>
            <title>C$50 Finance</title>
        <?php endif ?>

        <script src="/cs50_finance/public/js/jquery-1.10.2.min.js"></script>
        <script src="/cs50_finance/public/js/bootstrap.min.js"></script>
        <script src="/cs50_finance/public/js/scripts.js"></script>

    </head>

    <body>

        <div class="container">

            <div id="top">
                <a href="/cs50_finance/public/"><img alt="C$50 Finance" src="/cs50_finance/public/img/logo.gif"/></a>
            </div>

            <div id="middle">
