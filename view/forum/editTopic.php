<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le topic</title>
</head>

<body>

    <h1>EDIT TOPIC</h1>
    
    <form method="POST" action="index.php?ctrl=Forum&action=addTopic">
        <p>
            <label for="">
                Ajouter un topic : <br>
                <input type="text" name="title" value="">
            </label>
            <label for="">
            <textarea name="message" placeholder="Ici ton message" rows="5"></textarea>
            </label>
        </p><br>
        <input type="submit" name="modifier" value="Ajouter">
    </form>

</body>

</html>