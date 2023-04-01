<?php
$users = $result["data"]["users"];
?>

<h1 class="categoryList">Liste des utilisateurs</h1>

<?php
if (!$users) {
    echo "La liste des utilisateurs est vide pour le moment.";
} else {
    ?>
    <table class="containerMainUser">
        <!-- <thead >
            <tr class="flex">
                <th>Pseudo</th>
                <th>Email</th>
                <th>Status</th>
            </tr>
        </thead> -->
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr class="flex">
                <th>Pseudo :</th>
                <td><?= $user->getPseudo() ?></td>
                <th>Email :</th>
                <td><?= $user->getEmail() ?></td>
                <th>Status</th>
                <td><?= $user->getStatus() ?></td>
                </tr>
            <td>

                <?php if ($_SESSION['user']->getRole() == 'admin' && $user->getStatus() == 1): ?>
                    <form method="POST" action="index.php?ctrl=Security&action=banUser">
                        <input type="hidden" name="id" value="<?= $user->getId() ?>">
                        <button class="ban" type="submit">Bannir</button>
                    </form>
                <?php endif; ?>

                <?php if ($_SESSION['user']->getRole() == 'admin' && $user->getStatus() == 0): ?>
                    <form method="POST" action="index.php?ctrl=Security&action=UnBanUser">
                        <input type="hidden" name="id" value="<?= $user->getId() ?>">
                        <button class="ban" type="submit">Unban</button>
                    </form>
                <?php endif; ?>

            </td>
        
    <?php endforeach; ?>
</tbody>

    </table>
    <?php
}
