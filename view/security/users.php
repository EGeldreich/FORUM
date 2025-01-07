<?php
    $users = $result["data"]['users']; 
    use Service\Functions;
    $functions = new Functions();
?>

<div class="scrollable-content scrollable-content__full">
    <div class="user-list row wrap">
        <?php foreach($users as $user){ ?>
            <div class="user-card row shadow">
                <div class="user column">
                    <p class="h3">
                        <?= $user; ?>
                    </p>
                    <div class="info_user row">
                        <div class="user_pp">
                            <p class="h3">
                                <?= substr($user, 0, 1)?>
                            </p>
                        </div>
                        <p class="user_time">
                            <?= $user->getRegistrationDate(); ?>
                        </p>
                    </div>
                </div>
                <?php if(!$user->hasRole("ROLE_ADMIN")) {
                    if($user->getBan() == 0) {?>
                    <a href="index.php?ctrl=security&action=banUser&id=<?= $user->getId(); ?>">
                        <button class="ban-btn outfit big-btn">
                            Ban
                        </button>
                    </a>
                <?php }else { ?>
                    <a href="index.php?ctrl=security&action=unbanUser&id=<?= $user->getId(); ?>">
                        <button class="ban-btn outfit big-btn green">
                            Unban
                        </button>
                    </a>
                <?php }} else { ?>
                    <p class="outfit big-btn">Admin</p>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</div>


