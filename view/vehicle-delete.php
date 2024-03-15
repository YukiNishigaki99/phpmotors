<?php
if($_SESSION['clientData']['clientLevel'] < 2){
 header('location: /phpmotors/');
 exit;
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/style.css">
    <link rel="stylesheet" href="/phpmotors/css/form.css">
    <title><?php if(isset($invInfo['invMake'])){ 
	echo "Delete $invInfo[invMake] $invInfo[invModel]";} ?> | PHP Motors</title>
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
        <h1><?php if(isset($invInfo['invMake'])){
            echo "Delete $invInfo[invMake] $invInfo[invModel]";} ?></h1>
        <p>Confirm Vehicle Deletion. The delete is permanent.</p>
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
            <form action="/phpmotors/vehicles/index.php" method="post">
                <div>
                    <label for="classificationId">Classification</label><br>
                    <?php echo $classificationList;?>
                </div>
                <div>
                    <label for="invMake">Make</label><br>
                    <input type="text" name="invMake" id="invMake" readonly <?php if(isset($invInfo['invMake'])){echo "value='$invInfo[invMake]'";}?>>
                </div>
                <div>
                    <label for="invModel">Model</label><br>
                    <input type="text" name="invModel" id="invModel" readonly <?php if(isset($invInfo['invModel'])){echo "value='$invInfo[invModel]'";}?>>
                </div>
                <div>
                    <label for="invDescription">Description</label><br>
                    <textarea name="invDescription" id="invDescription" cols="20" rows="5" readonly>
                    <?php if(isset($invInfo['invDescription'])){echo $invInfo['invDescription'];}?></textarea>
                </div>
                <div>
                    <input type="submit" name="submit" id="deleteVehicle" value="Delete Vehicle">
                    <!-- Add the action name - value pair -->
                    <input type="hidden" name="action" value="deleteVehicle">
                    <input type="hidden" name="invId" value="
                    <?php if(isset($invInfo['invId'])){echo $invInfo['invId'];} ?>">
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