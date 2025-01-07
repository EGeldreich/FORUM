<?php
    use Service\AsideService;
    use Service\Functions;
    $functions = new Functions();
    $asideContent = AsideService::getAsideContent();
    $categories = $asideContent['categories'];
    $users = $asideContent['users'];
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="<?= $meta_description ?>">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <script src="https://cdn.tiny.cloud/1/zg3mwraazn1b2ezih16je1tc6z7gwp5yd4pod06ae5uai8pa/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&family=Outfit:wght@100..900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
        <link rel="stylesheet" href="<?= PUBLIC_DIR ?>/css/style.css">
        <title>FORUMNAME</title>
    </head>
    <body>
        <div id="wrapper">
            <div class="bg-element bg-element_first"></div>
            <div class="bg-element bg-element_second"></div>
            <div class="bg-element bg-element_third"></div>
            <div id="mainpage">
                <!-- c'est ici que les messages (erreur ou succès) s'affichent-->
                <h3 class="message" style="color: red"><?= App\Session::getFlash("error") ?></h3>
                <h3 class="message" style="color: green"><?= App\Session::getFlash("success") ?></h3>
                <header class="shadow">
                    <nav class="row">

                        <div class="nav-left row sat20">
                            <a href="index.php">
                                <h1 class="outfit">
                                    ForumName
                                </h1>
                            </a>
                            <?php
                            if(App\Session::isAdmin()){
                                ?>
                                <a href="index.php?ctrl=home&action=users">See all users</a>
                            <?php } ?>
                        </div>

                        <div class="nav-right row sat20">
                            <?php
                                // si l'utilisateur est connecté 
                                if(App\Session::getUser()){
                                    ?>
                                    <a href="index.php?ctrl=security&action=profile"><span class="fas fa-user"></span>&nbsp;<?= App\Session::getUser()?></a>
                                    <a href="index.php?ctrl=security&action=logout">Logout</a>
                                    <?php
                                }
                                else{
                                    ?>
                                    <a href="index.php?ctrl=security&action=loginPage">Login</a>
                                    <a href="index.php?ctrl=security&action=registerPage">Sign up</a>
                            <?php } ?>
                        </div>
                    </nav>
                </header>
                
                <main id="forum" class="fixed-section shadow">
                    
                        <?= $page ?>

                    <?php if($aside) { ?>
                        <aside class="column">
                            <a href="index.php?ctrl=topic&action=newTopic">
                                <div class="side-block new-topic shadow big-btn outfit">
                                    New Topic
                                </div>
                            </a>
    
                            <div class="side-block list-block shadow column">
                                <h3 class="outfit">CATEGORIES</h4>
                                <div class="list-block_list column">
                                    <?php foreach($categories as $category){ ?>
                                                <p>
                                                    <?= $category ?>
                                                </p>
                                    <?php } ?>
                                </div>
                            </div>
                            
                            <div class="side-block list-block shadow column last-block">
                                <h3 class="outfit">TOP USERS</h4>
                                <div class="list-block_list column">
                                    <?php foreach($users as $user){ ?>
                                        <div class="user row">
                                            <p>
                                                <?= $user->getNickname()?>
                                            </p>
                                            <p>
                                                <?= $user->getTotalTopicsPosts()?>
                                            </p>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </aside>
                    <?php } ?>

                </main>

            </div>
            <footer class="row shadow">

                <div class="footer_left row">
                    <div class="footer_link-column column">
                        <p class="link-column_title big-btn">
                            More ressources
                        </p>
                        <ul class="link-column_links column">
                            <li><a href="">Got none</a></li>
                        </ul>
                    </div>

                    <div class="footer_link-column column">
                        <p class="link-column_title big-btn">
                            Socials
                        </p>
                        <ul class="link-column_links column">
                            <li><a href="">Instagram</a></li>
                            <li><a href="">Everything</a></li>
                        </ul>
                    </div>

                    <div class="footer_link-column column">
                        <p class="link-column_title big-btn">
                            Help
                        </p>
                        <ul class="link-column_links column">
                            <li><a href="">Contact us</a></li>
                            <li><a href="">FAQ</a></li>
                            <li><a href="">Privacy policy</a></li>
                        </ul>
                    </div>
                </div>

                <div class="footer-right column">
                    <h2 class="h1">ForumName</h2>
                    <small>&copy; <?= date_create("now")->format("Y") ?> - <a href="#">Règlement du forum</a> - <a href="#">Mentions légales</a></small>
                </div>
            </footer>
        </div>
        <script
            src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous">
        </script>
        <script>
            $(document).ready(function(){
                $(".message").each(function(){
                    if($(this).text().length > 0){
                        $(this).slideDown(500, function(){
                            $(this).delay(3000).slideUp(500)
                        })
                    }
                })
                $(".delete-btn").on("click", function(){
                    return confirm("Do you really wish to delete that?")
                })
                $(".ban-btn").on("click", function(){
                    return confirm("Do you really wish to modify ban status?")
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
        </script>
        <script src="<?= PUBLIC_DIR ?>/js/script.js"></script>
    </body>
</html>