<?php
if(!isset($_SESSION['loggedin']) ){
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
    <title>Account Management | PHP Motors</title>
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
            <h1>Manage Account</h1>
            <h2>Update Account</h2>
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
            <form action="/phpmotors/accounts/" method="post">
                <div>
                    <label for="clientFirstname">First Name</label><br>
                    <input type="text" name="clientFirstname" id="clientFirstname" required
                    <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";} elseif(isset($clientInfo['clientFirstname'])){echo "value='$clientInfo[clientFirstname]'";}?> >
                </div>
                <div>
                    <label for="clientLastname">Last Name</label><br>
                    <input type="text" name="clientLastname" id="clientLastname" required
                    <?php if(isset($clientLastname)){echo "value='$clientLastname'";} elseif(isset($clientInfo['clientLastname'])){echo "value='$clientInfo[clientLastname]'";}?> >
                </div>
                <div>
                    <label for="clientEmail">Email</label><br>
                    <input type="email" name="clientEmail" id="clientEmail" required
                    <?php if(isset($clientEmail)){echo "value='$clientEmail'";} elseif(isset($clientInfo['clientEmail'])){echo "value='$clientInfo[clientEmail]'";}?> >
                </div>
                <div>
                    <input type="submit" name="submit" value="Update Info">
                    <!-- Add the action name - value pair -->
                    <input type="hidden" name="action" value="updateClient">
                    <input type="hidden" name="clientId" value="
                    <?php if(isset($clientInfo['clientId'])){ echo $clientInfo['clientId'];} 
                    elseif(isset($clientId)){ echo $clientId; } ?>
                    ">   
                </div>
            </form>
            <h2>Update Password</h2>
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
            <p>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</p>
            <p>* Note: Your original password will be changed.</p>
            <form action="/phpmotors/accounts" method="post">
                <div>
                    <label for="clientPassword">Password</label><br>
                    <input type="password" name="clientPassword" id="clientPassword" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
                </div>
                <div>
                    <input type="submit" name="submit" value="Update Password">
                    <!-- Add the action name - value pair -->
                    <input type="hidden" name="action" value="updatePassword">
                    <input type="hidden" name="clientId" value="
                    <?php if(isset($clientInfo['clientId'])){ echo $clientInfo['clientId'];} 
                    elseif(isset($clientId)){ echo $clientId; } ?>
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