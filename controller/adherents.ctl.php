<?php
/**
 * Created by IntelliJ IDEA.
 * User: Ben
 * Date: 2019-03-11
 * Time: 16:19
 */

$Muscuadherents = Adherents::MuscugetInstance();
$Muscuinscription = Inscription::MuscugetInstance();

$Muscuclubs = Clubs::MuscugetAll();
if (isset($_POST['submit']) && isset($_GET['param2']) && $_GET['param2'] > 0) {
    $Muscuadherents->__set('idAdherents', $_POST['idAdherents']);
    $Muscuadherents->__set('nomAdherents', $_POST['nomAdherents']);
    $Muscuadherents->__set('prenomAdherents', $_POST['prenomAdherents']);
    $Muscuadherents->__set('dateBornAdherents', $_POST['dateBornAdherents']);
    $Muscuadherents->__set('genreAdherents', $_POST['genreAdherents']);
    $Muscuadherents->MuscuUpdate();
    $Muscuinscription->__set('idAdherents', $_POST['idAdherents']);
    $Muscuinscription->MuscuDeleteByIdAdherent();
    if (is_array($_POST['idClubs']))
        foreach ($_POST['idClubs'] as $MuscuclubEl) {
            $Muscuinscription->__set('idClubs', $MuscuclubEl);
            $Muscuinscription->__set('date_inscription', date('Y-m-d H:i:s'));
            $Muscuinscription->__set('annee_licence', date('Y'));
            $Muscuinscription->MuscuCreate();
        } else {
        $Muscuinscription->__set('idClubs', $_POST['idClubs']);
        $Muscuinscription->__set('date_inscription', date('Y-m-d H:i:s'));
        $Muscuinscription->__set('annee_licence', date('Y'));
        $Muscuinscription->MuscuCreate();
    }


    goto next;
}
if (isset($_POST['submit'])) {
    $Muscuadherents->__set('nomAdherents', $_POST['nomAdherents']);
    $Muscuadherents->__set('prenomAdherents', $_POST['prenomAdherents']);
    $Muscuadherents->__set('dateBornAdherents', $_POST['dateBornAdherents']);
    $Muscuadherents->__set('genreAdherents', $_POST['genreAdherents']);
    $Musculast_id = $Muscuadherents->MuscuCreate();
    $Muscuinscription->__set('idAdherents', $Musculast_id);
    if (is_array($_POST['idClubs']))
        foreach ($_POST['idClubs'] as $MuscuclubEl) {
            $Muscuinscription->__set('idClubs', $MuscuclubEl);
            $Muscuinscription->__set('date_inscription', date('Y-m-d H:i:s'));
            $Muscuinscription->__set('annee_licence', date('Y'));
            $Muscuinscription->MuscuCreate();
        } else {
        $Muscuinscription->__set('idClubs', $_POST['idClubs']);
        $Muscuinscription->__set('date_inscription', date('Y-m-d H:i:s'));
        $Muscuinscription->__set('annee_licence', date('Y'));
        $Muscuinscription->MuscuCreate();
    }
    header('Location: liste-adherents');
    exit;
}
next:
if (isset($_GET['param2']) && $_GET['param2'] > 0) {
    $Muscuinfo = $Muscuadherents->MuscugetById($_GET['param2']);
    foreach ($Muscuinfo as $Muscukey => $Muscuitem) {
        $_POST[$Muscukey] = $Muscuitem;
    }
    $Muscuinscription = Inscription::MuscugetInstance();
    $Musculs_clubs = $Muscuinscription->MuscugetByIdAdherent($_POST['idAdherents']);
    foreach ($Musculs_clubs as $Musculs_club) {
        $_POST['idClubs'][] = $Musculs_club['idClubs'];
    }
}
?>