<h1>New topic</h1>

<div class="form topic-form column">

    <form class="" action="POST" action="index.php?ctrl=security&action=login">
        <!-- Change url of link in layout ? -->
        <div class="input-and-label column">
            <label for="title">Topic title</label>
            <input type="text" name="title" id="title" placeholder="Chose a constructive and easy to understand title">
        </div>

        <div class="input-and-label column">
            <label for="title">Topic title</label>
            <div class="radio-categories">
                <input type="radio" name="farm-life" id="farm-life">
                <label for="farm-life">Farm Life</label>

                <input type="radio" name="DIY-builds" id="DIY-builds">
                <label for="DIY-builds">DIY Builds</label>

                <input type="radio" name="gardening" id="gardening">
                <label for="gardening">Gardening</label>

                <input type="radio" name="chickens" id="chickens">
                <label for="chickens">Chickens</label>

                <input type="radio" name="food-conservation" id="food-conservation">
                <label for="food-conservation">Food Conservation</label>
            </div>
        </div>

        <div class="input-and-label column">
            <label for="content">Post Content</label>
            <textarea name="content" id="content" placeholder="What do you want to talk about ?"></textarea>
        </div>

    </form>
</div>