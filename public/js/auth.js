document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('loginForm');
    const loginMethod = document.getElementById('login_method');
    const authFieldContainer = document.getElementById('auth-field-container');
    const authFieldInput = document.getElementById('auth-field-input');
    const authFieldLabel = document.getElementById('auth-field-label');

    // Handle login method change
    loginMethod.addEventListener('change', () => {
        switch(loginMethod.value) {
            case 'password':
                authFieldLabel.innerHTML = 'Password';
                authFieldInput.placeholder = ' ';
                authFieldInput.type = 'password';
                authFieldContainer.style.display = 'block';
                break;
                
            case 'otp':
                authFieldLabel.innerHTML = 'One Time Passcode';
                authFieldInput.placeholder = ' ';
                authFieldInput.type = 'text';
                authFieldContainer.style.display = 'block';
                break;
                
            default:
                authFieldContainer.style.display = 'none';
        }
    });

    // Trigger change event if method is pre-selected (e.g., from old input after validation)
    if (loginMethod.value) {
        loginMethod.dispatchEvent(new Event('change'));
    }

    // Handle form submission
    loginForm.addEventListener('submit', async (event) => {
        event.preventDefault();
        
        if (!loginMethod.value) {
            showNotification('error', 'Please choose a login method');
            return;
        }

        if (!authFieldInput.value) {
            showNotification('error', 'Please enter your authentication credentials');
            return;
        }

        const submitButton = loginForm.querySelector('[type="submit"]');
        const originalText = submitButton.innerHTML;
        
        try {
            // Show loading state
            submitButton.disabled = true;
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
            
            const response = await fetch(loginForm.action, {
                method: 'POST',
                body: new FormData(loginForm),
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            });

            const data = await response.json();

            if (!response.ok) {
                throw new Error(data.message || 'Authentication failed');
            }

            // Handle successful login
            if (data.success) {
                showNotification('success', data.message || 'Login successful');
                
                // If OTP was sent
                if (data.requires_otp) {
                    // Clear the auth field and update for OTP input
                    authFieldInput.value = '';
                    authFieldInput.type = 'text';
                    authFieldLabel.innerHTML = 'Enter OTP';
                    showNotification('info', 'Please enter the OTP sent to your device');
                } else {
                    // Redirect to dashboard or specified URL
                    window.location.href = data.redirect || '/dashboard';
                }
            }
        } catch (error) {
            showNotification('error', error.message || 'An error occurred during login');
        } finally {
            // Restore button state
            submitButton.disabled = false;
            submitButton.innerHTML = originalText;
        }
    });
});

// Show notification function
function showNotification(type, message) {
    const toast = document.createElement('div');
    toast.className = `toast align-items-center text-white bg-${type === 'success' ? 'success' : type === 'info' ? 'info' : 'danger'} border-0`;
    toast.setAttribute('role', 'alert');
    toast.setAttribute('aria-live', 'assertive');
    toast.setAttribute('aria-atomic', 'true');
    
    toast.innerHTML = `
        <div class="d-flex">
            <div class="toast-body">
                ${message}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    `;
    
    const container = document.getElementById('toast-container');
    container.appendChild(toast);
    
    const bsToast = new bootstrap.Toast(toast, {
        delay: 5000
    });
    bsToast.show();
    
    // Remove toast after it's hidden
    toast.addEventListener('hidden.bs.toast', () => {
        toast.remove();
    });
} 