document.getElementById('image').addEventListener('click', function() {
    // Trigger the hidden file input when the button is clicked
    document.getElementById('file-input').click();
});

document.getElementById('file-input').addEventListener('change', function() {
    // Automatically upload the file using AJAX once it is selected
    var fileInput = document.getElementById('file-input');
    if (fileInput.files && fileInput.files[0]) {
        var formData = new FormData();
        formData.append('profile_photo', fileInput.files[0]);

        // Send the form data to the PHP script using AJAX
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'php/profilepic.php', true);

        // On successful upload, update the DOM with the new image
        xhr.onload = function() {
            if (xhr.status === 200) {
                // Assume the PHP script returns the new image URL
                var response = JSON.parse(xhr.responseText);
                if (response.status === 'success') {
                    // Update the image source in the DOM
                    document.getElementById('image').src = response.new_image_url;
                } else {
                    alert(response.message); // Handle error response
                }
            } else {
                alert('An error occurred during the file upload.');
            }
        };

        xhr.send(formData);
    }
});