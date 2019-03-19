<?php
/**
 * Created by IntelliJ IDEA.
 * User: Ben
 * Date: 2019-03-11
 * Time: 16:19
 */

$Muscuclubs = Clubs::MuscugetAll();
array_unshift($Muscuclubs, array('idClubs' => 0 , 'nomClubs' => 'Choisir un club pour filtrer les données ci dessous...'));
$Msucufilter = 0  ;
if(isset($_POST['filter']) && $_POST['filter'] > 0 ){
    $Msucufilter =  $_POST['filter'] ;
}
$Musculs_adherents = Adherents::MuscugetAllWithDetail($Msucufilter);
if (isset($_GET['param2']) && $_GET['param2'] == 'actif')
    $Musculs_adherents = Adherents::MuscugetAJourWithDetail($Msucufilter);
elseif (isset($_GET['param2']) && $_GET['param2'] == 'non-actif')
    $Musculs_adherents = Adherents::MuscugetNonAJourWithDetail($Msucufilter);
elseif(!isset($_GET['param2']))
    header('Location: /' . __BASE_DIR__ . 'liste-adherents/all') ;

$Muscuinscription = Inscription::MuscugetInstance();
$Muscuadherent = Adherents::MuscugetInstance();

if (isset($_GET['param3']) && $_GET['param3'] == 'delete') {
    $Muscuadherent->__set('idAdherents', $_GET['param4']);
    $Muscudel = $Muscuadherent->MuscuDelete();
    $Muscuinscription->__set('idAdherents', $_GET['param4']);
    $Muscuinscription->MuscuDeleteByIdAdherent();
    if ($Muscudel)
        $_SESSION['success'] = 'L\'L\'adherent a bien été supprimé';
    else
        $_SESSION['error'] = 'L\'adherent club n\'a pas  été supprimé . \n Veuillez rééseayer ultérieurement';
    header('Location: /' . __BASE_DIR__ . 'liste-adherents');
    exit;
}
?>