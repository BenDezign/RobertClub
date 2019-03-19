<?php
/**
 * Created by IntelliJ IDEA.
 * User: Ben
 * Date: 2019-03-07
 * Time: 14:34
 */
if (isset($_GET['param1'])) {
    switch ($_GET['param1']) {
        case 'liste-clubs' :
            $Muscucle = 'liste-clubs';
            $Muscutitle = 'Liste Clubs';
            break;
        case 'clubs' :
            $Muscucle = 'clubs';
            $Muscutitle = 'Clubs';
            break;
        case 'liste-adherents' :
            $Muscucle = 'liste-adherents';
            $Muscutitle = 'Liste Adherents';
            break;
        case 'adherents' :
            $Muscucle = 'adherents';
            $Muscutitle = 'Adherents';
            break;
        case 'home' :
            $Muscucle = 'home';
            $Muscutitle = 'Accueil';
            break;
        default:
            $Muscucle = '404';
            $Muscutitle = 'NOT FOUND';
    }
} else {
    header('Location: home') ;
    exit ;
}
?>