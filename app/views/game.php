<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gamr - <?= $game["title"] ?></title>

    <base href="<?= $base_path ?>/">

    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Montserrat:400,700">
    <link rel="stylesheet" href="<?= $static_path . "style.css" ?>">

    <script src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
    <script src="<?= $static_path . "gamr.js" ?>"></script>
</head>
<body class="page-game">
    <header class="header">
        <div class="wrapper">
            <h1 class="logo"><a href="">Gamr</a></h1>
            <div class="search-box">
                <form class="search" method="get">
                    <input class="search-input" type="text" placeholder="Search games..." name="search">
                    <button class="search-button" title="Click here if your name is Paul de Bra."><i class="fa fa-search"></i></button>
                </form>
                <ul class="results"></ul>
            </div>
        </div>
    </header>
    <div class="wrapper">
        <div class="details">
            <img class="poster" src="<?= $game["poster"] ?>" alt="<?= $game["title"] ?>">
            <div class="metascore metascore-<?= ($game["metascore"] >= 75 ? "high" : ($game["metascore"] >= 50 ? "mid" : "low")) ?>"><span class="score"><?= $game["metascore"] ?></span>Metascore</div>
            <div class="detail"><span class="detail-title">Release date</span><?= date("j F Y", $game["release_date"]) ?></div>
            <div class="detail"><span class="detail-title">Platforms</span><?= implode(", ", $game["platforms"]) ?></div>
            <div class="detail"><span class="detail-title">Developer</span><?= implode(", ", $game["developers"]) ?></div>
            <div class="detail"><span class="detail-title">Publisher</span><?= implode(", ", $game["publishers"]) ?></div>
        </div>
        <div class="content">
            <h2><?= $game["title"] ?></h2>
            <div class="description">
                <?= $game["description"] ?>
            </div>
        </div>
    </div>
</body>
</html>