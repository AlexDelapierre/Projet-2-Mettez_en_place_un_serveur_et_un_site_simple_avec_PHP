<?php
    require 'bdd.php'; // On se connecte d'abord

    // 1. Vérification de la présence de l'ID
    if(empty($_GET['id'])) {
        header('Location: index.php');
        exit;
    }

    $requete = $db->prepare('SELECT * FROM oeuvres WHERE id = ?');
    $requete->execute([$_GET['id']]);
    $oeuvre = $requete->fetch();

    // 2. Vérification si l'oeuvre existe (fetch renvoie false si rien n'est trouvé)
    if(!$oeuvre) {
        header('Location: index.php');
        exit;
    }

    require 'header.php';
?>

<article id="detail-oeuvre">
    <div id="img-oeuvre">
        <img src="<?= $oeuvre['image'] ?>" alt="<?= $oeuvre['titre'] ?>">
    </div>
    <div id="contenu-oeuvre">
        <h1><?= $oeuvre['titre'] ?></h1>
        <p class="description"><?= $oeuvre['artiste'] ?></p>
        <p class="description-complete">
             <?= $oeuvre['description'] ?>
        </p>
    </div>
</article>

<?php require 'footer.php'; ?>