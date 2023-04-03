<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le label</title>
</head>

<body>

    <h1 class="categoryList">AJOUTER UNE CATEGORIE</h1>

    <form method="POST" action="index.php?ctrl=Forum&action=addCategory">
    <div class="containerMain2">
        <p class="categoryContainerAdd">
            <label>
                Ajouter une catégorie : <br>
                <input type="text" name="label" value="">

            </label>
        </p><br>
        <input class="buton2" type="submit" name="modifier" value="Ajouter">
        </div>
    </form>

</body>

</html>