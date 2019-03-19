<?php
/**
 * Created by IntelliJ IDEA.
 * User: Ben
 * Date: 2019-03-11
 * Time: 13:14
 */
$Musculs_club = Clubs::MuscugetAll();
if(isset($_GET['param2']) && $_GET['param2'] == 'delete'){
    $Muscuclub = Clubs::MuscugetInstance() ;
    $Muscuclub->__set('idClubs' , $_GET['param3']) ;
        $Muscudel = $Muscuclub->MuscuDelete();
        $Muscuinscription = Inscription::MuscugetInstance();
        $Muscuinscription->__set('idClubs' , $_GET['param3']);
        $Muscuinscription->MuscuDeleteByIdClub();
        if($Muscudel)
            $_SESSION['success'] = 'Le club a bien été supprimé';
            else
                $_SESSION['error'] = 'Le club n\'a pas  été supprimé . \n Veuillez rééseayer ultérieurement';
            header('Location: /'.__BASE_DIR__.'liste-clubs');
            exit ;
}
?>