<?php if(isset($validation)): ?>
    <div class="row alert alert-danger">
        <?= $validation->listErrors(); ?>
    </div>
<?php endif; ?>
<?php if(session()->get('success')): ?>
    <div class="alert alert-success" role="alert">
        <?= session()->get('success'); ?>
    </div>
<?php endif; ?>
<form method="post">
    <h1 class="h3 mb-3 fw-normal">Login et mot de passe</h1>

    <div class="form-floating">
        <input type="email" class="form-control" id="floatingInput" name="login" value="<?= set_value("login") ?>" placeholder="Votre login">
        <label for="floatingInput">Login</label>
    </div>
    <div class="form-floating">
        <input type="password" class="form-control" id="floatingPassword" name="motPasse" placeholder="Password" value="<?= set_value("motPasse") ?>">
        <label for="floatingPassword">Mot de passe</label>
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Se connecter</button>
</form>