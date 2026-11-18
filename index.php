<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My PHP Website</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <h1>Welcome to My Website</h1>
    </header>

    <main>
        <?php
            // PHP code executes on the server before the page loads
            $greeting = "Hello! Today is " . date("l, F j, Y") . ".";
            echo "<p>" . $greeting . "</p>";

            $folder = "html_files/";
            $htmlFiles = glob($folder . "*.html");
             if ($htmlFiles) {
                sort($htmlFiles);
                echo '<ul>';
                foreach ($htmlFiles as $file) {
                    // Get just the filename without the folder path (e.g., "about.html")
                    $fileName = basename($file);
                    
                    // Optional: Make a cleaner display title (e.g., "about.html" -> "About")
                    $displayTitle = ucfirst(pathinfo($fileName, PATHINFO_FILENAME));

                    // Output the HTML list item and anchor tag
                    echo '<li><a href="' . htmlspecialchars($file) . '">' . htmlspecialchars($displayTitle) . '</a></li>';
                }
                echo '</ul>';
            } else {
                echo '<ul>';
                echo "<li>No HTML files found in this folder.</li>";
                echo '</ul>';
            }

        ?>
    </main>

</body>
</html>
