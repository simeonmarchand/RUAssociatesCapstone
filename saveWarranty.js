function saveWarranty(event) {
	event.preventDefault();

	const itemName = document.getElementById('itemName').value;
	const purchaseDate = document.getElementById('purchaseDate').value;
	const warrantyYears = document.getElementById('warrantyYears').value;
	const warrantyDescription = document.getElementById('warrantyDescription').value;
	const maintenanceDate = document.getElementById('maintenanceDate').value;

	// validation

	const currentDate = new Date().toISOString().split('T')[0]; //gets current date
	let errorMessage = '';

	if (itemName.trim() == '') {
		errorMessage += 'Item name is required. ';
	}

	if (warrantyYears < 0) {
		errorMessage += 'Warranty years must be a positive number. ';
	}

	if (warrantyDescription.trim() == '') {
		errorMessage += 'Warranty description is required. ';
	}

	if (errorMessage !== '') {
		document.getElementById('output').innerHTML = '<p class="error">' + errorMessage + '</p>';
		return;
	}


	// display saved data
	const output = '<p><strong>Item Name:</strong> ' + itemName + '</p>' + '<p><strong>Purchase Date:</strong> ' + purchaseDate + '</p>' + '<p><strong>Warranty Years:</strong> ' + warrantyYears + '</p>';

	if (maintenanceDate) {
		output += '<p><strong>Maintenance Date:</strong> ' + maintenanceDate + '</p>';
	}

	document.getElementById('output').innerHTML = output;
}


function validateForm() {
	var itemName = document.getElementById("itemName").value;
	var itemDescription = document.getElementById("itemDescription").value;
	var itemCategory = document.getElementById("itemCategory").value;
	var itemManufacturer = document.getElementById("itemManufacturer").value;
	var maintenanceDate = document.getElementById("maintenanceDate").value;
	var maintenanceDescription = document.getElementById("maintenanceDescription").value;
	var maintenanceCost = document.getElementById("maintenanceCost").value;
	var warrantyStartDate = document.getElementById("warrantyStartDate").value;
	var warrantyEndDate = document.getElementById("warrantyEndDate").value;
	var warrantyProvider = document.getElementById("warrantyProvider").value;
	var warrantyTerms = document.getElementById("warrantyTerms").value;
	var extendedWarrantyStartDate = document.getElementById("extendedWarrantyStartDate").value;
	var extendedWarrantyEndDate = document.getElementById("extendedWarrantyEndDate").value;
	var warrantyCost = document.getElementById("warrantyCost").value;

	var isValid = true;
	var errorMessage = "";

	if (itemName === "") {
		errorMessage += "Item Name is required.<br>";
		isValid = false;
	}
	if (itemDescription === "") {
		errorMessage += "Item Description is required.<br>";
		isValid = false;
	}
	if (itemCategory === "") {
		errorMessage += "Item Category is required.<br>";
		isValid = false;
	}
	if (itemManufacturer === "") {
		errorMessage += "Item Manufacturer is required.<br>";
		isValid = false;
	}
	if (maintenanceDate === "") {
		errorMessage += "Maintenance Date is required.<br>";
		isValid = false;
	}
	if (maintenanceDescription === "") {
		errorMessage += "Maintenance Description is required.<br>";
		isValid = false;
	}
	if (maintenanceCost === "") {
		errorMessage += "Maintenance Cost is required.<br>";
		isValid = false;
	}
	if (warrantyStartDate === "") {
		errorMessage += "Warranty Start Date is required.<br>";
		isValid = false;
	}
	if (warrantyEndDate === "") {
		errorMessage += "Warranty End Date is required.<br>";
		isValid = false;
	}
	if (warrantyProvider === "") {
		errorMessage += "Warranty Provider is required.<br>";
		isValid = false;
	}
	if (warrantyTerms === "") {
		errorMessage += "Warranty Terms is required.<br>";
		isValid = false;
	}
	if (extendedWarrantyStartDate === "") {
		errorMessage += "Extended Warranty Start Date is required.<br>";
		isValid = false;
	}
	if (extendedWarrantyEndDate === "") {
		errorMessage += "Extended Warranty End Date is required.<br>";
		isValid = false;
	}
	if (warrantyCost === "") {
		errorMessage += "Warranty Cost is required.<br>";
		isValid = false;
	}

	if (!isValid) {
		document.getElementById("errorMessages").innerHTML = errorMessage;
	}

	return isValid;
}
// attached event listener to form
document.getElementById