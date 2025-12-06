document.addEventListener('DOMContentLoaded', function() {
    // Get references to the button and result div
    const lookupButton = document.getElementById('lookup');
    const resultDiv = document.getElementById('result');
    const countryInput = document.getElementById('country');

    // Click event listener to the lookup button
    lookupButton.addEventListener('click', function(e) {
        e.preventDefault(); // Prevents form submission if inside a form
        
        // Gets country value from the input field
        const country = countryInput.value.trim();
        
        // Creates URL with query parameter
        const url = `world.php?country=${encodeURIComponent(country)}`;
        
        // Makes AJAX request 
        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text();
            })
            .then(data => {
                // Displays data in the result div
                resultDiv.innerHTML = data;
            })
            .catch(error => {
                console.error('Error:', error);
                resultDiv.innerHTML = '<p>An error occurred while fetching data.</p>';
            });
    });
});