<?php
/**
 * Created by IntelliJ IDEA.
 * User: Ben
 * Date: 2019-03-11
 * Time: 16:19
 */

?>
<div class="row">
    <form method="post" class="d-inline-flex  offset-1 w-75">
        <select class="select2 form-control " name="filter">
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
</div>
<div class="row d-inline-flex offset-4 w-100">
        <input type="submit" value="Filtrer" name="submit" class="btn btn-success btn-xs m-1">
        <input type="button" value="Effacer la rechercher" onclick="document.location.href='./'"
               class="btn btn-danger btn-xs m-1">
        </div>
    </form>
<div class="clearfix"></div>
<div class="row">
    <div class="col-lg-12 text-right d-inline-flex">
        <div class="col-lg-6 text-left">
            <a href="<?php echo __SITE_DIR__.'liste-adherents/actif' ; ?>"> <button class="btn btn-outline-success <?php echo (isset($_GET['param2']) && $_GET['param2'] == 'actif')?'active' : '' ;?>">Actif</button></a>
            <a href="<?php echo __SITE_DIR__.'liste-adherents/non-actif' ; ?>"> <button class="btn btn-outline-danger <?php echo (isset($_GET['param2']) && $_GET['param2'] == 'non-actif')?'active' : '' ;?>">Non Actif</button></a>
            <a href="<?php echo __SITE_DIR__.'liste-adherents/all' ; ?>"> <button class="btn btn-outline-dark <?php echo (isset($_GET['param2']) && $_GET['param2'] == 'all')?'active' : '' ;?>">Tous</button></a>
        </div>
        <div class="col-lg-6 text-right">
        <a href="<?php echo __SITE_DIR__.'adherents' ; ?>"> <button class="btn btn-info "> + Ajouter</button></a>
        </div>
    </div>
</div>
    <table class="dataTable" width="100%">
        <thead>
        <tr>
            <th class="text-center">#</th>
            <th class="text-center">Nom</th>
            <th class="text-center">Prenom</th>
            <th class="text-center">Date de naissance</th>
            <th class="text-center">Genre</th>
            <th class="text-center">Clubs</th>
            <th class="text-center">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($Musculs_adherents as $Muscukey=> $Muscuitem) {
            $Musculs_clubs = $Muscuadherent->MuscugetListClubsByIdAdherent($Muscuitem['idAdherents']);
            $Muscutext = "";

        ?>
        <tr>
            <td class="text-center"><?php echo $Muscuitem['idAdherents']?></td>
            <td class="text-center"><?php echo $Muscuitem['nomAdherents']?></td>
            <td class="text-center"><?php echo $Muscuitem['prenomAdherents']?></td>
            <td class="text-center"><?php echo $Muscuitem['dateBornAdherents']?></td>
            <td class="text-center"><?php echo ($Muscuitem['genreAdherents'] == 'H' )?'Homme':'Femme'?></td>
            <td class="text-center">
                <?php
                if(count($Musculs_clubs) > 0 && $Musculs_clubs != FALSE  ) {
                    ?>
                    <button type="button" class="btn btn-xs btn-info" data-toggle="popover" data-html="true"
                            title="Clubs" data-content="<?php
                    foreach ($Musculs_clubs as $Muscuclub) {
                        $Muscutext .= $Muscuclub['nomClubs'] . ' : ' . date('d-m-Y', strtotime($Muscuclub['date_inscription'])) . '<br> ';
                    }
                    echo $Muscutext;
                    ?>">Clubs
                    </button>
                    <?php
                }else{
                   echo  'Aucun club !' ;
                }
                ?>
            </td>
            <td class="text-center">
                <a href="<?php echo __SITE_DIR__.'adherents/'.$Muscuitem['idAdherents'] ; ?>"><button class="btn btn-success btn-xs">Modifier</button></a>
                <a href="<?php echo __SITE_DIR__.'liste-adherents/'.$_GET['param2'].'/delete/'.$Muscuitem['idAdherents'] ; ?>"><button class="btn btn-danger btn-xs">Supprimer</button></a>
            </td>
        </tr>
        <?php
        }
        ?>

        </tbody>
    </table>
