<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le label</title>
</head>

<body>

    <h1>EDIT CATEGORY</h1>

    <form method="POST" action="index.php?ctrl=Forum&action=addCategory">
        <p>
            <label>
                Ajouter une catégorie : <br>
                <input type="text" name="label" value="">

            </label>
        </p><br>
        <input type="submit" name="modifier" value="Ajouter">
    </form>

</body>

</html>