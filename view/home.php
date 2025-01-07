<?php
    $topics = $result["data"]['topics']; 
    // UNDISPLAYED DATAS $topic->getSortDate() $topic->getClosed()
    use Service\Functions;
    $functions = new Functions();
?>
<div class="scrollable-content">
    <div class="topic-list column">
        <?php foreach($topics as $topic){ ?>
            <a href='index.php?ctrl=topic&action=findTopic&id=<?= $topic->getId()?>'>
                <div class="topic-card row shadow">

                    <div class="topic-card_left column">
                            <h3 class="topic-card_title outfit">
                                <?php
                                    $out = strlen($topic->getTitle()) > 50 ? substr($topic->getTitle(),0,50)."..." : $topic->getTitle(); 
                                ?>
                                <?= $out?>
                            </h3>

                        <div class="topic-card_info row">

                            <div class="info_user row">

                                <div class="user_pp">
                                    <p class="h3">
                                        <?= substr($topic->getUser(), 0, 1)?>
                                    </p>
                                </div>

                                <div class="user_pseudo_time column">
                                    <p>
                                        <?= $topic->getUser()?>
                                    </p>
                                    <p class="topic_time">
                                        <?= $functions->timeElapsed($topic->getCreationDate()); ?>
                                    </p>
                                </div>
                            </div>

                            <div class="separator"></div>

                            <div class="info_cat">
                                <p class="info_cat_btn <?= substr($topic->getCategory(), 0, 3)?>">
                                    <?= $topic->getCategory()?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="separator"></div>

                    <div class="topic-card_right">
                        <p>
                            <?= $topic->getContent()?>
                        </p>
                    </div>
                    <div class="topic-card_post-count">
                        <p class="sat20">
                            <?= $topic->getPostCount()?>
                        </p>
                    </div>
                </div>
            </a>      
        <?php } ?>
    </div>
</div>


