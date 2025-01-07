<?php
    $topic = $result["data"]['topic'];
    $posts = $result["data"]['posts'];
?>

<br>
<br>
<h1>SPECIFIC TOPIC</h1>
<br>
<br>
<table>
    <thead>
        <tr>
            <th>Title</th>
            <th>Category</th>
            <th>User</th>
            <th>Nb Topics</th>
            <th>Nb Posts</th>
            <th>Date</th>
            <th>Content</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?= $topic->getTitle() ?></td>
            <td><?= $topic->getCategory() ?></td>
            <td><?= $topic->getUser() ?></td>
            <td><?= $topic->getTotalTopics()?></td>
            <td><?= $topic->getTotalPosts()?></td>
            <td><?= $topic->getCreationDate()?></td>
            <td><?= $topic->getContent()?></td>
        </tr>
    </tbody>
</table>
<br>
<br>
<?php
if($topic->getUser() == App\Session::getUser() || App\Session::getUser()->hasRole("ROLE_ADMIN")){ 
    if($topic->getClosed() == 0) { ?>
        <a href="index.php?ctrl=topic&action=lockTopic&id=<?= $topic->getId() ?>">Lock topic</a>
    <?php } else { ?>
        <a href="index.php?ctrl=topic&action=unlockTopic&id=<?= $topic->getId() ?>">Unlock topic</a>
<?php }
} 
if(App\Session::getUser()->hasRole("ROLE_ADMIN")) { ?>
    <a href="index.php?ctrl=topic&action=deleteTopic&id=<?= $topic->getId() ?>">delete topic</a>
<?php }
?>

<br>
<br>

<h4>POSTS</h4>
<table>
    <thead>
        <tr>
            <th>User</th>
            <th>Nb Topics</th>
            <th>Nb Posts</th>
            <th>Content</th>
            <th>responseNumber</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($posts as $post){ ?>
            <tr>
                <td><?= $post->getUser()?></td>
                <td><?= $post->getTotalTopics()?></td>
                <td><?= $post->getTotalPosts()?></td>
                <td><?= $post->getPostContent()?></td>
                <td><?= $post->getResponseNumber()?></td>
                <td><?= $post->getPostDate()?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<br>
<br>
<?php if($topic->getClosed() == 0 && App\Session::getUser()){ ?>
    <div class="form post-form column">
        <form class="" method="post" action='index.php?ctrl=post&action=newPost&id=<?= $topic->getId() ?>'>
                <textarea name="content" id="content" placeholder="Write your reply here" required></textarea>
            <input type="submit" value="Post" name="newPost">
        </form>
    </div>
<?php } ?>
