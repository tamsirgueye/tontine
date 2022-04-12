<div class="row g-5">
    <div class="col-12">
        <h4 class="mb-3">Ajouter une tontine</h4>
        <?php if(isset($validation)): ?>
            <div class="row alert alert-danger">
                <?= $validation->listErrors() ?>
            </div>
        <?php endif; ?>
        <form method="post">
            <div class="row g-3">
                <div class="col-sm-6">
                    <label for="nom" class="form-label">Libelle</label>
                    <?= form_input(['name' => 'libelle', 'class' => 'form-control', 'placeholder' => 'Saisir le libelle', 'value' => set_value('libelle')]) ?>
                </div>

                <div class="col-sm-6">
                    <label for="nom" class="form-label">Périodicité</label>
                    <?= form_dropdown('periodicite', $periodicite, set_value("periodicite"), ['class' => 'form-control']) ?>
                </div>

                <div class="col-sm-6">
                    <label for="dateDeb" class="form-label">Date début</label>
                    <?= form_input(['name' => 'dateDeb', 'class' => 'form-control', 'placeholder' => 'jj/mm/AAAA', 'value' => set_value('dateDeb')]) ?>
                </div>

                <div class="col-sm-6">
                    <label for="nbEcheance" class="form-label">Nb échéance</label>
                    <?= form_dropdown('nbEcheance', $nbEcheance, set_value("nbEcheance"), ['class' => 'form-control']) ?>
                </div>

                <hr class="my-4">

                <?= form_submit(['name' => 'ajouter', 'class' => 'w-100 btn btn-primary', 'value' => 'Ajouter']) ?>
            </div>
        </form>
    </div>
</div>