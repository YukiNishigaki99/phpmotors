<?php 
if (!isset($_SESSION['loggedin'])) {
    header('Location: /phpmotors/');
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/style.css">
    <title>Admin | PHP Motors</title>
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
            <?php echo "
                <h1>".$_SESSION['clientData']['clientFirstname'] ." ".$_SESSION['clientData']['clientLastname']." Logged In</h1>";

            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
            }
            echo "
                <ul>
                    <li>First Name: ".$_SESSION['clientData']['clientFirstname']."</li>
                    <li>Last Name: ".$_SESSION['clientData']['clientLastname']."</li>
                    <li>Email: ".$_SESSION['clientData']['clientEmail']."</li>
                </ul>";?>
            <div>
                <h2>Account Management</h2>
                <p>Use this link to update account information</p>
                <a href="../accounts/index.php?action=update-client">Update Account Information</a>
            </div>
            <?php
            if ($_SESSION['clientData']['clientLevel']>1){
                echo "
                <div>
                    <h2>Inventory Management</h2>
                    <p>Use this link to manage the inventory</p>
                    <a href='../vehicles/'>Go To Vehicle Management</a>
                </div>
                ";
            }
            ?>
        </main>
        <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php';?>
        </footer>
    </div>
    <script>
        let text = document.lastModified;
        document.getElementById("lastUpdate").innerHTML = text;
    </script>
</body>


</html>