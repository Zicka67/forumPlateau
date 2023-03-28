<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register</title>
    
</head>
<body>

<form method="POST" action="?controller=Security&action=addUser">

  <div>
    <label for="pseudo">Pseudo :</label>
    <input type="text" id="pseudo" name="pseudo" required>
  </div>
  <div>
    <label for="email">Email :</label>
    <input type="email" id="email" name="email" required>
  </div>
  <div>
    <label for="password">Password :</label>
    <input type="password" id="password" name="password" required>
  </div>
  <div>
    <label for="confirm_password">Confirm :</label>
    <input type="password" id="confirm_password" name="confirm_password" required>
  </div>
  <div>
    <input id="" type="submit" name="register" value="Sign up">
  </div>

</form>

    
</body>
</html>