<?php
/**
 * Created by PhpStorm.
 * User: Paulin
 * Date: 19/07/2018
 * Time: 09:35
 */

?>
<p> Créez votre compte en quelques clics </p>
<div  class="inscription">
    <div class="container">
        <form class="form-horizontal"  action="index.php?uc=gestionBlog&action=registration" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-xs-6">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Pseudo" name="login">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Mot de passe">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="confirm_password" placeholder="Confirmer mot de passe">
                    </div>
                    <button type="submit" class="btn btn-success" value="envoyer">S'inscrire</button>
                </div>
            </div>
        </form>
    </div>
</div>
