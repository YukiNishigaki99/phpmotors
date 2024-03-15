<?php 
if(!isset($_SESSION['loggedin']) && !($_SESSION['clientData']['clientLevel'])){
    header('Location: /phpmotors/');
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/style.css">
    <link rel="stylesheet" href="/phpmotors/css/form.css">
    <title>Add Classification | PHP Motors</title>
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
            <h1>Add Classification</h1>
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
            <form action="/phpmotors/vehicles/index.php" method="post">
                <div>
                    <label for="classificationName">Classification Name</label><br>
                    <span>Classification name should be no more than 30 characters.</span><br>
                    <input type="text" name="classificationName" id="classificationName" required pattern="/^.{1,30}$/">
                </div>
                <div>
                    <input type="submit" name="submit" id="addClassificationBtn" value="Add Classification">
                    <!-- Add the action name - value pair -->
                    <input type="hidden" name="action" value="addClassification">
                </div>
            </form>
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