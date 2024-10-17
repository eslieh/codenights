const form = document.querySelector(".andjk"),
  continueBtn = form.querySelector(".loginBtn"),
  errorText = form.querySelector(".error-text");

form.onsubmit = (e) => {
  e.preventDefault(); // Prevent default form submission

  // Disable continue button and show loading indicator (optional)
  continueBtn.disabled = true;
  continueBtn.classList.add("loading"); // Add a loading class for visual feedback
  continueBtn.style.cursor = 'progress';
  // Create a new XMLHttpRequest object
  let xhr = new XMLHttpRequest();

  // Open the connection to "php/signup.php" with POST method
  xhr.open("POST", "php/details.php", true);

  // Set a function to handle the response when it's ready
  xhr.onload = function () {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;

        if (data === "success") {
          location.href = "account.php";
        } else {
          errorText.style.display = "block";
          errorText.textContent = data;
        }

        // Re-enable the continue button and remove loading indicator (optional)
        continueBtn.disabled = false;
        continueBtn.style.cursor = 'pointer';
        continueBtn.classList.remove("loading");
      } else {
        console.error("Error processing request:", xhr.statusText); // Handle errors gracefully (optional)
        // Re-enable the continue button on error
        continueBtn.disabled = false;
        continueBtn.classList.remove("loading"); // Remove loading indicator if used
      }
    }
  };

  // Create a FormData object to send form data
  let formData = new FormData(form);

  // Send the form data using the XMLHttpRequest object
  xhr.send(formData);
};
