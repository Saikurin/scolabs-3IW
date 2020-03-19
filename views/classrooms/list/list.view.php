<div class="row d-flex flex-row justify-content-space-between">
    <a href="" class="btn btn-dark-purple">
        <i class="fas fa-arrow-left"></i>
        Retour au dashboard
    </a>
    <a href="<?= helpers::getUrl("Classrooms", "add") ?>" class="btn btn-dark-purple">
        <i class="fas fa-plus"></i>
        Ajouter une classe
    </a>
</div>
<h1>Liste des classes</h1>
<button id="show">Show</button>
<table class="icon-hover hover" id="classesTable">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nom</th>
            <th scope="col">Niveau</th>
            <th scope="col">Editer</th>
            <th scope="col">Supprimer</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($classrooms as $classroom): ?>
        <tr>
            <td><?= $classroom['id'] ?></td>
            <td><?= $classroom['name'] ?></td>
            <td><?= $classroom['level'] ?></td>
            <td>
                <a href="<?= helpers::getUrl("Classrooms", "edit", ["name" => $classroom['name']]) ?>">
                    <i class="fas fa-pencil-alt"></i>
                </a>
            </td>
            <td>
                <a href="<?= helpers::getUrl('Classrooms', 'delete', ['id' => $classroom['id']]) ?>">
                    <i class="fas fa-archive"></i>
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>