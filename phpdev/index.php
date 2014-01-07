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
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <title>Gamr</title>

    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Montserrat:400,700'>
    <link rel='stylesheet' href='style.css'>

    <script src='http://code.jquery.com/jquery-2.0.3.min.js'></script>
    <script src='gamr.js'></script>
</head>
<body>
<!--
    <div class='home'>
        <header class='header'>
            <h1 class='logo'><a href='#home'>Gamr</a></h1>
        </header>
        <form class='search-box' method='get'>
            <input class='search-input' type='text' placeholder='Search games...' name='q'>
            <button class='search-button'>Search</button>
        </form>
        <ul class='results hidden'>
            <li class='result-item'>Battlefield 3</li>
            <li class='result-item'>Battlefield 3</li>
            <li class='result-item'>Battlefield 3</li>
        </ul>
    </div>
-->
    <div id='ContentTest'>
        <?php
            ini_set('display_errors', 1);
            error_reporting(E_ALL);
            // Function to search couples of titles and id's from the GiantBomb API
            // @param: search term
            // @returns: a list of tuples with [title, id]
            function searchForTitles($searchterm, $fields, $resultlimit) {
                $apikey = 'd303fa0d18fd57f59b72ea99938c8a8001ca131a';

                $requestURL = 'http://www.giantbomb.com/api/search/'
                    .'?api_key='.$apikey
                    .'&format=json&query='.$searchterm
                    .'&field_list='.$fields
                    .'&limit='.$resultlimit;
                $rawcontent = file_get_contents($requestURL);
                $parsedcontent = json_decode($rawcontent, true);

                //XXX DEBUG -------------------------------------------------------
                // return var_dump($parsedcontent);
                //XXX DEBUG -------------------------------------------------------

                // $numberOfResults = $parsedcontent['number_of_total_results'];
                $numberOfResults = $parsedcontent['number_of_page_results'];
                $returnArray = [];
                
                for ($i = 0; $i < $numberOfResults; $i++) {
                    $currentName    = $parsedcontent['results'][$i]['name'];
                    $currentId      = $parsedcontent['results'][$i]['id'];
                    $returnArray[] = [
                        'name' => $currentName, 
                        'id' => $currentId, 
                        'slug' => gen_slug($currentName)
                    ];
                }

                return $returnArray;
            }

            function gen_slug($str){
                $a = array('À','Á','Â','Ã','Ä','Å','Æ','Ç','È','É','Ê','Ë','Ì','Í','Î','Ï','Ð','Ñ','Ò','Ó','Ô','Õ','Ö','Ø','Ù','Ú','Û','Ü','Ý','ß','à','á','â','ã','ä','å','æ','ç','è','é','ê','ë','ì','í','î','ï','ñ','ò','ó','ô','õ','ö','ø','ù','ú','û','ü','ý','ÿ','A','a','A','a','A','a','C','c','C','c','C','c','C','c','D','d','Ð','d','E','e','E','e','E','e','E','e','E','e','G','g','G','g','G','g','G','g','H','h','H','h','I','i','I','i','I','i','I','i','I','i','?','?','J','j','K','k','L','l','L','l','L','l','?','?','L','l','N','n','N','n','N','n','?','O','o','O','o','O','o','Œ','œ','R','r','R','r','R','r','S','s','S','s','S','s','Š','š','T','t','T','t','T','t','U','u','U','u','U','u','U','u','U','u','U','u','W','w','Y','y','Ÿ','Z','z','Z','z','Ž','ž','?','ƒ','O','o','U','u','A','a','I','i','O','o','U','u','U','u','U','u','U','u','U','u','?','?','?','?','?','?');
                $b = array('A','A','A','A','A','A','AE','C','E','E','E','E','I','I','I','I','D','N','O','O','O','O','O','O','U','U','U','U','Y','s','a','a','a','a','a','a','ae','c','e','e','e','e','i','i','i','i','n','o','o','o','o','o','o','u','u','u','u','y','y','A','a','A','a','A','a','C','c','C','c','C','c','C','c','D','d','D','d','E','e','E','e','E','e','E','e','E','e','G','g','G','g','G','g','G','g','H','h','H','h','I','i','I','i','I','i','I','i','I','i','IJ','ij','J','j','K','k','L','l','L','l','L','l','L','l','l','l','N','n','N','n','N','n','n','O','o','O','o','O','o','OE','oe','R','r','R','r','R','r','S','s','S','s','S','s','S','s','T','t','T','t','T','t','U','u','U','u','U','u','U','u','U','u','U','u','W','w','Y','y','Y','Z','z','Z','z','Z','z','s','f','O','o','U','u','A','a','I','i','O','o','U','u','U','u','U','u','U','u','U','u','A','a','AE','ae','O','o');
                return strtolower(preg_replace(array('/[^a-zA-Z0-9 -]/','/[ -]+/','/^-|-$/'),array('','-',''),str_replace($a,$b,$str)));
            }


            print_r(searchForTitles('battlefield', 'name,id', 8));
        ?>
        
    </div>
</body>
</html>
