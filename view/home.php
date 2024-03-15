<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/home.css">
    <title>Home | PHP Motors</title>
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
            <h1>Welcome to PHP Motors!</h1>
            <div id="promotion">
                <h2>DMC Delorean</h2>
                <p>3 Cup holders <br>Superman doors <br>Fuzzy dice!</p>
                <div id="ownToday" ></div>
            </div>
            <div id="review">
                <h3>DMC Delorean Reviews</h3>
                <ul>
                    <li>"So fast its almost like traveling in time." (4/5)</li>
                    <li>"Coolest ride on the road." (4/5)</li>
                    <li>"I'm feeling Marty McFly!" (5/5)</li>
                    <li>"The most futuristic ride of our day." (4.5/5)</li>
                    <li>"80' livin and I love it!" (5/5)</li>
                </ul>
            </div>
            <div id="upgrades">
                <h3>Delorean Upgrades</h3>
                <a href="#"><div><img src="images/upgrades/flux-cap.png" alt="Flux Capacitor"></div>Flux Capacitor</a>
                <a href="#"><div><img src="images/upgrades/flame.jpg" alt="Flame Decals"></div>Flame Decals</a>
                <a href="#"><div><img src="images/upgrades/bumper_sticker.jpg" alt="Bumper Stickers"></div>Bumper Stickers</a>
                <a href="#"><div><img src="images/upgrades/hub-cap.jpg" alt="Hub Caps"></div>Hub Caps</a>
            </div>
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