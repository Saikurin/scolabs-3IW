<a href="<?= helpers::getUrl("Student", "index") ?>">Ajouter un étudiant</a>

<table>
    <tbody>
    <?php foreach ($students as $student): ?>
        <tr>
            <td><?= $student['id_student'] ?></td>
            <td><?= $student['firstname'] ?></td>
            <td><?= $student['lastname'] ?></td>
            <td><?= $student['email'] ?></td>
            <td><?= $student['phoneNumber'] ?></td>
            <td><?= $student['parent1'] ?></td>
            <td><?= $student['parent2'] ?></td>
            <td><a href="<?= helpers::getUrl("Student", "synthesis", ["id" => $student['id_student']]) ?>">Modifier</a></td>
            <td><a href="<?= helpers::getUrl('Student', 'index', ['id' => $student['id']]) ?>">Supprimer</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<script src="public/js/jquery.dataTables.min.js"></script>
<script src="public/js/listClassrooms.js"></script>