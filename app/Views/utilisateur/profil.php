<h1>Votre profil utilisateur</h1>
<p>Ici vous pouvez voir vos informations personnelles, modifier votre mot de passe ...</p>
<?php if (session()->get('successAjModifPasse')): ?>
    <div class="alert alert-success">
        <?= session()->get('successAjModifPasse') ?>
    </div>
<?php endif; ?>
<div class="card">
    <div class="card-header"><h3 class="text-primary">Utilisateur</h3></div>
    <div class="card-body">
        <span class="fw-bold">Prénom:</span> <?= $utilisateur["prenom"] ?><br>
        <span class="fw-bold">Nom:</span> <?= $utilisateur["nom"] ?><br>
        <span class="fw-bold">Login:</span> <?= $utilisateur["login"] ?><br>
        <span class="fw-bold">Profil:</span> <?= $utilisateur["profil"] ?><br>
        <a href="<?= base_url() ?>/utilisateur/modifierPasse" class="btn btn-primary">Modifier le mot de passe</a>
    </div>
</div>