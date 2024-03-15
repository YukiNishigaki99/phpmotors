<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/style.css">
    <title>Server Error | PHP Motors</title>
</head>
<body>
    <div id="container">
        <header>
            <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/header.php';?>
        </header>
        <nav>
            <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/nav.php';?>
        </nav>
        <main>
            <h1>Server Error</h1>
            <p>Sorry our server seems to be experiencing some technical difficulties. 
                Please check back later.</p>
        </main>
        <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php';?>
    </div>
    <script>
        let text = document.lastModified;
        document.getElementById("lastUpdate").innerHTML = text;
    </script>
</body>
</html>