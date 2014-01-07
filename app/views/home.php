<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gamr</title>

    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Montserrat:400,700">
    <link rel="stylesheet" href="<?= $static_path . "style.css" ?>">

    <script src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
    <script src="<?= $static_path . "gamr.js" ?>"></script>
</head>
<body class="page-home">
    <header class="header">
        <div class="wrapper">
            <h1 class="logo"><a href="#home">Gamr</a></h1>
        </div>
    </header>
    <form class="search wrapper" method="get">
        <input class="search-input" type="text" placeholder="Search games..." name="search">
        <button class="search-button" title="Click here if your name is Paul de Bra."><i class="fa fa-search"></i></button>
    </form>
    <ul class="results wrapper"></ul>
</body>
</html>