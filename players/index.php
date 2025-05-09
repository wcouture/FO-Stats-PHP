<?php 
    $API_FLAG = $_GET["API"];
    $root = $_SERVER["DOCUMENT_ROOT"];

    include $root . "/tools/db-connect.php";

    $sql = "SELECT * FROM Player ORDER BY name;";
    $db = create_db_connection("faceoff");
    $result = $db->query($sql);

    if (isset($API_FLAG)) {
        $data = $result->fetch_all(MYSQLI_ASSOC);
        echo json_encode($data);
    } else {
        $page_title = "Player List";

        $page_css = '<link rel="stylesheet" type="text/css" href="/css/players.css">';

        include_once $root . "/includes/header.php";
        include_once $root . "/tools/server-functions.php";

?>

<div class="page-title-label">Faceoff Players</div>
<div class="player-list-container">
  <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                include $root . "/players/player-card.php";
            }
        }
        else {
            echo "No results";
        }
        $db->close();
    ?>
</div>


<?php
include_once $root . "/includes/footer.php";
}
?>
