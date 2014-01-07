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
    $app->render("game.php");
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