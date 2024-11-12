<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ovum Doctor</title>
    <link rel="stylesheet" href="../public/stylesheets/main.css">
</head>
<body>
    <header>
        <div class="top-nav">
            <h1>Welcome to Ovum Doctor</h1>
            <h1>Your Doctor</h1>
            <a href="#">Home</a>
            <a href="#">Profile</a>
            <a href="#">Logout</a>
        </div>
        <div class="side-nav">
            <a href="#">Dashboard</a>
            <a href="#">Settings</a>
        </div>
    </header>
    
    <main>
        <?php
        // This is where different sections of the system will be yielded
        // if (isset($content)) {
        //     echo $content;
        // } else {
        //     echo "<p>Content goes here.</p>";
        // } THIS IS THE OLD WAY OF DOING IT
        ?>
        <div id="view-container" class="content-container"></div>
    </main>
    
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Ovum Doctor. All rights reserved.</p>
    </footer>
    <script src="../public/scripts/main.js"></script>
</body>
</html>