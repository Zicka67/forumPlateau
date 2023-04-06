<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Login</title>

</head>
<body>

      <div class="centerLogIn">

        <form class="registerFormLog" method="POST" action="index.php?ctrl=Security&action=login">

          <div class="flexLogIn">

          <div class="emailLog">
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required>
          </div>

          <div class="passLog">
            <label for="password">Password :</label>
            <input type="password" id="password" name="password" required>
          </div>

</div>
      <div id="button">
        <input  type="submit" name="login" value="Log in">
      </div>

        </form>
      </div>

</body>
</html>