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
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Courbe</h6>
    </div>
    <div class="card-body">
        <div class="chart-area">
            <canvas id="myAreaChart"></canvas>
        </div>
        <hr>
        <span class="bottom-chart">Nombre de participants des tontines</span>
    </div>
</div>

<?= script_tag('js/sb-admin-2.min.js') ?>
<?= script_tag('vendor/chart.js/Chart.js') ?>
<?= script_tag('vendor/chart.js/plugins/chartjs-plugin-datalabels.js') ?>
<?= script_tag('js/chart-area.js') ?>

<script>
    let
        labels = "<?= implode(",", array_column($listeParticipant, 'libelle')) ?>".split(','),
        data = "<?= implode(",", array_column($listeParticipant, 'nbp')) ?>".split(',')
    ;

    startAreaChart(labels, data);
</script>
