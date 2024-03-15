<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
    header('location: /phpmotors/');
    exit;
}
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
}   
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/style.css">
    <link rel="stylesheet" href="/phpmotors/css/form.css">
    <title>Vehicle Management | PHP Motors</title>
</head>
<body>
    <div id="container">
        <header>
            <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/header.php';?>
        </header>
        <nav>
            <?php echo $navList; ?>
        </nav>
        <main>
            <h1>Vehicle Management</h1>
            <div class="management">
                <ul>
                    <li><a href="/phpmotors/vehicles/index.php?action=add-classification">Add Classification</a></li>
                    <li><a href="/phpmotors/vehicles/index.php?action=add-vehicle">Add Vehicle</a></li>
                </ul>
            </div>
            <?php
            if (isset($message)) { 
                echo $message; 
            } 
            if (isset($classificationList)) { 
                echo '<h2>Vehicles By Classification</h2>'; 
                echo '<p>Choose a classification to see those vehicles</p>'; 
                echo $classificationList; 
            }
            ?>
            <noscript>
            <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
            </noscript>
            <table id="inventoryDisplay"></table>
        </main>
        <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php';?>
        </footer>
    </div>
    <script src="../js/inventory.js"></script>
    <script>
        let text = document.lastModified;
        document.getElementById("lastUpdate").innerHTML = text;
    </script>
</body>
</html><?php unset($_SESSION['message']); ?>