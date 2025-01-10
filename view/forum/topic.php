<?php
    $topic = $result["data"]['topic'];
    $posts = $result["data"]['posts'];

    use Service\Functions;
    $functions = new Functions();
    
    $topicUser = $topic->getUser() ?: "DeletedUser";
?>

<div class="fixed-section fixed-section__topic shadow">
    <div class="scrollable-content scrollable-content__topic column">

        <div class="topic_title_cat">
            <h3 class="outfit">
                <?= $topic->getTitle() ?>
            </h3>
            <div class="info_cat">
                <p class="info_cat_btn <?= substr($topic->getCategory(), 0, 3)?>">
                    <?= $topic->getCategory()?>
                </p>
            </div>
        </div>

        <div class="topic-post row">
            <p class="topic-post_content"><?= $topic->getContent()?></p>
            <div class="poster-info column">
                <div class="poster-info_pp_stats row">
                    <div class="user_pp">
                        <p class="h3">
                            <?= substr($topicUser, 0, 1)?>
                        </p>
                    </div>
                    <div class="stats column">
                        <p><?= $topic->getTotalTopics()?> topics</p>
                        <p><?= $topic->getTotalPosts()?> posts</p>
                    </div>
                </div>
                <div class="poster-info_pseudo_time">
                    <p class="pseudo outfit">
                        <?= $topicUser ?>
                    </p>
                    <p class="post_time sat18">
                        <?= $functions->timeElapsed($topic->getCreationDate()); ?>
                    </p>
                </div>
                <div class="post-count">
                    <p class="sat20">
                        0
                    </p>
                </div>
            </div>
        </div>

        <?php foreach($posts as $post){
            if($post->getId()) { // Check if the post is valid (because there is at minimum an empty post in $posts?>
                <div class="topic-post row">
                    <div class="poster-info column">
                        <div class="poster-info_pp_stats row">
                            <div class="user_pp">
                                <p class="h3">
                                    <?= substr($post->getUser(), 0, 1)?>
                                </p>
                            </div>
                            <div class="stats column">
                                <p><?= $post->getTotalTopics()?> topics</p>
                                <p><?= $post->getTotalPosts()?> posts</p>
                            </div>
                        </div>
                        <div class="poster-info_pseudo_time">
                            <p class="pseudo outfit">
                                <?= $post->getUser()?>
                            </p>
                            <p class="post_time sat18">
                                <?= $functions->timeElapsed($post->getPostDate()); ?>
                            </p>
                        </div>
                        <div class="post-count">
                            <p class="sat20">
                            <?= $post->getResponseNumber()?>
                            </p>
                        </div>
                    </div>
                    <p class="topic-post_content"><?= $post->getPostContent()?></p>
                </div>
        <?php }
        } ?>
    </div>    
</div>

<!-- NEW POST -->
<?php if($topic->getClosed() == 0){ ?>
    <label class="reply-btn_label outfit big-btn"for="reply">Reply</label>
    <input class="reply-btn" type="checkbox" name="reply" id="reply" checked>
    <div class="post-form column">
        <form  class="column" method="post" action='index.php?ctrl=post&action=newPost&id=<?= $topic->getId() ?>'>
            <textarea name="content" id="content" placeholder="Write your reply here" required></textarea>
            <div class="post-form_btns row">
                <input class="outfit big-btn" type="reset" value="Abort" />
                <input class="outfit big-btn" type="submit" value="Post" name="newPost">
            </div>
        </form>
    </div>
<?php } ?>

<!-- LOCK AND DEL BTNS -->

<?php // IF AUTHOR OR ADMIN, ability to lock topic (prevents new posts)
    if(App\Session::getUser()){  // CHECK 
        if($topic->getUser() == App\Session::getUser() || App\Session::isAdmin()){ 
            if($topic->getClosed() == 0) { 
                // IF UNLOCKED, can lock?>
                <a class="topic-btn lock" href="index.php?ctrl=topic&action=lockTopic&id=<?= $topic->getId(); ?>">
                    <button class="outfit big-btn">
                        Lock
                    </button>
                </a>
            <?php } else { 
                // IF LOCKED, can unlock?>
                <a class="topic-btn lock" href="index.php?ctrl=topic&action=unlockTopic&id=<?= $topic->getId(); ?>">
                    <button class="outfit big-btn green">
                        Unlock
                    </button>
                </a>
        <?php }
        } 
        // IF ADMIN, ability to delete topic
        if(App\Session::isAdmin()) { ?>
            <a class="topic-btn del" href="index.php?ctrl=topic&action=deleteTopic&id=<?= $topic->getId(); ?>">
                <button class="delete-btn outfit big-btn red">
                    Delete
                </button>
            </a>
<?php }
}?>
