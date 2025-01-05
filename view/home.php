<?php
    $topics = $result["data"]['topics']; 
    // UNDISPLAYED DATAS $topic->getSortDate() $topic->getClosed()

    function timeElapsed($creationDate) {
        $now = new DateTime(); // curr date and time
        $creation = new DateTime($creationDate); // topic creation date
        $interval = $now->diff($creation); // Calculate interval
    
        // Format the result
        if ($interval->y > 0) {
            return $interval->y . 'y';
        } elseif ($interval->m > 0) {
            return $interval->m . 'mo';
        } elseif ($interval->d > 0) {
            return $interval->d . 'd';
        } elseif ($interval->h > 0) {
            return $interval->h . 'h';
        } elseif ($interval->i > 0) {
            return $interval->i . 'm';
        } else {
            return $interval->s . 's';
        }
    }
?>
<div class="scrollable-content">
    <div class="topic-list column">
        <?php foreach($topics as $topic){ ?>
            <a href='index.php?ctrl=topic&action=findTopic&id=<?= $topic->getId()?>'>
                <div class="topic-card row shadow">

                    <div class="topic-card_left column">

                        <h3 class="topic-card_title outfit">
                            <?= $topic->getTitle()?>
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
                                        <?= timeElapsed($topic->getCreationDate()); ?>
                                    </p>
                                </div>
                            </div>

                            <div class="separator"></div>

                            <div class="info_cat">
                                <p class="info_cat_btn">
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
                        <p class="h4">
                            <?= $topic->getPostCount()?>
                        </p>
                    </div>
                </div>
            </a>      
        <?php } ?>
    </div>
</div>


