<?php
    if (isset($_GET['space_id'])) {
        $spaceq = mysqli_query($conn, "SELECT * FROM spaces WHERE space_id = '{$_GET['space_id']}'");
        if(mysqli_num_rows($spaceq) > 0){
            $space_data = mysqli_fetch_assoc($spaceq);
        }
    } else {
        ?>
        <script>location.href="./"</script>
        <?php
    }
?>

<div class="space-container-if">
    <div class="space-name">
        <h1 class="spancena"><?php echo $space_data['space_name']?></h1>
        <span class="about-space"><?php echo $space_data['space_description']?></span>
    </div>
    <div class="activitucdnk">
        <div class="members-iof"><?php echo $space_data['members']?> Members</div>
        <div class="members-iof"><?php echo $space_data['activity']?> Posts</div>
    </div>
    <div class="follow-and-create-post">
            <button class="joinsjk">Join</button>
        <div class="createPost">Create a post</div>
    </div>
</div>
<div class="space-feed">
<?php
    include('assets/home-feed.php');
?>
<button></button>
</div>
<input type="text" value="<?php echo $space_data['user_id']?>" name="space_id">
<script>
document.addEventListener("DOMContentLoaded", (e) => {
    e.preventDefault();
    let createPost = document.querySelector(".createPost");

    createPost.onclick = () => {
        createPost.style.cursor = "pointer";
        let over_post = document.createElement("div");
        over_post.classList.add("splash-content");
        over_post.innerHTML = `
            <div class="center-item-contaje">
                <div class="head-ed">Post to <?php echo $space_data['space_name']; ?></div>
                <button id="cancecdl"><i class="fas fa-x"></i></button>
                <form id="postForm" class="replys">
                    <div class="error-text" style="display: none;"></div>
                    <textarea name="thread" id="" cols="7" rows="5" placeholder="Type Here"></textarea>
                    
                    <!-- Image Upload Button -->
                    <input type="file" id="imageUpload" name="image" accept="image/*" style="display: none;" />
                    <input type="text" value="<?php echo $space_data['space_id']?>" name="space_id" hidden>
                    <button type="button" class="upload-btn" onclick="document.getElementById('imageUpload').click();">Attach image</button>
                    
                    <!-- Image Preview -->
                    <img src="" alt="Image Preview" class="previe-ima" id="imagePreview" style="display: none; max-width: 200px; margin-top: 10px;">
                    
                    <button type="submit" class="submitrhead">Post reply</button>
                </form>
            </div>
        `;

        over_post.style.display = "grid";

        // Image Preview functionality
        over_post.querySelector('#imageUpload').addEventListener('change', function(event) {
            var file = event.target.files[0];
            var preview = over_post.querySelector('#imagePreview');
            
            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block'; // Show the preview image
                };
                reader.readAsDataURL(file);
            }
        });

        // Handle the form submission via AJAX
        over_post.querySelector('#postForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission
            
            var formData = new FormData(this); // Collect form data, including the image
            
            // Send form data via AJAX
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'php/space_post.php', true); // Replace with your PHP script
            
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.status === 'success') {
                        // Handle successful response
                        alert('Post submitted successfully!');
                        over_post.remove(); // Optionally close the modal after success
                    } else {
                        // Handle error response
                        over_post.querySelector('.error-text').style.display = 'block';
                        over_post.querySelector('.error-text').textContent = response.message;
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

        // Cancel button functionality
        over_post.querySelector("#cancecdl").onclick = () => {
            over_post.remove();
        };

        document.body.appendChild(over_post);
    };
});

</script>