<!-- <div class="splash-content">
    <div class="center-item-contaje">
        <div class="head-ed">reply to Vick's Post</div>
        <form action="#" method="post" class="replys">
            <textarea name="thread" id="" cols="7" rows="5" placeholder="Type Here"></textarea>
            <button class="submitrhead">Post reply</button>
        </form>
    </div>
</div> -->
<style>
@media only screen and (max-width: 767px) {
    section.rightcenter {
        width: 98%;
        background: #121212;
        margin-top: 12vh;
        border-radius: 12px;
        overflow: auto;
        height: 87vh;
        position: absolute;
        margin-left: 1%;
        box-shadow: 0 0 15px #353434;
        display: flex;
    }
}
.myapp-info {
    display: none;
}
</style>
<?php
    include("../../conn/config.php");
    $feed_id = $_POST['post_id'];
?>

<div class="feed-container" id="<?php echo $_POST['post_id']?>">
<div id="cancel"><i class="fas fa-x"></i></div>
    <?php 
        $fed = mysqli_query($conn, "SELECT * FROM feeds WHERE feed_id = '{$feed_id}'");
        $feeddatas = mysqli_fetch_assoc($fed);
        $user_activityQ = mysqli_query($conn,"SELECT username, profile, fname,lname FROM users  WHERE user_id = '{$feeddatas['user_id']}'");
        $userdatas = mysqli_fetch_assoc($user_activityQ);
        $spaceq = mysqli_query($conn, "SELECT space_name FROM spaces WHERE space_id = '{$feeddatas['space_id']}'");
            $spacedata = mysqli_fetch_assoc($spaceq);
    ?>
    <div class="user-contenjsk">
        <img src="../media/profiles/<?php echo $userdatas['profile']?>" alt="" class="user-image">
        <div class="user-contents">
            <a href="profile.php?user_id=<?php echo $feeddatas['user_id']?>"><div class="user-name"><?php echo $userdatas['username']?></div></a>
            <div class="time-posts">
                <a href="space.php?space_id=<?php echo $feeddatas['space_id']?>"><span class="spacena"><?php echo $spacedata['space_name']?></span></a>
            </div>
        </div>
        
    </div>
    <div class="content-posts">
        <p class="contenjs"><?php echo $feeddatas['thread']?></p>
        <?php
            $image_urls = $feeddatas['image_url'];
            if($image_urls !== null){
                ?>
                <img src="../media/profiles/<?php echo $image_urls?>" alt="" class="post-image">
            <?php
            }
        ?>
    </div>
    <div class="reply-texts"><button class="njkcf">Reply to <?php echo $userdatas['fname']?>'s Post</button></div>

</div>
<div class="responces-container">
    <h4 class="jnkcd">Responces</h4>
    <div class="responces-contentes">
        <?php
            $queryr = mysqli_query($conn, "SELECT * FROM reply WHERE feed_id = '{$feeddatas['feed_id']}' ORDER BY id DESC limit 10");
            if(mysqli_num_rows($queryr) > 0){
                while($responsedata = mysqli_fetch_assoc($queryr)){
                    $user_activity2 = mysqli_query($conn,"SELECT username, profile FROM users  WHERE user_id = '{$responsedata['user_id']}'");
                    $userdatass = mysqli_fetch_assoc($user_activity2);
                    ?>
                    <div class="content-info">
                        <div class="user-profile">
                            <img src="../media/profiles/<?php echo $userdatass['profile']?>" alt="" class="responce-image">
                        </div>
                        <div class="user-infoandresponce">
                            <div class="usernam-ingo"><?php echo $userdatass['username']?></div>
                            <p class="responce-content"><?php echo $responsedata['thread']?>.</p>
                            <!-- <div class="like-botton-c">
                                <button class="like-responce">Like (<?php echo $responsedata['likes']?>)</button>
                            </div> -->
                        </div>
                    </div>
                    <?php

                }
            }else{
                echo "no responces yet!";
            }
        ?>
        
    </div>
</div>
<script>
    document.getElementById("cancel").addEventListener("click", () => {
        document.querySelector("section.rightcenter").style.display = "none"
        document.getElementById("<?php echo $feed_id?>").remove();
        document.querySelector(".myapp-info").style.display = "grid";
    })
    document.querySelector(".njkcf").onclick = () =>{
        let replyHolder =document.createElement("div");
        replyHolder.classList.add("splash-content");
        replyHolder.innerHTML = `<div class="center-item-contaje">
                                    <div class="head-ed">reply to <?php echo $userdatas['fname']?>'s Post</div>
                                    <form action="#" method="post" class="replys">
                                        <div class="error-text" style="display: none;"></div>
                                        <textarea name="thread" id="" cols="7" rows="5" placeholder="Type Here"></textarea>
                                        <button class="submitrhead">Post reply</button>
                                    </form>
                                </div>`;
            replyHolder.querySelector('.replys').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission
            
            var formData = new FormData(this); // Collect form data, including the image
            
            // Send form data via AJAX
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'php/reply.php?feed_id=<?php echo $feeddatas['feed_id']?>&user_id=<?php echo $feeddatas['user_id']?>', true); // Replace with your PHP script
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.status === 'success') {
                        // Handle successful response
                        alert('Post submitted successfully!');
                        document.querySelector(".content-feed-display").removeChild(replyHolder);
                    } else {
                        // Handle error response
                        replyHolder.querySelector('.error-text').style.display = 'block';
                        replyHolder.querySelector('.error-text').textContent = response.message;
                    }
                } else {
                    alert('An error occurred during the submission.');
                }
            };

            xhr.onerror = function() {
                alert('Request failed.');
            };

            xhr.send(formData); // Send the form data, including the image file
        });
        document.querySelector(".content-feed-display").appendChild(replyHolder);

   
    }
</script>