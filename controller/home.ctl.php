<?php
/**
 * Created by IntelliJ IDEA.
 * User: Ben
 * Date: 2019-03-11
 * Time: 12:38
 */

if (isset($_POST['submit']) && $_POST['filter'] > 0 ) {
    $Muscustat = Adherents::MuscugetStatByIdClub($_POST['filter']);
} else {
    $Muscustat = Adherents::MuscugetStat();
}
$Muscuclubs = Clubs::MuscugetAll();
array_unshift($Muscuclubs, array('idClubs' => 0 , 'nomClubs' => 'Choisir un club pour filtrer les données ci dessous...'));
//$pourcentageH = $stat['total']/100*$stat['homme'];
$MuscupourcentageH = 100 / $Muscustat['total'] * $Muscustat['homme'];
$MuscupourcentageF = 100 - $MuscupourcentageH;
$Musculs_adh = Adherents::MuscugetAll();
$Musculs_born = array_column($Musculs_adh, 'dateBornAdherents');
$Muscutranche1 = 0;
$Muscutranche2 = 0;
$Muscutranche3 = 0;
$Muscutranche4 = 0;
$Muscutranche5 = 0;
$Muscutranche6 = 0;
$Muscutranche7 = 0;
foreach ($Musculs_born as $Muscuborn) {

    $Muscuage = Adherents::MuscugetAge($Muscuborn);
    if ($Muscuage >= 0 && $Muscuage < 11) {
        $Muscutranche1++;
    } elseif ($Muscuage >= 11 && $Muscuage < 20) {
        $Muscutranche2++;
    } elseif ($Muscuage >= 21 && $Muscuage < 30) {
        $Muscutranche3++;
    } elseif ($Muscuage >= 31 && $Muscuage < 40) {
        $Muscutranche4++;
    } elseif ($Muscuage >= 41 && $Muscuage < 50) {
        $Muscutranche5++;
    } elseif ($Muscuage >= 51 && $Muscuage < 60) {
        $Muscutranche6++;
    } elseif ($Muscuage >= 60) {
        $Muscutranche7++;
    }
}
?>