<?php

    function registerSearch($game) {
        // Connect to DB
        $db = new SQLite3(__DIR__ . '/searches.db');

        $results = $db->query( 
            'INSERT INTO searches VALUES(' .
            SQLite3::escapeString($game["id"]) .
            ',\'' .
            SQLite3::escapeString($game["title"]) .
            '\',' .
            time() .
            ')' 
        );
        
        // Close the DB connection
        $db->close();
    }

    function getLastFiveSearches() {
        // Connect to DB
        $db = new SQLite3(__DIR__ . '/searches.db');
        $returnArray = [];

        $results = $db->query(
            'SELECT * FROM searches GROUP BY id ORDER BY time DESC LIMIT 5'
        );
        while($row = $results->fetchArray()) {
            $returnArray[] = array(
                "id" => $row[0],
                "name" => $row[1],
            );
        }
        
        $db->close();

        return $returnArray;
    }

?>

