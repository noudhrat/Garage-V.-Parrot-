<?php
require_once('lib/pdo.php');

$getAllMyServices = $bdd->prepare('SELECT id, title, description, image FROM services');
// $getAllMyServices->execute(array($_SESSION['id']));
$getAllMyServices->execute(); 
$services = $getAllMyServices->fetchAll(PDO::FETCH_ASSOC);