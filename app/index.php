<?php

require "lib/Slim/Slim.php";
\Slim\Slim::registerAutoloader();

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
    $q = $app->request->get("q");

    $data = array(
        array(
            "url" => $app->urlFor("game", array("slug" => "battlefield-3")),
            "title" => "Battlefield 3"
        ), array(
            "url" => $app->urlFor("game", array("slug" => "gta-v")),
            "title" => "GTA V"
        )
    );

    // Return the data in JSON
    $app->response->headers->set("Content-Type", "application/json");
    echo json_encode($data);
});

// Run the app
$app->run();