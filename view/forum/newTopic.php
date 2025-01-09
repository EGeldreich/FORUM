<div class="scrollable-content">
    <div class="form topic-form">
        <form class="column" method="post" action="index.php?ctrl=topic&action=postTopic">
            <div class="input-and-label shadow column">
                <label class="outfit h4" for="title">Topic title</label>
                <input type="text" name="title" id="title" placeholder="Chose a constructive and easy to understand title" maxlength="100" required>
            </div>
    
            <div class="input-and-label shadow column">
                <label class="outfit h4">Category</label>
                <div class="radio-categories row">
                    <input type="radio" name="category" id="farm-life" value="Farm Life">
                    <label class="sat18 info_cat_btn Far" for="farm-life">Farm Life</label>
    
                    <input type="radio" name="category" id="DIY-builds" value="DIY Builds">
                    <label class="sat18 info_cat_btn DIY" for="DIY-builds">DIY Builds</label>
    
                    <input type="radio" name="category" id="gardening" value="Gardening">
                    <label class="sat18 info_cat_btn Gar" for="gardening">Gardening</label>
    
                    <input type="radio" name="category" id="chickens" value="Chickens">
                    <label class="sat18 info_cat_btn Chi" for="chickens">Chickens</label>
    
                    <input type="radio" name="category" id="food-conservation" value="Food Conservation">
                    <label class="sat18 info_cat_btn Foo" for="food-conservation">Food Conservation</label>
                </div>
            </div>
    
            <div class="input-and-label shadow column">
                <label class="outfit h4" for="content">Post Content</label>
                <textarea name="content" id="content" placeholder="What do you want to talk about ?" required></textarea>
            </div>
    
            <input class="big-btn outfit" type="submit" value="Publish" name="postTopic">
        </form>
    </div>
</div>