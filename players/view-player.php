<?php 
$root = $_SERVER["DOCUMENT_ROOT"];
$page_title = "Player Details";
$page_css = '<link rel="stylesheet" type="text/css" href="/css/players.css">';

include_once $root . "/includes/header.php";
include $root . "/tools/db-connect.php";

$player_id = $_GET["id"];

$sql = "SELECT * FROM Player WHERE player_id = {$player_id};";
$db = create_db_connection("faceoff");
$results = $db->query($sql);
$row = $results->fetch_assoc();
?>

<div class="player-list-container">
    <div class="page-title-label">
        <?php echo "#" . $row["number"] . " " . $row["name"];?>
    </div>
</div>

<?php 
include_once $root . "/includes/footer.php";
?>