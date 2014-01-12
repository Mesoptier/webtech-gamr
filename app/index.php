<?php

require "lib/Slim/Slim.php";
\Slim\Slim::registerAutoloader();

require "foobar/search.php";

// Configurate the app
$app = new \Slim\Slim(array(
    "mode" => "development",
    "debug" => true,

    "templates.path" => "./views"
));

// Set default view variables
$app->view->setData(array(
    "static_path" => $app->request->getRootUri() . "/static/"
));

// Routing
$app->get("/", function() use ($app) {
    $app->render("home.php");
});

$app->get("/game/:slug", function($slug) use ($app) {
    $data = array(
        "game" => array(
            "title" => "Battlefield 3",
            "poster" => "http://upload.wikimedia.org/wikipedia/en/6/69/Battlefield_3_Game_Cover.jpg",
            "metascore" => 89,
            "release_date" => "25 October 2011",
            "platforms" => "PC, Xbox 360, PS3",
            "developer" => "DICE",
            "publisher" => "Electronic Arts"
        )
    );

    $app->render("game.php", $data);
})->name("game");

$app->get("/search-results", function() use ($app) {
    $search = $app->request->get("search");

    $data = getSearchResults($search);

    // Return the data in JSON
    $app->response->headers->set("Content-Type", "application/json");
    echo json_encode($data);
});

// Run the app
$app->run();