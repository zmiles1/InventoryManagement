   //Authored By Connor Astemborski
   //JS file for Maintenance and Saleshomepage
   //Includes all Ajax calls for the afformentioned Pages
   //Last Edited: 12/14/19

   //Ajax call for adding Message to Database
   function postMessage() {
   	var user_id = docCookies.getItem("userid");
   	var messageContent = $('#messageContent').val();
   	var salesmanager_flag;
   	var truckdriver_flag;
   	var flockmanager_flag;
   	if ($('#salesmanager_flag').is(":checked")) {
   		salesmanager_flag = 1;
   	} else {
   		salesmanager_flag = 0;
   	}

   	if ($('#truckdriver_flag').is(":checked")) {
   		truckdriver_flag = 1;
   	} else {
   		truckdriver_flag = 0;
   	}
   	if ($('#flockmanager_flag').is(":checked")) {
   		flockmanager_flag = 1;
   	} else {
   		flockmanager_flag = 0;
   	}

   	$.ajax({
   		type: "POST",
   		url: "../message/create_message.php",

   		data: {
   			user_id: user_id,
   			content: messageContent,
   			flockmanager_flag: flockmanager_flag,
   			salesmanager_flag: salesmanager_flag,
   			truckdriver_flag: truckdriver_flag
   		},

   		success: function(result) {
   			alert("message created");
   		},
   		error: function(xhr, resp, text) {
   			console.log(xhr, resp, text);
   		}
   	});
   }

   //Ajax for adding Truck to the Database
   function addTruck() {

   	var truckNumber = $('#truckNumber').val();
   	var truckVIN = $('#truckVIN').val();
   	var truckPlateNumber = $('#truckLicensePlate').val();
   	var truckMaxCoops = $('#truckMaxCoops').val();
   	var truck_transmission = $('#inputTransmission').val();

   	//alert("New Truck:\n" + "num: " + truckNumber + "\nvin: " + truckVIN + "\nplate: " + truckPlateNumber + "\nmax coops: " + truckMaxCoops + "\ntransmission: " + truck_transmission);
   	//ajax code - Connor A
   	$.ajax({
   		type: "POST",
   		url: "../truck/addTruck.php", //php file goes here
   		data: {
   			truckNumber: truckNumber,
   			truckVIN: truckVIN,
   			truckPlateNumber: truckPlateNumber,
   			truckMaxCoops: truckMaxCoops,
   			truck_transmission: truck_transmission
   		},
   		success: function(response) {
   			alert(response);
   		}
   	});



   }


   function addDriver() {

   	var driverUser = $('#driverUser').val();
   	var driverBirth = $('#driverBirth').val();
   	var driverLN = $('#driverLN').val();
   	var driverME = $('#driverME').val();
   	var driverState = $('#driverState').val();
   	var driverLE = $('#driverLE').val();
   	var driverPhone = $('#driverPhone').val();
   	var name = $('#driverUser option:selected').text().split(" ");
   	var first_name = name[0].trim();
   	var last_name = name[1].trim();

   	var driverTransmission = $('#driverTransmission').val();
   	var driverLT = $('#driverLT').val();




   	//ajax code - Connor A
   	$.ajax({
   		type: "POST",
   		url: "../driver/addDriver.php", //php file goes here
   		data: {
   			first_name: first_name,
   			last_name: last_name,
   			driverUser: driverUser,
   			driverBirth: driverBirth,
   			driverLN: driverLN,
   			driverME: driverME,
   			driverState: driverState,
   			driverLE: driverLE,
   			driverPhone: driverPhone,
   			driverTransmission: driverTransmission,
   			driverLT: driverLT

   		},
   		success: function(response) {
   			alert(response);
   		}
   	});


   }

   function addCustomer() {
   	var customerName = $('#customerName').val();
   	var customerAddress = $('#customerAddress').val();
   	var customerPhone = $('#customerPhone').val();
   	var customerZip = $('#customerZip').val();
   	var customerCity = $('#customerCity').val();
   	var customerState = $('#customerState').val();

   	//alert("New Customer:\n" + "name: " + customerName + "\naddr: " + customerAddress + "\nphone: " + customerPhone);
   	//ajax code -Connor A.
   	$.ajax({
   		type: "post",
   		url: "../store/addStore.php", //php file goes here
   		data: {
   			customerName: customerName,
   			customerAddress: customerAddress,
   			customerPhone: customerPhone,
   			customerZip: customerZip,
   			customerCity: customerCity,
   			customerState: customerState
   		},
   		success: function(response) {
   			alert(response);
   		}

   	});

   }

   function deactivateCustomer() {
   	var store_id = $('#currCustomers').val();
   	$.ajax({
   		type: "POST",
   		url: "../store/removeStore.php", //php file goes here
   		data: {
   			store_id: store_id,
   		},
   		success: function(response) {
   			alert(response);
   		}
   	});
   }




   function deactivateTruck() {
   	var truck_id = $('#activeTrucks').val();
   	$.ajax({
   		type: "POST",
   		url: "../truck/deactivateTruck.php", //php file goes here
   		data: {
   			truck_id: truck_id
   		},
   		success: function(response) {
   			alert(response);
   		}
   	});
   }


   function activateTruck() {
   	var truck_id = $('#inactiveTrucks').val();
   	$.ajax({
   		type: "POST",
   		url: "../truck/activateTruck.php", //php file goes here
   		data: {
   			truck_id: truck_id
   		},
   		success: function(response) {
   			alert(response);
   		}
   	});



   }