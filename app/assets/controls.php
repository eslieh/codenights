<div class="account-andnot">
    <div class="app-labelecdr">code<div class="cnkd">nights</div></div>
    <div class="concdcstents">
        <a href="notifications.php">
            <div class="container">
                <i class="fa-regular fa-bell"></i>
                <div class="counter-so" id="notificationCounter">0</div>
            </div>
        </a>
        <a href="account.php"><img src="<?php echo $profileUrl ?>" alt="" class="account-conrne"></a>
    </div>
</div>

<script>
    const notificationSound = new Audio('../media/sound.wav'); 

    let currentNotificationCount = 0; 
    let isUserInteracted = false; // Flag to track user interaction

    // Function to check notifications
    function checkNotifications() {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', 'php/get_notifications_count.php', true);
        xhr.onload = function () {
            if (this.status === 200) {
                const response = JSON.parse(this.responseText);
                const newNotificationCount = parseInt(response.count);
                
                // Check if there's an increment in the notification count
                if (newNotificationCount > currentNotificationCount) {
                    document.getElementById('notificationCounter').textContent = newNotificationCount;
                    
                    // Play sound only if user has interacted
                    if (isUserInteracted) {
                        notificationSound.play().catch(error => {
                            console.log('Error playing sound:', error);
                        });
                    }
                }

                // Update the current count
                currentNotificationCount = newNotificationCount;
            }
        };
        xhr.send();
    }

    // Fetch initial notification count when the page loads
    document.addEventListener("DOMContentLoaded", () => {
        checkNotifications(); // Initial fetch to update the counter
    });

    // Detect any user interaction to enable the sound (click, keypress, or touchstart)
    function enableSoundOnInteraction() {
        isUserInteracted = true;
        document.removeEventListener("click", enableSoundOnInteraction);
        document.removeEventListener("keypress", enableSoundOnInteraction);
        document.removeEventListener("touchstart", enableSoundOnInteraction);
    }

    document.addEventListener("click", enableSoundOnInteraction);
    document.addEventListener("keypress", enableSoundOnInteraction);
    document.addEventListener("touchstart", enableSoundOnInteraction);

    // Poll the server every 5 seconds to check for notifications
    setInterval(checkNotifications, 5000);
</script>
