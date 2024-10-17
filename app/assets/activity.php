<!-- <div class="splash-content">
    <div class="center-item-contaje">
        <div class="head-ed">reply to Vick's Post</div>
        <form action="#" method="post" class="replys">
            <textarea name="thread" id="" cols="7" rows="5" placeholder="Type Here"></textarea>
            <button class="submitrhead">Post reply</button>
        </form>
    </div>
</div> -->
<div class="feed-container">
    <div class="user-contenjsk">
        <img src="https://i.pinimg.com/564x/b7/63/8f/b7638fef96e65cceb1a2273bd5ddd7d9.jpg" alt="" class="user-image">
        <div class="user-contents">
            <a href="profile.php"><div class="user-name">Vick</div></a>
            <div class="time-posts">
                <a href="space.php"><span class="spacena">CodeNights</span></a>
            </div>
        </div>
        <div class="cancel-button">
            <button id="cancel"><i class="fas fa-x"></i></button>
        </div>
    </div>
    <div class="content-posts">
        <p class="contenjs">Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim dolores vel rerum autem adipisci saepe porro, sunt eligendi tenetur sapiente ut sit voluptatem fuga modi officiis, vero, impedit officia deserunt?</p>
        <img src="https://i.pinimg.com/736x/97/da/b6/97dab6617b6b23de3c330e15562bbb8b.jpg" alt="" class="post-image">
    </div>
    <div class="engage-ment">
        <button class="like">Like 20</button>
        <div class="engage">Reply</div>
    </div>
</div>
<div class="responces-container">
    <h4 class="jnkcd">Responces</h4>
    <div class="responces-contentes">
        <?php
            for($x = 0; $x < 5 ;$x++){
                ?>
                <div class="content-info">
                    <div class="user-profile">
                        <img src="https://i.pinimg.com/564x/b7/63/8f/b7638fef96e65cceb1a2273bd5ddd7d9.jpg" alt="" class="responce-image">
                    </div>
                    <div class="user-infoandresponce">
                        <div class="usernam-ingo">Vick</div>
                        <p class="responce-content">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Tenetur, fugit.</p>
                        <div class="like-botton-c">
                            <button class="like-responce">Like (3)</button>
                        </div>
                    </div>
                </div>
                <?php
            }
        ?>
    </div>
</div>