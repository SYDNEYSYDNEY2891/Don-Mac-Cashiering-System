<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="x-icon" href="assests/images/logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=esc(APP_NAME)?></title>
    <link rel="stylesheet" type="text/css" href="assests/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assests/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="assests/css/main.css">

</head>

<style>
    body {
        background-color: #f9f5f1; /* Light coffee color */
        font-family: 'Arial', sans-serif;
    }
</style>

<body>

    <?php
        $no_nav[] = "login";
    ?>
    <?php if(!in_array($controller, $no_nav)):?>
        <?php require views_path('partials/nav');?>
    <?php endif;?>

    <div class="container-fluid" style="min-width: 350px;">