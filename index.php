<?php

$dsn = 'mysql:dbname=colyseum;host=localhost';
$user = 'jerome2';
$password = '12345';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>


<h2>Exercice 1</h2>
<h4>Afficher tous les clients.</h4>
<?php

try {
    $dbh = new PDO($dsn, $user, $password);
    foreach ($dbh->query('SELECT * from clients') as $content) {
        echo($content['lastName'].' '.$content['firstName']);
        echo '<br>';
    }
    $dbh = null;
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
    die();
}
?>

<hr>

<h2>Exercice 2</h2>
<h4>Afficher tous les types de spectacles possibles.</h4>
<?php

try {
    $dbh = new PDO($dsn, $user, $password);
    $showtypes = $dbh->query('SELECT * from showTypes');
    echo count($showtypes);
    foreach ($showtypes as $showtype) {
        echo utf8_encode($showtype['type']);
        echo '<br>';
    }
    $dbh = null;
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
    die();
}

?>

<hr>

<h2>Exercice 3</h2>
<h4>Afficher les 20 premiers clients.</h4>

<?php
try {
    $dbh = new PDO($dsn, $user, $password);
    $clients = $dbh->query('SELECT * from clients LIMIT 20');
    foreach ($clients as $client) {
            echo($client['id'].' : '.$client['lastName'].' '.$client['firstName']);
            echo '<br>';
    }
    $dbh = null;
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
    die();
}

?>

<hr>

<h2>Exercice 4</h2>
<h4>N'afficher que les clients possédant une carte de fidélité.
</h4>

<?php

try {
    $dbh = new PDO($dsn, $user, $password);

    $clients = $dbh->query(
    'SELECT * FROM clients, cards
     WHERE clients.cardNumber = cards.cardNumber
     AND cardTypesId = 1'
     );

    foreach ($clients as $client) {
        echo('Nom : '.$client['lastName'].'<br> Prénom : '.$client['firstName'].'<br>Carte n° : '.$client['cardNumber'].'<br>');
        echo '<br>';
    }
    $dbh = null;
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
    die();
}

?>

<hr>
<h2>Exercice 5</h2>
<h4>Afficher uniquement le nom et le prénom de tous les clients dont le nom commence par la lettre "M".
Les afficher comme ceci :
Nom : *Nom du client*
Prénom : *Prénom du client*

Trier les noms par ordre alphabétique.</h4>

<?php

try {
    $dbh = new PDO($dsn, $user, $password);
    $clients = $dbh->query('SELECT * from clients WHERE lastName LIKE "M%" order by lastName');
    foreach ($clients as $client) {
        echo('Nom : '.' : '.$client['lastName'].'<br>'.'Prénom : '.$client['firstName'].'<br>');
        echo '<br>';
    }
    $dbh = null;
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
    die();
}

?>

<hr>

<h2>Exercice 6</h2>
<h4>Afficher le titre de tous les spectacles ainsi que l'artiste, la date et l'heure. Trier les titres par ordre alphabétique. Afficher les résultat comme ceci : *Spectacle* par *artiste*, le *date* à *heure*.</h4>

<?php

try {
    $dbh = new PDO($dsn, $user, $password);
    $shows = $dbh->query('SELECT * from shows ORDER BY title');
    foreach ($shows as $show) {
        echo($show['title'].' par '.$show['performer'].' le '.$show['date'].' à '.$show['startTime'].'.');
        echo '<br>';
    }
    $dbh = null;
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
    die();
}

?>

<hr>
<h2>Exercice 7</h2>
<h4>Afficher tous les clients comme ceci :
Nom : *Nom de famille du client*
Prénom : *Prénom du client*
Date de naissance : *Date de naissance du client*
Carte de fidélité : *Oui (Si le client en possède une) ou Non (s'il n'en possède pas)*
Numéro de carte : *Numéro de la carte fidélité du client s'il en possède une.*</h4>

<?php

try {
    $dbh = new PDO($dsn, $user, $password);

    $clients = $dbh->query(
    'SELECT * FROM clients, cards
     WHERE clients.cardNumber = cards.cardNumber AND cardTypesId = 1'
     );

    $clients2 = $dbh->query(
    'SELECT * FROM clients, cards
     WHERE clients.cardNumber = cards.cardNumber AND cardTypesId > 1'
     );

    $clients3 = $dbh->query(
        'SELECT * FROM clients WHERE card = 0');

    foreach ($clients as $client) {
        echo(
            'Nom : '                .$client['lastName'].'<br>
            Prénom : '              .$client['firstName'].'<br>
            Date de naissance : '   .$client['birthDate'].'<br>
            Carte de fidélité : OUI <br>
            Numéro de carte : '     .$client['cardNumber'].'<br>'
            );
        echo '<br>';
    }
    foreach ($clients2 as $client2) {
        echo(
            'Nom : '                .$client2['lastName'].'<br>
            Prénom : '              .$client2['firstName'].'<br>
            Date de naissance : '   .$client2['birthDate'].'<br>
            Carte de fidélité : NON <br><br>'
        );
    }
    foreach ($clients3 as $client3) {
        echo(
            'Nom : '                .$client3['lastName'].'<br>
            Prénom : '              .$client3['firstName'].'<br>
            Date de naissance : '   .$client3['birthDate'].'<br>
            Carte de fidélité : NON <br><br>'
        );
    }
    $dbh = null;
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
    die();
}

?>


</body>
</html>