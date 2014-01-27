<!DOCTYPE HTML>
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
        $returnArray = [];

        $results = $db->query(
            'SELECT * FROM searches ORDER BY time DESC LIMIT 5'
        );
        while($row = $results->fetchArray()) {
           $returnArray[] = $row[0];
        }
        
        return returnArray;
        // Close the DB connection
        $db->close();
    }

?>

