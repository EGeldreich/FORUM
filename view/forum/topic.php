<?php
    $topic = $result["data"]['topic'];
    $posts = $result["data"]['posts'];

    use Service\Functions;
    $functions = new Functions();
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
                            <?= substr($topic->getUser(), 0, 1)?>
                        </p>
                    </div>
                    <div class="stats column">
                        <p><?= $topic->getTotalTopics()?> topics</p>
                        <p><?= $topic->getTotalPosts()?> posts</p>
                    </div>
                </div>
                <div class="poster-info_pseudo_time">
                    <p class="pseudo outfit">
                        <?= $topic->getUser()?>
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

        

<?php if($topic->getClosed() == 0 && App\Session::getUser()){ ?>
    <div class="form post-form column">
        <form  method="post" action='index.php?ctrl=post&action=newPost&id=<?= $topic->getId() ?>'>
                <textarea name="content" id="content" placeholder="Write your reply here" required></textarea>
            <input type="submit" value="Post" name="newPost">
        </form>
    </div>
<?php } ?>

<?php
if($topic->getUser() == App\Session::getUser() || App\Session::getUser()->hasRole("ROLE_ADMIN")){ 
    if($topic->getClosed() == 0) { ?>
        <a href="index.php?ctrl=topic&action=lockTopic&id=<?= $topic->getId() ?>">Lock topic</a>
    <?php } else { ?>
        <a class="delete-btn" href="index.php?ctrl=topic&action=unlockTopic&id=<?= $topic->getId() ?>">Unlock topic</a>
<?php }
} 
if(App\Session::getUser()->hasRole("ROLE_ADMIN")) { ?>
    <a href="index.php?ctrl=topic&action=deleteTopic&id=<?= $topic->getId(); ?>">
        <button class="delete-btn outfit big-btn">
            Delete topic
        </button>
    </a>
<?php }
?>