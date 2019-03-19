<?php
/**
 * Created by IntelliJ IDEA.
 * User: Ben
 * Date: 2019-03-11
 * Time: 12:38
 */
?>

<form method="post" class="d-inline-flex w-100">
    <select class="select2 form-control" name="filter">
        <?php
        foreach ($Muscuclubs as $Muscuclub) {
            if (isset($_POST['filter']) && $_POST['filter'] == $Muscuclub['idClubs']){
                $MuscuclubSelected = $Muscuclub['nomClubs'] ;
                }
            ?>
                <option <?php
            echo (isset($_POST['filter']) && $_POST['filter'] == $Muscuclub['idClubs']) ? 'selected' : '';
            ?> value="<?php echo $Muscuclub['idClubs']; ?>"><?php echo $Muscuclub['nomClubs']; ?></option>
            <?php
        }
        ?>
    </select>
    <input type="submit" value="Filtrer" name="submit" class="btn btn-success btn-xs">
    <input type="button" value="Effacer la rechercher" onclick="document.location.href='./'"
           class="btn btn-danger btn-xs">
</form>
<?php
if(isset($MuscuclubSelected) && !empty($MuscuclubSelected) && $_POST['filter'] > 0 ) {
?>
<div class="alert alert-warning text-center">Les données ne prennent en compte que les adhérents du club :
    <strong><?php echo $MuscuclubSelected; ?></strong></div>
<?php
}else{
 echo '<div class="alert alert-warning text-center">Les données  prennent en compte tous les adhérents de tous les clubs ! </div> ' ;
}
?>
<div class="btn-group offset-3">
    <button class="btn btn-outline-info active selectorDiag" data-toggle="#HF">Homme/Femme</button>
    <button class="btn btn-outline-secondary selectorDiag" data-toggle="#AGE1">Tranche d'age V1</button>
    <button class="btn btn-outline-primary selectorDiag" data-toggle="#AGE2">Tranche d'age V2</button>
</div>
<div class="col-lg-5 offset-3 chart" id="HF">
    <canvas id="myChart" width="400" height="400"></canvas>
</div>
<div class="col-lg-5 offset-3 d-none chart" id="AGE1">
    <canvas id="myChartLine" width="400" height="400"></canvas>
</div>
<div class="col-lg-4 offset-3 d-none chart" id="AGE2">
    <canvas id="myChartLineBis" width="400" height="400"></canvas>
</div>
