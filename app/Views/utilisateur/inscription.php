<div class="row g-5">
    <div class="col-12">
        <h4 class="mb-3">Créer un compte</h4>
        <?php if(isset($validation)): ?>
            <div class="row alert alert-danger">
                <?= $validation->listErrors() ?>
            </div>
        <?php endif; ?>
        <form method="post" class="needs-validation" novalidate>
            <div class="row g-3">
                <div class="col-sm-6">
                    <label for="prenom" class="form-label">Prénom</label>
                    <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Saisir le prénom" value="<?= set_value("prenom") ?>" required>
                    <div class="invalid-feedback">
                        Le prénom est obligatoire.
                    </div>
                </div>

                <div class="col-sm-6">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="nom" name="nom" placeholder="Saisir le nom" value="<?= set_value("nom") ?>"" required>
                    <div class="invalid-feedback">
                        Le nom est obligatoire.
                    </div>
                </div>

                <div class="col-12">
                    <label for="login" class="form-label">Login</label>
                    <div class="input-group has-validation">
                        <span class="input-group-text">@</span>
                        <input type="text" class="form-control" id="login" name="login" placeholder="Saisir le login" value="<?= set_value("login") ?>"" required>
                        <div class="invalid-feedback">
                            Le login est obligatoire.
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <label for="motPasse" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="motPasse" name="motPasse" placeholder="Saisir le mot de passe" value="<?= set_value("motPasse") ?>"" required>
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

                <button class="w-100 btn btn-primary btn-lg" type="submit">S'inscrire</button>
            </div>
        </form>
    </div>
</div>

<script>
    (function () {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>