<h1>Bienvenue <?= session()->get('prenom') . ' ' . session()->get('nom') ?></h1>
<p class="fs-5 col-md-8">
    Vous pouvez afficher les statistiques, gérer les utilisateurs, ...
</p>
<div class="card">
    <div class="card-header"><h3 class="text-primary">Statistiques</h3></div>
    <div class="card-body">
        <span class="text-decoration-underline">Nombre de tontines:</span> <span class="badge bg-primary"><?= $nbTontine ?></span><br>
        <span class="text-decoration-underline">Nombre total de participations:</span> <span class="badge bg-primary"><?= $nbParticipe ?></span>
        <table class="table table-striped table-borderless">
            <caption>Liste des tontines avec le nombre de leurs participants</caption>
            <thead>
                <tr>
                    <th>Libelle</th>
                    <th>Nombre de participants</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($listeParticipant as $participant): ?>
                    <tr>
                        <td><?= $participant["libelle"] ?></td>
                        <td><?= $participant["nbp"] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>