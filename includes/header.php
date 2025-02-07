<!DOCTYPE html>
<html class="bg-white">
 <head>
    <title><?php echo $page_title ?? "FO Stats"; ?></title>
    <!-- Add css and other resources here -->
    <link rel="stylesheet" type="text/css" href="/css/header/style.css">
    <link rel="stylesheet" type="text/css" href="/css/color/style.css">
    <link rel="stylesheet" type="text/css" href="/css/container/style.css">
    <link rel="stylesheet" type="text/css" href="/css/fonts.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <?php
        echo $page_css;
    ?>
</head>
 <body class="bebas-neue-regular">
    <!-- Implement top bar header and navigation here -->
    <div class="header-bar-container">
        <div class="header-boxes" id="header-logo">
            <a href="/home" class="header-logo-img"><img style="width:auto; height: 100%;" src="/images/FSU-LOGO.webp" alt="Florida State University logo"></a>
        </div>
        <div class="header-boxes">
            <a class="nav-item <?php if ($page_title == "Home") echo 'active'; ?>" href="/home">Home</a>
        </div>
        <div class="header-boxes">
            <a class="nav-item <?php if ($page_title == "Players") echo 'active'; ?>" href="/players" >Players</a>
        </div>
        <div class="header-boxes">
            <a class="nav-item <?php if ($page_title == "Games") echo 'active'; ?>" href="/games" >Games</a>
        </div>
    </div>