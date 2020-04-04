<a href="<?= helpers::getUrl("Classrooms", "index") ?>">Retourner à la liste des classes</a>

<?php if (isset($errors)): ?>
    <?php foreach ($errors as $error): ?>
        <div><?= $error ?></div>
    <?php endforeach; ?>
<?php endif; ?>

<?php $this->addModal('form', $newEntityForm); ?>