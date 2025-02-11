<!DOCTYPE  HTML>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="/css/cms.css">
        <link rel="stylesheet" type="text/css" href="/css/fonts.css">
        <link rel="icon" type="image/x-icon" href="/images/cms.png">
        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
        <title>
            <?php
            echo $page_title ?? "CMS TOOL";
            ?>
        </title>
    </head>
    <body class="bebas-neue-regular">
    <a href="/admin/"><div class="cms-return-link">Return to admin panel</div></a>
        <div class="tool-header">
            <?php
                echo $tool_name;
            ?>
        </div>
        