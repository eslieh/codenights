<style>
div#account {
    color: white;
}
</style>
<div class="search-container">
    <form action="#" method="get" class="search-codkmkld" id="searchForm">
        <div class="iouhcd"><i class="fa-solid fa-magnifying-glass"></i></div>
        <input type="text" name="query" class="search-input" id="searchInput" placeholder="Search Code">
    </form>
</div>
<div class="results-contents" id="resultsContainer">
    <div class="user-results" id="userResults"></div>
    <div class="space-results" id="spaceResults"></div>
</div>

<script>
document.getElementById('searchInput').addEventListener('keyup', function() {
    let query = this.value;

    if (query.length > 0) {
        // Create a new XMLHttpRequest object
        let xhr = new XMLHttpRequest();

        // Open the connection to the server
        xhr.open("GET", "php/search.php?query=" + encodeURIComponent(query), true);

        // Set up a function to handle the response
        xhr.onload = function() {
            if (xhr.status === 200) {
                // Update the results container with the response
                document.getElementById('resultsContainer').innerHTML = xhr.responseText;
            }
        };

        // Send the request
        xhr.send();
    } else {
        // Clear results if the input is empty
        document.getElementById('resultsContainer').innerHTML = '';
    }
});
</script>
