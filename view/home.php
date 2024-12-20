<?php
    $categories = $result["data"]['categories']; 
    $topics = $result["data"]['topics']; 
?>
<h1>BIENVENUE SUR LE FORUM</h1>

<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit ut nemo quia voluptas numquam, itaque ipsa soluta ratione eum temporibus aliquid, facere rerum in laborum debitis labore aliquam ullam cumque.</p>

<p>
    <a href="index.php?ctrl=security&action=login">Se connecter</a>
    <a href="index.php?ctrl=security&action=register">S'inscrire</a>
</p>

<br>
<br>

<h4>CATEGORIES</h4>
<?php foreach($categories as $category){ ?>
    <p><?= $category ?></p>
<?php } ?>

<br>
<br>

<h4>TOPICS</h4>
<table>
    <thead>
        <tr>
            <th>Title</th>
            <th>Message</th>
            <th>Date</th>
            <th>Category</th>
            <th>User</th>
        </tr>
    </thead>
    <tbody>
<?php foreach($topics as $topic){ ?>
    <tr>
        <td><?= $topic->getTitle()?></td>
        <td><?= $topic->getContent()?></td>
        <td><?= $topic->getCreationDate()?></td>
        <td><?= $topic->getCategory()?></td>
        <td><?= $topic->getUser()?></td>
    </tr>
<?php } ?>
    </tbody>
</table>