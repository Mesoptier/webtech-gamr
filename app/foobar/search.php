<?php

define("GIANTBOMB_APIKEY", "d303fa0d18fd57f59b72ea99938c8a8001ca131a");

function getSearchResults($search, $fields = "name,id", $limit = 5){
    $requestURL = "http://www.giantbomb.com/api/search/"
        . "?api_key=" . GIANTBOMB_APIKEY
        . "&format=json&query=" . $search
        . "&field_list=" . $fields
        . "&limit=" . $limit
        . "&resources=game";

    // Get the data
    $data = json_decode(file_get_contents($requestURL));

    $returnArray = [];

    foreach ($data->results as $result){
        $returnArray[] = [
            "title" => $result->name,
            "slug" => generateSlug($result->name)
        ];
    }

    return $returnArray;
}

function getGameInfo($gameID, $fields=DESIRED_FIELDS){
    $requestURL = "http://www.giantbomb.com/api/game/"
        . $gameID
        . "?api_key=" . GIANTBOMB_APIKEY
        . "&field_list=" . DESIRED_FIELDS
        . "&resources=game"
        . "&format=json";

    // Get the data
    $data = json_decode(file_get_contents($requestURL));
    $returnArray = [];

    //TODO Search trough the array of devs, platforms, franchises to return correct results
    $returnArray = [
        "name" => $data->results->name,
        "image_url" => $data->results->image->medium_url,
        "description" => $data->results->description,
        // "platforms" => $data->results->platforms,
        // "developers" => $data->results->developers,
        // "franchises" => $data->results->franchises,
        // "genres" => $data->results->genres,
        // "similar_games" => $data->results->similar_games
    ];

    return $returnArray;
}

function generateSlug($str){
    $a = array('À','Á','Â','Ã','Ä','Å','Æ','Ç','È','É','Ê','Ë','Ì','Í','Î','Ï','Ð','Ñ','Ò','Ó','Ô','Õ','Ö','Ø','Ù','Ú','Û','Ü','Ý','ß','à','á','â','ã','ä','å','æ','ç','è','é','ê','ë','ì','í','î','ï','ñ','ò','ó','ô','õ','ö','ø','ù','ú','û','ü','ý','ÿ','A','a','A','a','A','a','C','c','C','c','C','c','C','c','D','d','Ð','d','E','e','E','e','E','e','E','e','E','e','G','g','G','g','G','g','G','g','H','h','H','h','I','i','I','i','I','i','I','i','I','i','?','?','J','j','K','k','L','l','L','l','L','l','?','?','L','l','N','n','N','n','N','n','?','O','o','O','o','O','o','Œ','œ','R','r','R','r','R','r','S','s','S','s','S','s','Š','š','T','t','T','t','T','t','U','u','U','u','U','u','U','u','U','u','U','u','W','w','Y','y','Ÿ','Z','z','Z','z','Ž','ž','?','ƒ','O','o','U','u','A','a','I','i','O','o','U','u','U','u','U','u','U','u','U','u','?','?','?','?','?','?');

    $b = array('A','A','A','A','A','A','AE','C','E','E','E','E','I','I','I','I','D','N','O','O','O','O','O','O','U','U','U','U','Y','s','a','a','a','a','a','a','ae','c','e','e','e','e','i','i','i','i','n','o','o','o','o','o','o','u','u','u','u','y','y','A','a','A','a','A','a','C','c','C','c','C','c','C','c','D','d','D','d','E','e','E','e','E','e','E','e','E','e','G','g','G','g','G','g','G','g','H','h','H','h','I','i','I','i','I','i','I','i','I','i','IJ','ij','J','j','K','k','L','l','L','l','L','l','L','l','l','l','N','n','N','n','N','n','n','O','o','O','o','O','o','OE','oe','R','r','R','r','R','r','S','s','S','s','S','s','S','s','T','t','T','t','T','t','U','u','U','u','U','u','U','u','U','u','U','u','W','w','Y','y','Y','Z','z','Z','z','Z','z','s','f','O','o','U','u','A','a','I','i','O','o','U','u','U','u','U','u','U','u','U','u','A','a','AE','ae','O','o');
    return strtolower(preg_replace(array('/[^a-zA-Z0-9 -]/','/[ -]+/','/^-|-$/'),array('','-',''),str_replace($a,$b,$str)));
}