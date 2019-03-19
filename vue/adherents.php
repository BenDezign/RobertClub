<?php
/**
 * Created by IntelliJ IDEA.
 * User: Ben
 * Date: 2019-03-11
 * Time: 16:19
 */
?>
<div class="col-lg-12">
    <form method="POST">
        <input type="hidden" name="idAdherents" value="<?php echo @$_POST['idAdherents'] ; ?>">
        <input type="hidden" name="idInscription" value="<?php echo @$_POST['idInscription'] ; ?>">
        <div class="form-group labelholder has-labelholder floating" data-label="Nom">
            <input type="text" required name="nomAdherents" value="<?php echo @$_POST['nomAdherents'] ; ?>" class="form-control" placeholder="">
        </div>
        <div class="form-group labelholder has-labelholder floating" data-label="Prenom">
            <input type="text" required name="prenomAdherents" value="<?php echo @$_POST['prenomAdherents'] ; ?>" class="form-control" placeholder="">
        </div>
        <div class="form-group labelholder has-labelholder floating" data-label="Date de naissance">
            <input type="date" required name="dateBornAdherents" value="<?php echo @$_POST['dateBornAdherents'] ; ?>" class="form-control ">
        </div>
        <div class="form-group">
            <label >Genre : </label>
            <select class="form-control" name="genreAdherents" required>
                <option value="H" <?php if (isset($_POST['genreAdherents']) && $_POST['genreAdherents'] == 'H') {echo 'selected' ; } ?>>Homme</option>
                <option value="F" <?php if (isset($_POST['genreAdherents']) && $_POST['genreAdherents'] == 'F') {echo 'selected' ; } ?>>Femme</option>
            </select>
        </div>
        <div class="form-group">
            <label >Club : </label>
            <select class="form-control select2" name="idClubs[]" multiple="multiple" required>
                <?php
                foreach ($Muscuclubs as $Muscuclub) {
                    ?>
                    <option value="<?php echo $Muscuclub['idClubs']?>" <?php echo (isset($_POST['idClubs']) &&  in_array($Muscuclub['idClubs'] , $_POST['idClubs'])) ?'selected' : '';?>><?php echo $Muscuclub['nomClubs']?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div class="text-center">
            <input type="submit" name="submit" value="VALIDER"  class="btn btn-success">
        </div>
    </form>
</div>

