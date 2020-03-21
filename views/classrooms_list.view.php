<a href="<?= helpers::getUrl("Classrooms", "add") ?>">Ajouter une classe</a>
<table id="myTable">
    <thead>
    <tr>
        <th>Id</th>
        <th>Nom</th>
        <th>Niveau</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($classrooms as $classroom): ?>
        <tr>
            <td><?= $classroom['id'] ?></td>
            <td><?= $classroom['name'] ?></td>
            <td><?= $classroom['level'] ?></td>
            <td><a href="<?= helpers::getUrl("Classrooms", "edit", ["name" => $classroom['name']]) ?>">Modifier</a></td>
            <td><a href="<?= helpers::getUrl('Classrooms', 'delete', ['id' => $classroom['id']]) ?>">Supprimer</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<script src="public/js/jquery.dataTables.min.js"></script>
<script src="public/js/listClassrooms.js"></script>