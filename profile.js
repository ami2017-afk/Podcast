const form = document.getElementById("myForm");

// Add an event listener for form submission
	form.addEventListener("submit", function(event) {
    // Prevent the default form submission
    	event.preventDefault();

    // Get the user inputs
    const name = form.elements["name"].value;
    const age = form.elements["age"].value;
    const dob = form.elements["dob"].value;
    const address = form.elements["address"].value;
    const contact = form.elements["contact"].value;

    // Creating a new XMLHttpRequest object...
    const xhr = new XMLHttpRequest();

    // Setting up the request...
    xhr.open("POST", "php/profile.php");
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    // Setting up the request data...
    const data = "name=" + encodeURIComponent(name) + "&age=" + encodeURIComponent(age) + "&dob=" + encodeURIComponent(dob) + "&address=" + encodeURIComponent(address) + "&contact=" + encodeURIComponent(contact);

    // Sending the request...
    xhr.send(data);

    // Handling the response...
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            alert(xhr.responseText);
        }
    };
});
