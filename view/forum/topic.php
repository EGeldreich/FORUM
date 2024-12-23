<?php
    $topic = $result["data"]['topic'];
    $posts = $result["data"]['posts'];
?>
<h1>SPECIFIC TOPIC</h1>

<br>
<br>

<h2><?= $topic->getTitle() ?> </h4>
<p><?= $topic->getCategory() ?></p>
<p><?= $topic->getUser() ?></p>

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
<div class="form post-form column">
    <form class="" method="post" action="index.php?ctrl=post&action=postPost">
            <textarea name="content" id="content" placeholder="Write your reply here" required></textarea>
        <input type="submit" value="Post" name="postPost">
    </form>
</div>
