//Clear all cookie values and send user to login page
//Author: Cassandra Bailey
function logout(){
    docCookies.removeItem("username");
    docCookies.removeItem("userid");
    docCookies.removeItem("permission");
    docCookies.removeItem("firstname");
    docCookies.removeItem("lastname");
    window.location.href = "login.html";
}

//Check if user is logged in. 
//Author: Cassandra Bailey
function loggedin(){
    //if no user is logged in and they are trying to access a page other than the login page,
    //send them to the login page
    if(docCookies.getItem("userid") == null &&
       window.location.href.indexOf("login.html") == -1){
	window.location.href = "login.html";
    }
    //if user is logged in and they are trying to access the login page, send them to 
    //their designated home page
    else if(docCookies.getItem("userid") != null &&
	    window.location.href.indexOf("login.html") != -1){
	redirectOnPermissions();	
    }
}

//Send logged in user to their corresponding homepage
//Author: Cassandra Bailey
function redirectOnPermissions(){
    var perm = docCookies.getItem("permission");
    if(perm == "Sales Manager" || perm == "Admin"){
	window.location.href = "saleshomepage.html";
    }
    else if(perm == "Flock Manager"){
	window.location.href = "FlockManager.html";
    }
    else if(perm == "Truck Driver"){
	window.location.href = "truckdriver.html";
    }
}

function checkPermissions(permissionNeeded){
    var perm = docCookies.getItem("permission");
    if(perm != permissionNeeded && perm != "Admin"){
	redirectOnPermissions();
    }
    
    if(perm != "Admin"){
        document.getElementById("adminsub").style.display = 'none';
    } else {
        document.getElementById("adminsub").style.display = 'block';
    }
}

//Change the users password based on their username. 
//Author: Cassandra Bailey
function changePassword(){
    var username = $('#username').val();
    var currPass = $('#currentPassword').val();
    var newPass = $('#newPassword').val();
    var reenterPass = $('#reenter').val();

    //If the two versions of the new password don't match, don't call the database
    if(newPass != reenterPass){
	alert("The new password fields don't match. Please try again.");
    }
    else{
	$.ajax({
	    type: 'post',
	    url: '../user/change_password.php',
	    data: {
		username : username,
		currPass : currPass,
		newPass : newPass
	    },
	    success: function(result){
		//on success, logout user and send them to the login page
		if(result == "success"){
		    logout();
		}
		else{
		    alert("Incorrect information. Please try again.");
		}
	    }
	});
    }
}
