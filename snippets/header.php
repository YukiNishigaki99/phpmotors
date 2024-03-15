<img src="/phpmotors/images/site/logo.png" alt="Company Logo">
<?php 
if(isset($_SESSION['loggedin'])){
    echo "<a href='/phpmotors/accounts/index.php'>Welcome ".$_SESSION['clientData']['clientFirstname']."</a>";
    echo '<a href="/phpmotors/accounts/index.php?action=Logout">Log Out</a>';
} elseif(!isset($_SESSION['loggedin'])) {
    echo '<a href="/phpmotors/accounts/index.php?action=login">My Account</a>';
}
?>

