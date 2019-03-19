<?php
/**
 * Created by IntelliJ IDEA.
 * User: Ben
 * Date: 2019-03-11
 * Time: 13:14
 */
?>
<div class="row">
    <div class="col-lg-12 text-right">
        <a href="<?php echo __SITE_DIR__.'clubs' ; ?>"> <button class="btn btn-info"> + Ajouter</button></a>
    </div>
</div>
    <table class="dataTable" width="100%">
        <thead>
        <tr>
            <th class="text-center">#</th>
            <th class="text-center">Nom</th>
            <th class="text-center">Code Postal</th>
            <th class="text-center">Ville</th>
            <th class="text-center">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($Musculs_club as $Muscukey=> $Muscuitem) {


        ?>
        <tr>
            <td class="text-center"><?php echo $Muscuitem['idClubs']?></td>
            <td class="text-center"><?php echo $Muscuitem['nomClubs']?></td>
            <td class="text-center"><?php echo $Muscuitem['codePostalClubs']?></td>
            <td class="text-center"><?php echo $Muscuitem['villeClubs']?></td>
            <td class="text-center">
                <a href="<?php echo __SITE_DIR__.'clubs/'.$Muscuitem['idClubs'] ; ?>"><button class="btn btn-success btn-xs">Modifier</button></a>
                <a href="<?php echo __SITE_DIR__.'liste-clubs/delete/'.$Muscuitem['idClubs'] ; ?>"><button class="btn btn-danger btn-xs">Supprimer</button></a>
            </td>
        </tr>
        <?php
        }
        ?>

        </tbody>
    </table>
