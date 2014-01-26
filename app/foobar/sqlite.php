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
                $db = new SQLite3(__DIR__ . '/searches.db');

                $results = $db->query( 
                    'INSERT INTO searches VALUES(' .
                    '\'' .
                    $query .
                    '\',' .
                    time() .
                    ')' 
                );
                
                // Close the DB connection
                $db->close();
            }

            function getLastFiveSearches() {
                // Connect to DB
                $db = new SQLite3('searches.db');

                $results = $db->query(
                    'SELECT * FROM searches ORDER BY time DESC LIMIT 5'
                );
                while($row = $results->fetchArray()) {
                   var_dump($row);
                }
                
                // Close the DB connection
                $db->close();
            }

            registerSearch('fooBar5');
            getLastFiveSearches();
        ?>
    </body>
</html>
