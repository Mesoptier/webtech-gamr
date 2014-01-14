<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <title>Search</title>
    </head>

    <body>
        
    <?php
        define("GIANTBOMB_APIKEY", "d303fa0d18fd57f59b72ea99938c8a8001ca131a");

        //@param:   String (search query)
        //@returns: Array of Arrays
        function getSearchResults($search, $fields = "name,id", $limit = 5){
            // Generate the GiantBomb APU url
            $requestURL = "http://www.giantbomb.com/api/search/"
                . "?api_key=" . GIANTBOMB_APIKEY
                . "&format=json&query=" . $search
                . "&field_list=" . $fields
                . "&limit=" . $limit
                . "&resources=game";

            // Get the data and decode the JSON into an object
            $data = json_decode(file_get_contents($requestURL));

            // Process the json data in an array(title, slug, id) and add it to another array
            $returnArray = [];
            foreach ($data->results as $result){
                $returnArray[] = [
                    "title" => $result->name,
                    "slug" => generateSlug($result->name),
                    "id" => $result->id
                ];
            }

            return $returnArray;
        }

        //@param:   Integer (the GiantBomb game ID)
        //@returns: Mixed Array of Stings and Arrays
        // name,image,platforms,genres,publishers,similar_games,developers
        function getGameInfo($gameID, $fields=""){
            // Generate the GiantBomb APU url
            $requestURL = "http://www.giantbomb.com/api/game/"
                . $gameID
                . "?api_key=" . GIANTBOMB_APIKEY
                . "&field_list=" . $fields
                . "&resources=game"
                . "&format=json";

            // Get the data and decode the JSON into an object
            $data = json_decode(file_get_contents($requestURL));

            // Filter the data and store the info in appropriate variables
            $gameName = $data->results->name;
            $gameImage = $data->results->image->medium_url;
            $gameDescription = $data->results->description;

            $gamePlatforms = [];
            foreach($data->results->platforms as $platform) {
                $gamePlatforms[] = $platform->name;
            }

            $gameDevelopers = [];
            foreach($data->results->developers as $developers) {
                $gameDevelopers[] = $developers->name;
            }
            
            $gamePublishers = [];
            foreach($data->results->publishers as $publishers) {
                $gamePublishers[] = $publishers->name;
            }

            $gameSimilars = [];
            foreach($data->results->similar_games as $similarGames) {
                $gameSimilars[] = [
                    "name" => $similarGames->name,
                    "id" => $similarGames->id
                ];
            }

            $gameFranchises = [];
            foreach($data->results->franchises as $franchises) {
                $gameFranchises[] = $franchises->name;
            }

            $gameGenres = [];
            foreach($data->results->genres as $genres) {
                $gameGenres[] = $genres->name;
            }

            // Add the filtered data to an array and return said array
            $returnArray = [];
            $returnArray = [
                "name" => $gameName,
                "image_url" => $gameImage,
                "description" => $gameDescription,
                "platforms" => $gamePlatforms,
                "developers" => $gameDevelopers,
                "franchises" => $gameFranchises,
                "genres" => $gameGenres,
                "similar_games" => $gameSimilars
            ];

            return $data;
            // return $returnArray;
        }

        //@param:   String
        //@returns: String (A sluggified version of the input sting)
        function generateSlug($str){
            $a = array('À','Á','Â','Ã','Ä','Å','Æ','Ç','È','É','Ê','Ë','Ì','Í','Î','Ï','Ð','Ñ','Ò','Ó','Ô','Õ','Ö','Ø','Ù','Ú','Û','Ü','Ý','ß','à','á','â','ã','ä','å','æ','ç','è','é','ê','ë','ì','í','î','ï','ñ','ò','ó','ô','õ','ö','ø','ù','ú','û','ü','ý','ÿ','A','a','A','a','A','a','C','c','C','c','C','c','C','c','D','d','Ð','d','E','e','E','e','E','e','E','e','E','e','G','g','G','g','G','g','G','g','H','h','H','h','I','i','I','i','I','i','I','i','I','i','?','?','J','j','K','k','L','l','L','l','L','l','?','?','L','l','N','n','N','n','N','n','?','O','o','O','o','O','o','Œ','œ','R','r','R','r','R','r','S','s','S','s','S','s','Š','š','T','t','T','t','T','t','U','u','U','u','U','u','U','u','U','u','U','u','W','w','Y','y','Ÿ','Z','z','Z','z','Ž','ž','?','ƒ','O','o','U','u','A','a','I','i','O','o','U','u','U','u','U','u','U','u','U','u','?','?','?','?','?','?');

            $b = array('A','A','A','A','A','A','AE','C','E','E','E','E','I','I','I','I','D','N','O','O','O','O','O','O','U','U','U','U','Y','s','a','a','a','a','a','a','ae','c','e','e','e','e','i','i','i','i','n','o','o','o','o','o','o','u','u','u','u','y','y','A','a','A','a','A','a','C','c','C','c','C','c','C','c','D','d','D','d','E','e','E','e','E','e','E','e','E','e','G','g','G','g','G','g','G','g','H','h','H','h','I','i','I','i','I','i','I','i','I','i','IJ','ij','J','j','K','k','L','l','L','l','L','l','L','l','l','l','N','n','N','n','N','n','n','O','o','O','o','O','o','OE','oe','R','r','R','r','R','r','S','s','S','s','S','s','S','s','T','t','T','t','T','t','U','u','U','u','U','u','U','u','U','u','U','u','W','w','Y','y','Y','Z','z','Z','z','Z','z','s','f','O','o','U','u','A','a','I','i','O','o','U','u','U','u','U','u','U','u','U','u','A','a','AE','ae','O','o');
            return strtolower(preg_replace(array('/[^a-zA-Z0-9 -]/','/[ -]+/','/^-|-$/'),array('','-',''),str_replace($a,$b,$str)));
        }
    print_r(getGameInfo(16866));

    ?>
    </body>
</html>

