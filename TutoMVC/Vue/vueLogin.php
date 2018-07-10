<?php $this->titre = "Mon Blog"; ?>
<div id="connexion" class="connexion">
    <div class="container">

        <form class="form-horizontal"  action="index.php?action=connection" method ="post">
            <div class="row">
                <div class="col-xs-6">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Pseudo" name="nom_utilisateur">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="mot_de_passe" placeholder="Mot de passe">
                    </div>
                    <button type="submit" class="btn" value="se connecter">Se connecter</button>
                </div>
            </div>
        </form>
    </div>
</div>