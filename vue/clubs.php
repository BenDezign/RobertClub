<?php
/**
 * Created by IntelliJ IDEA.
 * User: Ben
 * Date: 2019-03-11
 * Time: 13:15
 */
?>
<div class="col-lg-12">
    <form method="POST">
        <input type="hidden" name="idClubs" value="<?php echo @$_POST['idClubs'] ; ?>">
        <div class="form-group labelholder has-labelholder floating" data-label="Nom">
            <input type="text" required name="nomClubs" value="<?php echo @$_POST['nomClubs'] ; ?>" class="form-control" placeholder="">
        </div>
        <div class="form-group labelholder has-labelholder floating" data-label="Code Postal">
            <input type="text" required name="codePostalClubs" value="<?php echo @$_POST['codePostalClubs'] ; ?>" class="form-control ">
        </div>
        <div class="form-group labelholder has-labelholder floating" data-label="Ville">
            <input type="text" required name="villeClubs" value="<?php echo @$_POST['villeClubs'] ; ?>" class="form-control ">
        </div>
        <div class="text-center">
        <input type="submit" name="submit" value="VALIDER"  class="btn btn-success">
        </div>
    </form>
</div>
