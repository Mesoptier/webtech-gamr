<!--
  ____    _    __  __ ____  
 / ___|  / \  |  \/  |  _ \ 
| |  _  / _ \ | |\/| | |_) |
| |_| |/ ___ \| |  | |  _ < 
 \____/_/   \_\_|  |_|_| \_\

Project:  WebTech GAMR Index File
Date:     06-01-2014
Lang:     Language

Last Edit:        06-01-2014
Version:          0.1

Description:
Description
-->
 
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gamr</title>

    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Montserrat:400,700">
    <link rel="stylesheet" href="style.css">

    <script src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
    <script src="gamr.js"></script>
</head>
<body>
<!--
    <div class="home">
        <header class="header">
            <h1 class="logo"><a href="#home">Gamr</a></h1>
        </header>
        <form class="search-box" method="get">
            <input class="search-input" type="text" placeholder="Search games..." name="q">
            <button class="search-button">Search</button>
        </form>
        <ul class="results hidden">
            <li class="result-item">Battlefield 3</li>
            <li class="result-item">Battlefield 3</li>
            <li class="result-item">Battlefield 3</li>
        </ul>
    </div>
-->
    <div id="ContentTest">
        <?php
            ini_set('display_errors', 1);
            error_reporting(E_ALL);
            // Function to search couples of titles and id's from the GiantBomb API
            // @param: search term
            // @returns: a list of tuples with [title, id]
            function searchForTitles($searchterm, $fields) {
                $apikey = 'd303fa0d18fd57f59b72ea99938c8a8001ca131a';

                $requestURL = 'http://www.giantbomb.com/api/search/?api_key='.$apikey.'&format=json&query='.$searchterm.'&field_list='.$fields;
                $rawcontent = file_get_contents($requestURL);
                $parsedcontent = json_decode($rawcontent, true);

                // TODO 
                // write a piece of code to find the number of results
                $returnraw = false;
                if($returnraw == true) {
                    return var_dump($parsedcontent);
                }
                else {
                     $parsedcontent['results'][4]['name'];
                }
            }

            echo searchForTitles('battlefield', "");
        ?>
        
    </div>
</body>
</html>
