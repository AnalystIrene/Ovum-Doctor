// This is the major js file that carries most of the functionality of the app

// Helper function to load a view
function loadView(viewPath) {
    fetch(viewPath) // Fetch the view content
        .then((response) => response.text()) // Parse as text
        .then((html) => {
            const container = document.getElementById('view-container');
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const view = doc.querySelector('.view');
            container.innerHTML = ''; // Clear existing content
            container.appendChild(view); // Add new view
        })
        .catch((error) => {
            console.error('Error loading view:', error);
        });
}

// Determine login method and load the appropriate view
document.addEventListener('DOMContentLoaded', () => {
    const loginMethod = localStorage.getItem('loginMethod');

    if (loginMethod === 'password') {
        loadView('../views/rene.html');
    } else if (loginMethod === 'otp') {
        loadView('../views/patientInfoSummary.html');
    } else {
        console.error('No valid login method found.');
    }
});
 // route_to = "./views/rene.php";
                // window.location.href = route_to;
                    // route_to = "./views/patientInfoSummary.html";
                // window.location.href = route_to;