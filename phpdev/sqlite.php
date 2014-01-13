<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <title>SQLite Test</title>
    </head>

    <body>
        <?php

            function registerSearch($query) {
                // Connect to DB
                $db = new SQLite3('searches.db');

                $results = $db->query('SELECT * FROM searches');
                while($row = $results->fetchArray()) {
                   $hello = var_dump($row);
                }
                
                // Close the DB connection
                $db->close();
            }

            function getTopFiveSearches() {
                // Connect to DB
                $db = new SQLite3('searches.db');

                $results = $db->query('SELECT * FROM searches');
                while($row = $results->fetchArray()) {
                   $hello = var_dump($row);
                }
                
                // Close the DB connection
                $db->close();
            }

            registerSearch("void");


        ?>
    </body>
</html>
