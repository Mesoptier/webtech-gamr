<?php

require "lib/Slim/Slim.php";
\Slim\Slim::registerAutoloader();

// Configurate the app
$app = new \Slim\Slim(array(
    "mode" => "development",
    "debug" => true,

    "templates.path" => "./views"
));

// Routing
$app->get("/", function() use ($app) {
    $app->render("home.php");
});

$app->get("/game/:slug", function($slug) use ($app) {
    $app->render("game.php");
});

// Run the app
$app->run();