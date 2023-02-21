<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta description="Site pour afficher vos images et vos vidéos et pouvoir les comparer avec vos amis.">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./public/css/homepage.style.css" />
    <title><?= $title ?></title>
  </head>

  <body>
      <section>
    <figure>
       <img src="./public/images/import/landscape.png" alt="landscape">
    </figure>
    <div id="introduction">
      <h2>le partage en toute libertée</h2>
      <p id="welcome">bienvenue sur pixopartage,</p>
      <p id="join">venez partager vos photos et vidéos <br>sur notre réseaux social innovant !</p>
      <a href="./?action=login" class="button">se connecter</a>
      <a href="./?action=register" class="button">s'inscire</a>
      <a href="./?action=modif" class="button">modifier pseudo</a>
      <a href="./?action=modifmail" class="button">modifier mail</a>
      <a href="./?action=modifpassword" class="button">modifier password</a>
    </div>
    </section>

    <footer>
      <img src="image/icons8-twitter-50.png" alt="logo twitter">
      <img src="image/icons8-google-play-48.png" alt="logo googleplay">
      <img src="image/icons8-mac-os-50.png" alt="logo apple">
      <img src="image/icons8-github-50.png" alt="logo github">

      <p>&copy; pixoPartage 2023</p>
    </footer>
  </body>
</html>