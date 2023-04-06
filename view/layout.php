<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tiny.cloud/1/zg3mwraazn1b2ezih16je1tc6z7gwp5yd4pod06ae5uai8pa/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous"/>
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Domine:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- <link rel="stylesheet" href="<?= PUBLIC_DIR ?>/css/style.css">-->
    <title>FORUM</title>
    <script src="public/script/script.js"></script>
</head>
<body>
    <div id="wrapper"> 
  
        <div id="mainpage">
            <!-- c'est ici que les messages (erreur ou succès) s'affichent-->
            <h3 class="message" style="color: red"><?= App\Session::getFlash("error") ?></h3>
            <h3 class="message" style="color: green"><?= App\Session::getFlash("success") ?></h3>
            <header>
            <div class="menu-burger">
                <div class="ligne-burger"></div>
                <div class="ligne-burger"></div>
                <div class="ligne-burger"></div>
            </div>

                <nav class="menu-navigation">
                    <div class="nav-left">
                        <ul class="">
                            <li><a href="index.php">Accueil</a></li>
                            <li><a href="index.php?ctrl=Forum&action=listCategories">Categories</a></li>

                            <?php if(App\Session::isAdmin()){ ?>
                            <li><a href="index.php?ctrl=Forum&action=addCategory">Ajouter une categorie</a></li>
                            <li><a href="index.php?ctrl=Security&action=listUsers">Liste des utilisateurs</a></li>

                            <?php } ?>
                        </ul>
                    </div>
                    <div class="nav-right">
                 
                        <?php if(App\Session::getUser()){ ?>
                        <ul class="">
                            <li><a href="index.php?ctrl=Security&action=showProfile"><span class="fas fa-user"></span> <?= ucfirst(App\Session::getUser()) ?></a></li>
                            <li><a href="index.php?ctrl=Security&action=logout">Déconnexion</a></li>
    
                            <?php }  else { ?>
       
                            <li> <a href="index.php?ctrl=Security&action=login">Connexion</a></li>
                            <li><a href="index.php?ctrl=Security&action=addUser">Inscription</a></li>
                        </ul>
                        <?php } ?>
                  
                    </div>
                </nav>

               
            </header>
            
            <!-- $page qui était $content dans cinema, ob start + ob clean dans l'index -->
            <main id="forum">
            <!-- Le contenu entre le header et le footer -->
                <?= $page ?>
            </main>
        </div>
    </div>
        <footer>
            <p>&copy; 2020 - Forum CDA - <a href="/home/forumRules.html">Règlement du forum</a> - <a href="">Mentions légales</a></p>
        <button class="noselect toTop"><svg width="24" height="24" viewBox="0 0 24 24"><path d="M0 16.67l2.829 2.83 9.175-9.339 9.167 9.339 2.829-2.83-11.996-12.17z"/></svg></button>
            <!--<button id="ajaxbtn">Surprise en Ajax !</button> -> cliqué <span id="nbajax">0</span> fois-->
        </footer>
    <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous">
    </script>
    <script>

document.querySelector(".menu-burger").addEventListener("click", function() {
    const nav = document.querySelector(".menu-navigation");
    const burger = document.querySelectorAll(".ligne-burger");
  
    nav.classList.toggle("menu-navigation-active");
    
    burger[0].classList.toggle("ligne-burger-rotate1");
    burger[1].classList.toggle("ligne-burger-hidden");
    burger[2].classList.toggle("ligne-burger-rotate2");
  
    if (nav.style.display === "none") {
      nav.style.display = "block";
    } else {
      nav.style.display = "none";
    }
  });


        $(document).ready(function(){
            $(".message").each(function(){
                if($(this).text().length > 0){
                    $(this).slideDown(500, function(){
                        $(this).delay(3000).slideUp(500)
                    })
                }
            })
            $(".delete-btn").on("click", function(){
                return confirm("Etes-vous sûr de vouloir supprimer?")
            })
            tinymce.init({
                selector: '.post',
                menubar: false,
                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime media table paste code help wordcount'
                ],
                toolbar: 'undo redo | formatselect | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
                content_css: '//www.tiny.cloud/css/codepen.min.css'
            });
        })

        

        /*
        $("#ajaxbtn").on("click", function(){
            $.get(
                "index.php?action=ajax",
                {
                    nb : $("#nbajax").text()
                },
                function(result){
                    $("#nbajax").html(result)
                }
            )
        })*/
    </script>
</body>
</html>