<h1>Gestion utilisateurs</h1>
<p>Ici vous pouvez gérer les utilisateurs, ...</p>
<div class="card">
    <div class="card-header"><h3 class="text-primary">Liste des utilisateurs</h3></div>
    <div class="card-body">
        <table class="table table-striped table-borderless">
            <caption>Liste des utilisateurs</caption>
            <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Login</th>
                <th>Profil</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($listeUtilisateur as $utilisateur): ?>
                <tr>
                    <td><?= $utilisateur["nom"] ?></td>
                    <td><?= $utilisateur["prenom"] ?></td>
                    <td><?= $utilisateur["login"] ?></td>
                    <td><?= $utilisateur["profil"] ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>