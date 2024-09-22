// This script checks if the user has entered a valid email address and if the passwords match.
// It is used on the registration page.


document.getElementById('userForm').addEventListener('submit', function (e) {
    var email = document.forms["userForm"]["username"].value;
    var confirmEmail = document.forms["userForm"]["confirm_email"].value;
    var password = document.forms["userForm"]["password"].value;
    var confirmPassword = document.forms["userForm"]["confirm_password"].value;

    // Check if email is valid with @ symbol
    if (email.indexOf('@') === -1) {
        alert("Please enter a valid email address.");
        e.preventDefault();
    }

    // Check if emails match
    if (email !== confirmEmail) {
        alert("Email addresses do not match.");
        e.preventDefault();
    }

    // Check if password is long enough
    if (password.length < 8) {
        alert("Password must be at least 8 characters long.");
        e.preventDefault();
    }

    // Check if passwords match
    if (password !== confirmPassword) {
        alert("Passwords do not match.");
        e.preventDefault();
    }
});
