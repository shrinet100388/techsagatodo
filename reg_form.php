<?php
include 'profile.php';
$buttonVal = "Register";
if(!empty($_SESSION['id'])){
    $buttonVal = "Update";
}
?>
<html>
<head>
	<style>
    body {
    font-size: 16px;
    background: lightgreen;
    font-family: "Segoe UI", "Helvetica Neue", Arial, sans-serif;
}
h2 {
    text-align: center;
    text-decoration: underline;
}
form {
    width: 500px;
    background: #fff;
    padding: 15px 40px 40px;
    border: 1px solid #ccc;
    margin: 50px auto 0;
    border-radius: 5px;
}
label {
    display: block;
    margin-bottom: 5px
}

input, select {
    border: 1px solid #ccc;
    padding: 10px;
    display: block;
    width: 100%;
    box-sizing: border-box;
    border-radius: 2px;
}
.row {
    padding-bottom: 10px;
}
.form-inline {
    border: 1px solid #ccc;
    padding: 8px 10px 4px;
    border-radius: 2px;
}
.form-inline label, .form-inline input {
    display: inline-block;
    width: auto;
    padding-right: 15px;
}
.error {
    color: red;
    font-size: 90%;
}
input[type="submit"] {
    font-size: 110%;
    font-weight: 100;
    background: #006dcc;
    border-color: #016BC1;
    box-shadow: 0 3px 0 #0165b6;
    color: #fff;
    margin-top: 10px;
    cursor: pointer;
}
input[type="submit"]:hover {
    background: #0165b6;
}

</style>

<script>
function printError(elemId, hintMsg) {
    document.getElementById(elemId).innerHTML = hintMsg;
}

// Defining a function to validate form 
function validateForm() {
    // Retrieving the values of form elements 
    var name = document.regForm.name.value;
    var email = document.regForm.email.value;
    var password = document.regForm.password.value;
    var confirmpassword = document.regForm.confirmpassword.value;
    var phone = document.regForm.phone.value;
    
    
    
    // Defining error variables with a default value
    var nameErr  = emailErr = passwordErr = confirmpasswordErr = phoneErr = true;
    
    // Validate name
    if(name == "") {
        printError("nameErr", "Please enter your name");
    } else {
        var regex = /^[a-zA-Z\s]+$/;                
        if(regex.test(name) === false) {
            printError("nameErr", "Please enter a valid name");
        } else {
            printError("nameErr", "");
            nameErr = false;
        }
    }
    
    //Validate email address
    if(email == "") {
        printError("emailErr", "Please enter your email address");
    } else {
        // Regular expression for basic email validation
        var regex = /^\S+@\S+\.\S+$/;
        if(regex.test(email) === false) {
            printError("emailErr", "Please enter a valid email address");
        } else{
            printError("emailErr", "");
            emailErr = false;
        }
    }

    // Validate password
    if(password == "") {
        printError("passwordErr", "Please enter your password");
    } else {
        // Regular expression for basic email validation
        var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
        if(regex.test(password) === false) {
            printError("passwordErr", "Please enter a valid password");
        } else{
            printError("passwordErr", "");
            passwordErr = false;
        }
    }

    //confirm password
    if(password != confirmpassword){
        printError("confirmpasswordErr", "Do not match password");
    }else{
        printError("confirmpasswordErr", "");
            confirmpasswordErr = false;
    }
    
    // Validate phone number
    if(phone == "") {
        printError("phoneErr", "Please enter your phone number");
    } else {
        var regex = /^[1-9]\d{9}$/;
        if(regex.test(phone) === false) {
            printError("phoneErr", "Please enter a valid 10 digit phone number");
        } else{
            printError("phoneErr", "");
            phoneErr = false;
        }
    }
    
    
    
    // Prevent the form from being submitted if there are any errors
    if((nameErr || emailErr || passwordErr || phoneErr || confirmpasswordErr) == true) {
       return false;
    } else {
    	return true;
        // Creating a string from input data for preview
        var dataPreview = "You've entered the following details: \n" +
                          "Full Name: " + name + "\n" +
                          "Email Address: " + email + "\n" +
                          "Password: " + password + "\n" +
                          "phone Number: " + phone + "\n" +
                          
        
        // Display input data in a dialog box before submitting the form
        alert(dataPreview);
    }
};

function changeform(val){
    if(val == "Individual"){
        document.getElementById('otpdiv').style.display='none';
        document.getElementById('design').style.display='none';
        document.getElementById('cname').style.display='none';
    }
    if(val == "Employee" || val == "Select"){
        document.getElementById('otpdiv').style.display='block';
        document.getElementById('design').style.display='block';
        document.getElementById('cname').style.display='block';
    }
    if(val == "Company"){
        document.getElementById('otpdiv').style.display='none';
        document.getElementById('design').style.display='block';
        document.getElementById('cname').style.display='block';
    }
}    
</script>

</head>
<body>
	<form name="regForm" onsubmit="return validateForm()" action="insert.php" method="post">

		<div class="row">
        <label>Register As</label>
        <select name="reg_type" onclick="changeform(this.value)">
            <option>Select</option>
            <option>Employee</option>
            <option>Individual</option>
            <option>Company</option>
        </select> 
        <div class="error" id="regErr"></div>
        </div>

		<div class="row">
			<label> Full Name </label>
			<input type="text" name="name" id="name" value= "<?php echo $name;  ?> "placeholder="Enter Your Name">
			<div class="error" id="nameErr"></div>
		</div>

		<div class="row">
			<label> E-mail </label>
			<input type="text" name="email" id="email" placeholder="Enter Your Email">
			<div class="error" id="emailErr"></div>
		</div>

		<div class="row">
			<label> Password </label>
			<input type="password" name="password" id="password" placeholder="Enter Your Password">
			<div class="error" id="passwordErr"></div>
		</div>

		<div class="row">
			<label> Confirm Password </label>
			<input type="password" name="confirmpassword" id="confirmpassword" placeholder="Confirm Your Password">
			<div class="error" id="confirmpasswordErr"></div>
		</div>

		<div class="row">
			<label> Phone Number </label>
			<input type="text" name="phone" id="phone" placeholder="Enter Your Phone Number">
			<div class="error" id="phoneErr"></div>
		</div>

		<div class="row" id = "otpdiv">
			<label> OTP </label>
			<input type="text" name="otp" id="otp" placeholder="Enter OTP send on Your Number">
			<div class="error" id="otpErr"></div>
		</div>

		<div class="row" id = "cname">
			<label> Company Name </label>
			<input type="text" name="company" id="company" placeholder="Enter Your Company Name">
			<div class="error" id="companyErr"></div>
		</div>

		<div class="row" id = "design">
			<label> Designation </label>
			<input type="text" name="designation" id="designation" placeholder="Enter Your Designation">
			<div class="error" id="designationErr"></div>
		</div>

		<div class="row">
        <input type="submit" value="<?php echo $buttonVal; ?>">
        </div>

	</form>
</body>
</html>
