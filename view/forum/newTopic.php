<h1>New topic</h1>

<div class="form topic-form column">

    <form class="" method="post" action="index.php?ctrl=topic&action=postTopic">
        <div class="input-and-label column">
            <label for="title">Topic title</label>
            <input type="text" name="title" id="title" placeholder="Chose a constructive and easy to understand title" required>
        </div>

        <div class="input-and-label column">
            <label for="title">Category</label>
            <div class="radio-categories">
                <input type="radio" name="category" id="farm-life" value="Farm Life">
                <label for="farm-life">Farm Life</label>

                <input type="radio" name="category" id="DIY-builds" value="DIY Builds">
                <label for="DIY-builds">DIY Builds</label>

                <input type="radio" name="category" id="gardening" value="Gardening">
                <label for="gardening">Gardening</label>

                <input type="radio" name="category" id="chickens" value="Chickens">
                <label for="chickens">Chickens</label>

                <input type="radio" name="category" id="food-conservation" value="Food Conservation">
                <label for="food-conservation">Food Conservation</label>
            </div>
        </div>

        <div class="input-and-label column">
            <label for="content">Post Content</label>
            <textarea name="content" id="content" placeholder="What do you want to talk about ?" required></textarea>
        </div>

        <input type="submit" value="Publish" name="postTopic">
    </form>
</div>