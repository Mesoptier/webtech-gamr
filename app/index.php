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
    "base_path" => $app->request->getRootUri(),
    "static_path" => $app->request->getRootUri() . "/static/"
));

// Routing
$app->get("/", function() use ($app) {
    $app->render("home.php");
});

$app->get("/game/:id", function($id) use ($app) {
    $game = getGameInfo($id, "name,image,platforms,genres,publishers,developers,original_release_date");

    $game["metascore"] = rand(40, 90);

    $app->render("game.php", array(
        "game" => $game
    ));
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