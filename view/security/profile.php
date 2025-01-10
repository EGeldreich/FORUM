<?php
    $user = $result["data"]['user'];
    use Service\Functions;
    $functions = new Functions();
?>
<div class="fixed-section fixed-section__topic fixed-section__profile shadow">
    <div class="user-page column">
        <div class="user-page_name row">
            <div class="user_pp">
                <p class="h3">
                    <?= substr($user, 0, 1)?>
                </p>
            </div>
            <h3 class="outfit"><?= $user ?></h3>
        </div>
        <div class="user-page_info user-page_block">
            <h4 class="outfit">Infos</h4>
            <p>Mail adress : <?= $user->getMail() ?></p>
            <p>User since : <?= $user->getRegistrationDate() ?></p>
        </div>

        <div class="user-page_stats user-page_block">
            <h4 class="outfit">Stats</h4>
            <p><?= $user->getTotalTopics() ?> topics created.</p>
            <p><?= $user->getTotalPosts() ?> posts written.</p>
        </div>

        <a class="profile-btn" href="index.php?ctrl=security&action=deleteUser">
            <button class="delete-btn outfit big-btn red">
                Delete account
            </button>
        </a>

    </div>
</div>
