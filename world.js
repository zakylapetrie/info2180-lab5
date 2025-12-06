document.addEventListener('DOMContentLoaded', function() {
    // Get references to the buttons and result div
    const lookupButton = document.getElementById('lookup');
    const lookupCitiesButton = document.getElementById('lookup-cities');
    const resultDiv = document.getElementById('result');
    const countryInput = document.getElementById('country');

    // Click event listener for the lookup country button
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

    // Click event listener for the lookup cities button
    lookupCitiesButton.addEventListener('click', function(e) {
        e.preventDefault(); // Prevents form submission if inside a form
        
        // Gets country value from the input field
        const country = countryInput.value.trim();
        
        // Creates URL with query parameter including lookup=cities
        const url = `world.php?country=${encodeURIComponent(country)}&lookup=cities`;
        
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