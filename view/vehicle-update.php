<?php
if(!isset($_SESSION['loggedin']) && !($_SESSION['clientData']['clientLevel'])){
    header('Location: /phpmotors/');
}

// Build the classifications option list
$classificationList = '<select name="classificationId" id="classificationId">';
foreach ($classifications as $classification) {
    $classificationList .= "<option value='$classification[classificationId]'";
    if(isset($classificationId)){
        if($classsification['classificationId']===$classificationId){
            $classificationList .= ' selected ';
        }
    } elseif(isset($invInfo['classificationId'])){
        if($classification['classificationId']===$invInfo['classificationId']){
            $classificationList.=' selected ';
        }
    }
    $classificationList .= ">$classification[classificationName]</option>";
}
$classificationList .= '</select>';
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/style.css">
    <link rel="stylesheet" href="/phpmotors/css/form.css">
    <title><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
	 echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
	elseif(isset($invMake) && isset($invModel)) { 
		echo "Modify $invMake $invModel"; }?> | PHP Motors</title>
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
        <h1><?php
            if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
                echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
            elseif(isset($invMake) && isset($invModel)) { 
                echo "Modify$invMake $invModel"; }?></h1>
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
                    <input type="text" name="invMake" id="invMake" <?php if(isset($invMake)){echo "value='$invMake'";} elseif(isset($invInfo['invMake'])){echo "value='$invInfo[invMake]'";}?>  required>
                </div>
                <div>
                    <label for="invModel">Model</label><br>
                    <input type="text" name="invModel" id="invModel" <?php if(isset($invModel)){echo "value='$invModel'";} elseif(isset($invInfo['invModel'])){echo "value='$invInfo[invModel]'";}?>  required>
                </div>
                <div>
                    <label for="invDescription">Description</label><br>
                    <textarea name="invDescription" id="invDescription" cols="20" rows="5" required>
                    <?php if(isset($invDescription)){echo $invDescription;} elseif(isset($invInfo['invDescription'])){echo $invInfo['invDescription'];}?></textarea>
                </div>
                <div>
                    <label for="invImage">Image Path</label><br>
                    <input type="text" name="invImage" id="invImage" value="/images/no-image.png" <?php if(isset($invImage)){echo "value='$invImage'";} elseif(isset($invInfo['invImage'])){echo "value='$invInfo[invImage]'";}?>  required>
                </div>
                <div>
                    <label for="invThumbnail">Thumbnail Path</label><br>
                    <input type="text" name="invThumbnail" id="invThumbnail" value="/images/no-image.png" <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";} elseif(isset($invInfo['invThumbnail'])){echo "value='$invInfo[invThumbnail]'";}?> required>
                </div>
                <div>
                    <label for="invPrice">Price</label><br>
                    <input type="text" name="invPrice" id="invPrice" <?php if(isset($invPrice)){echo "value='$invPrice'";} elseif(isset($invInfo['invPrice'])){echo "value='$invInfo[invPrice]'";}?>  required>
                </div>
                <div>
                    <label for="invStock"># in Stock</label><br>
                    <input type="text" name="invStock" id="invStock" <?php if(isset($invStock)){echo "value='$invStock'";} elseif(isset($invInfo['invStock'])){echo "value='$invInfo[invStock]'";}?>  required>
                </div>
                <div>
                    <label for="invColor">Color</label><br>
                    <input type="text" name="invColor" id="invColor" <?php if(isset($invColor)){echo "value='$invColor'";} elseif(isset($invInfo['invColor'])){echo "value='$invInfo[invColor]'";}?>  required>
                </div>
                <div>
                    <input type="submit" name="submit" id="updateVehicle" value="Update Vehicle">
                    <!-- Add the action name - value pair -->
                    <input type="hidden" name="action" value="updateVehicle">
                    <input type="hidden" name="invId" value="
                    <?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];} 
                    elseif(isset($invId)){ echo $invId; } ?>
                    ">   
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