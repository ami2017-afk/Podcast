$(document).ready(function() {
    // Intercept the submit event of the login form
    $("#login-form").submit(function(event) {
        event.preventDefault(); // Preventing the default form submission

        // Validate the name and email fields
        var email = $("#email").val();
        var password = $("#password").val();
        if (email.trim() == "" || password.trim() == "") {
            alert("Please enter your email and password.");
            return;
        }

        // Send an Ajax request to php.
        $.ajax({
            type: "POST",
            url: "admin.php",
            data: $("#login-form").serialize(),
            success: function(response) {
                    // Store the login session information to local storage
                    var sessionData = {
                    
                        email: email,
                        password: password
                    };

                    // Redirect to the profile page.
                   window.location.href = "desc.html";

            }
        });
    });
});