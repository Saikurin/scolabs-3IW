<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Scolabs</title>

    <!-- JS Files -->
    <script src="node_modules/jquery/dist/jquery.min.js"></script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <link rel="stylesheet" href="public/css/scotrap.css">

    <?php $this->loadStyles(); ?>
</head>
<body>

<nav>
    <ul class="menu">
        <li class="logo"><a href="#">
                <img width="50" height="50" src="img/logo.svg" alt="">
            </a>
        </li>
        <li class="item active"><a href="#">Panel d'administration</a></li>
        <li class="item"><a href="#">Utilisateurs</a></li>
        <li class="item"><a href="#">Modération</a></li>
        <li class="item"><a href="#">Personnalisation</a></li>
        <li class="item"><a href="#">Classes</a></li>
        <li class="item"><a href="#">Notes</a></li>
        <li class="item"><a href="#">Planning</a></li>
        <li class="item"><a href="#">|</a></li>
        <li class="item"><a href="#">Mon compte</a></li>
        <li class="item"><a href="#">Déconnexion</a></li>
    </ul>
</nav>
<div class="container">
    <?php include "views/" . $this->view . "/" . $this->underfile . "/" . $this->underfile . ".view.php"; ?>
</div>
</body>
</html>