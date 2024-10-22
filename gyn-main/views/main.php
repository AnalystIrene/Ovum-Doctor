<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ovum Doctor</title>
    <link rel="stylesheet" href="path/to/your/styles.css">
</head>
<body>
    <header>
        <h1>Welcome to Ovum Doctor</h1>
        <nav>
            <ul>
                <li><a href="path/to/home">Home</a></li>
                <li><a href="path/to/about">About</a></li>
                <li><a href="path/to/contact">Contact</a></li>
                <!-- Add navigation links here -->
            </ul>
    </header>
    
    <main>
        <?php
        // This is where different sections of the system will be yielded
        if (isset($content)) {
            echo $content;
        } else {
            echo "<p>Content goes here.</p>";
        }
        ?>
    </main>
    
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Ovum Doctor. All rights reserved.</p>
    </footer>
</body>
</html>