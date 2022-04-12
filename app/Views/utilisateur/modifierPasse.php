<div class="row g-5">
    <div class="col-12">
        <h4 class="mb-3">Modifier mon mot de passe</h4>
        <?php if(isset($validation)): ?>
            <div class="row alert alert-danger">
                <?= $validation->listErrors() ?>
            </div>
        <?php endif; ?>
        <form method="post" class="needs-validation" novalidate>
            <div class="row g-3">
                <div class="col-12">
                    <label for="ancienMotPasse" class="form-label">Ancien mot de passe</label>
                    <input type="password" class="form-control" id="ancienMotPasse" name="ancienMotPasse" placeholder="Saisir l'ancien mot de passe" value="<?= set_value("ancienMotPasse") ?>"" required>
                    <div class="invalid-feedback">
                        L'ancien mot de passe est obligatoire.
                    </div>
                </div>

                <div class="col-sm-6">
                    <label for="motPasse" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="motPasse" name="motPasse" placeholder="Saisir le nouveau mot de passe" value="<?= set_value("motPasse") ?>"" required>
                    <div class="invalid-feedback">
                        Le mot de passe est obligatoire.
                    </div>
                </div>

                <div class="col-sm-6">
                    <label for="motPasseConf" class="form-label">Confirmation du mot de passe</label>
                    <input type="password" class="form-control" id="motPasseConf" name="motPasseConf" placeholder="Confirmer le mot de passe" value="<?= set_value("motPasseConf") ?>"" required>
                    <div class="invalid-feedback">
                        La confirmation est obligatoire.
                    </div>
                </div>

                <hr class="my-4">

                <button class="w-100 btn btn-primary btn-lg" type="submit">Modifier</button>
            </div>
        </form>
    </div>
</div>