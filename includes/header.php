<?php
session_destroy();
?>
<!DOCTYPE html>
<html class="bg-white">
 <head>
    <title><?php echo $page_title ?? "FO Stats"; ?></title>
    
    <meta charset="UTF-8">
    <meta name="description" content="FSU Face Off Statistics">
    <meta name="keywords" content="HTML, CSS, Lacrosse, Faceoff, Stats, FSU, Florida, Florida State, FLorida State University">
    <meta name="author" content="William Couture">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Add css and other resources here -->
    <link rel="stylesheet" type="text/css" href="/css/header/style.css">
    <link rel="stylesheet" type="text/css" href="/css/color/style.css">
    <link rel="stylesheet" type="text/css" href="/css/container/style.css">
    <link rel="stylesheet" type="text/css" href="/css/fonts.css">
    <link rel="stylesheet" type="text/css" href="/css/fonts.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7d42e3bb5d.js" crossorigin="anonymous"></script>

    <link rel="icon" type="image/x-icon" href="/images/fsu-logo.png">

    <?php
        if (is_null($page_css) == false)
            echo $page_css;
    ?>
</head>
 <body class="bebas-neue-regular start">
    <!-- Implement top bar header and navigation here -->
    <!-- <div class="header-bar-container active">
        <div class="header-boxes" id="header-logo">
            <a href="/" class="header-logo-img"><img style="width:auto; height: 100%;" src="/images/FSU-LOGO.webp" alt="Florida State University logo"></a>
        </div>
        <div class="nav-item-container">
            <div class="header-boxes" id="spacer-box">
                SPACER BOX
            </div>
            <div class="header-boxes">
                <a class="nav-item <?php if ($page_title == "Home") echo 'active'; ?>" href="/">Home</a>
            </div>
            <div class="header-boxes">
                <a class="nav-item <?php if ($page_title == "Player List") echo 'active'; ?>" href="/players" >Players</a>
            </div>
            <div class="header-boxes">
                <a class="nav-item <?php if ($page_title == "Game List") echo 'active'; ?>" href="/games" >Games</a>
            </div>
        </div>
        
    </div> -->
    <div id="two-row"class="header-bar-container">
        <div class="header-boxes" id="header-logo">
            <a href="/" class="header-logo-img"><img style="width:100%; height: auto;" src="/images/FSU-LOGO.webp" alt="Florida State University logo"></a>
        </div>
        <div class="nav-item-container">
            <div class="header-boxes">
                <a class="nav-item <?php if ($page_title == "Home") echo 'active'; ?>" href="/">Home</a>
            </div>
            <div class="header-boxes">
                <a class="nav-item <?php if ($page_title == "Player List") echo 'active'; ?>" href="/players" >Players</a>
            </div>
            <div class="header-boxes">
                <a class="nav-item <?php if ($page_title == "Game List") echo 'active'; ?>" href="/games" >Games</a>
            </div>
        </div>
        
    </div>