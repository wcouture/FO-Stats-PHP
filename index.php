<?php
    $root = $_SERVER["DOCUMENT_ROOT"];
    $page_title = "Home";
    $page_css = '<link rel="stylesheet" type="text/css" href="/css/home.css">';
    include_once($root . "/includes/header.php");
?>
<!-- Padding row between header and main contents -->
<div class="row">
</div>

<!-- Main image and title row -->
<div class="row">
    <div class="box" id="main-image-box">
        <div class="main-image-container">
            <img style="width: 100%; height: auto;" src="/images/fostats-home-image2.png">
        </div>
    </div>
    <div class="box">
        <div class="home-title">
            Florida State
        </div>
        <div class="home-subtitle">
            Lacrosse Face-Off<br>Statistics
        </div>
    </div>
</div>


<div class="row">
</div>
<div class="row">
</div>


<!-- Recent games -->
<div class="section-header">
    Recent Games:
</div>
<div class="row"> 
    <?php 
        // Print recent and upcoming games here
    ?>
</div>


<!-- Stat leaders -->
<div class="section-header">
    Stat Leaders:
</div>
<div class="row"> 
    <?php 
        // Print stat leaders here
    ?>
</div>

<?php
include_once $root . "/includes/footer.php";
?>