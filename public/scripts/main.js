// Helper function to load a view
function loadView(viewPath, callback) {
    fetch(viewPath) // Fetch the view content
        .then((response) => response.text()) // Parse as text
        .then((html) => {
            const container = document.getElementById('view-container'); // Ensure this is the right container
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const view = doc.querySelector('.view');
            container.innerHTML = ''; // Clear existing content
            container.appendChild(view); // Add new view

            if (typeof callback === 'function') {
                callback(); // Run the callback once the view is loaded
            }
        })
        .catch((error) => {
            console.error('Error loading view:', error);
        });
}

// Helper function to dynamically load a script
function loadScript(scriptSrc, callback) {
    const existingScript = document.querySelector(`script[src="${scriptSrc}"]`);
    if (!existingScript) { // Load only if the script is not already loaded
        const script = document.createElement('script');
        script.src = scriptSrc;
        script.onload = callback;
        document.body.appendChild(script);
    } else {
        if (typeof callback === 'function') callback(); // If script is already loaded, run the callback
    }
}

// Load the necessary view and corresponding script based on the login method
document.addEventListener('DOMContentLoaded', () => {
    const loginMethod = localStorage.getItem('loginMethod');
    let viewPath = '';

    if (loginMethod === 'password') {
        viewPath = '../views/after_pw.html';
    } else if (loginMethod === 'one_time passcode') {
        viewPath = '../views/after_otp.html';
    } else {
        console.error('No valid login method found.');
        return; // Exit if no valid login method is found
    }

    if (viewPath) {
        loadView(viewPath, function () {
            // Load the specific JS based on the view loaded
            if (viewPath.includes('after_pw')) {
                loadScript('../public/scripts/calendar.js', initializeCalendar); // Load calendar.js dynamically
            } else if (viewPath.includes('after_otp')) {
                loadScript('../public/scripts/chart.js', initializeCycleChart); // Load chart.js dynamically
            }
        });
    }
});




// Mobile menu toggle
const hamburger = document.querySelector('.hamburger');
const topNav = document.querySelector('.top-nav');

hamburger.addEventListener('click', () => {
    topNav.classList.toggle('active');
});

// Close mobile menu when clicking outside
document.addEventListener('click', (e) => {
    if (!topNav.contains(e.target) && topNav.classList.contains('active')) {
        topNav.classList.remove('active');
    }
});

// Close mobile menu when window is resized above mobile breakpoint
window.addEventListener('resize', () => {
    if (window.innerWidth > 767 && topNav.classList.contains('active')) {
        topNav.classList.remove('active');
    }
});


// function to logout
function logout() {
    const logOutButton = document.getElementById('logout');
    logOutButton.addEventListener('click', () => {
        localStorage.removeItem('loginMethod');
        window.location.href = '../login.html';
    });
}
// Call the logout function for now
logout();