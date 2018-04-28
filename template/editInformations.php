<?php $this->title = 'Modification d\'identifiant'; ?>


<h3>Changer son pseudo ou son mot de passe</h3>

        <p id="textChangeCredentials">Une fois votre pseudonyme ou votre mot de passe modifié, vous serez déconnecté(e) afin d'enregistrer vos modifications.<br/>
            Veuillez vous connecter de nouveau afin d'avoir accès à votre espace personnel.
        </p>


<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 changeCredentials">
        <h4>Changer son pseudonyme</h4>
        <form action="../public/index.php?action=editLogin" method="post">
            <div>
                <label for="editLogin">Nouveau pseudonyme</label><br />
                <input type="text" id="editLogin" name="editLogin" />
            </div>
            <div>
                <input type="submit" value="Modifier mon pseudo" class="submitButton" />
            </div>
        </form>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 changeCredentials" id="password">
        <h4>Changer son mot de passe</h4>
        <form action="../public/index.php?action=editPassword" method="post">
            <div>
                <label for="editPassword">Nouveau mot de passe</label><br />
                <input type="password" id="editPassword" name="editPassword" />
            </div>
            <div>
                <label for="editPasswordCheck">Veuillez entrer de nouveau votre mot de passe</label><br />
                <input type="password" id="editPasswordCheck" name="editPasswordCheck" />
            </div>
            <div>
                <input type="submit" value="Modifier mon mot de passe" class="submitButton" />
            </div>
        </form>
    </div>
</div>