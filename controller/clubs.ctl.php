<?php
/**
 * Created by IntelliJ IDEA.
 * User: Ben
 * Date: 2019-03-11
 * Time: 13:15
 */
//var_dump($_POST);
$Muscuclubs = Clubs::MuscugetInstance()  ;
if(isset($_POST['submit']) && isset($_GET['param2']) && $_GET['param2'] > 0){
    unset($_POST['submit']);

    foreach ($_POST as $Muscukey => $Muscuitem) {
        $Muscuclubs->__set($Muscukey , $Muscuitem);
    }
   $Muscuclubs->MuscuUpdate() ;
    goto next ;
}
if (isset($_POST['submit'])){
    unset($_POST['submit']);
    foreach ($_POST as $Muscukey => $Muscuitem) {
    $Muscuclubs->__set($Muscukey , $Muscuitem);
    }
    $Musculast_id = $Muscuclubs->MuscuCreate() ;
    header('Location: liste-clubs');
    exit  ;
}
next:
if(isset($_GET['param2']) && $_GET['param2'] > 0) {
    $Muscuinfo = $Muscuclubs->MuscugetById($_GET['param2']);
    foreach ($Muscuinfo as $Muscukey => $Muscuitem) {
        $_POST[$Muscukey] = $Muscuitem;
    }
}
?>


