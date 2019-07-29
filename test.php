<html>
<head></head>
<body>
    <ul>
    <?php
        $menu = ['Accueil' => '/accueil.html', 'Produits' => 'produits.html', 'Contact' => 'contact.html'];
        foreach($menu AS $nom => $lien)
        {
            ?>
            <li><a href="<?php echo $lien; ?>"><?php echo $nom; ?></a></li>
            <?php
        }
    ?>
    </ul>
</body>
</html>