function validateForm() {
	var searchQuery = document.getElementById("searchQuery").value;

	var isValid = true;
	var errorMessage = "";

	if (searchQuery === "") {
		errorMessage += "Search query is required.<br>";
		isValid = false;
	}

	if (!isValid) {
		document.getElementById("errorMessages").innerHTML = errorMessage;
	}

	return isValid;
}