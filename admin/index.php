<!DOCTYPE html>
<html>
    <head>
        <title>CMS</title>
        
        <link rel="stylesheet" type="text/css" href="/css/cms.css">
        <link rel="stylesheet" type="text/css" href="/css/fonts.css">
        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">

        <link rel="icon" type="image/x-icon" href="/images/cms.png">
    </head>
<?php
    session_start();

    $root = $_SERVER["DOCUMENT_ROOT"];

    if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == TRUE) {
        include $root . "/admin/cms.php";
        return;
    }

    include_once $root . "/tools/db-connect.php";
    if (isset($_POST["submit"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $db = create_db_connection("faceoff");
        $sql = "SELECT setting_value as user FROM website_settings WHERE setting_name = 'admin_user';";
        $results = $db->query($sql);
        if ($results->num_rows <= 0) {
            die("Error retrieving admin username.");
        }
        $row = $results->fetch_assoc();
        $username = $row["user"];
        
        $sql = "SELECT setting_value as pass FROM website_settings WHERE setting_name = 'admin_pass';";
        $results = $db->query($sql);
        if ($results->num_rows <= 0) {
            die("Error retrieving admin password.");
        }
        $row = $results->fetch_assoc();
        $password = $row["pass"];

        if (strcmp($_POST["username"], $username) != 0 || strcmp($_POST["password"], $password) != 0) {
            echo "<p>Credentials Invalid</p>";
        }
        else {
            unset($username);
            unset($password);
            $_SESSION["logged_in"] = TRUE;
            include $root . "/admin/cms.php";
            return;
        }
    }
?>
    <body>
        <form name="login" action="<?php echo htmlspecialchars($_SERVER[" PHP_SELF "]);?>" method="POST">
            <div class="form-input-container">
                <label>Username:</label>
                <input type="text" name="username" id="username" require>

                <label>Password:</label>
                <input type="password" name="password" id="password" require>

                <input type="submit" name="submit" id="submit">
            </div>
            
        </form>
    </body>
    <footer><a href="https://www.flaticon.com/free-icons/settings" id="gear-icon" title="settings icons">Settings icons created by Freepik - Flaticon</a></footer>    
</html>