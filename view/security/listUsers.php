<?php
$users = $result["data"]["users"];
?>

<h1 class="userList">Liste des utilisateurs</h1>

<?php
if (!$users) {
    echo "La liste des utilisateurs est vide pour le moment.";
} else {
    ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Pseudo</th>
                <th>Email</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $user->getId() ?></td>
            <td><?= $user->getPseudo() ?></td>
            <td><?= $user->getEmail() ?></td>
            <td><?= $user->getStatus() ?></td>
            <td>
                <?php if ($_SESSION['user']->getRole() == 'admin' && $user->getStatus() == 1): ?>
                    <form method="POST" action="index.php?ctrl=Security&action=banUser">
                        <input type="hidden" name="id" value="<?= $user->getId() ?>">
                        <button type="submit">Bannir</button>
                    </form>
                <?php endif; ?>
                <?php if ($_SESSION['user']->getRole() == 'admin' && $user->getStatus() == 0): ?>
                    <form method="POST" action="index.php?ctrl=Security&action=UnBanUser">
                        <input type="hidden" name="id" value="<?= $user->getId() ?>">
                        <button type="submit">Unban</button>
                    </form>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>

    </table>
    <?php
}
