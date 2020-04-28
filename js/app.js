"use strict";

let backButton = document.getElementsByClassName("back");
if (backButton){
	for (var i=0; i < backButton.length; i++){
		backButton[i].setAttribute("onclick", "adminRedirect()");	
	}
}

function adminRedirect(){
	location = 'adminPage.php';
};

let contactForm = document.getElementById("contactUs");

if (contactForm) {

	contactForm.setAttribute("novalidate", "");

	contactForm.addEventListener("submit", (v)=>{

		resetErrors(contactForm);

		// Input Fields
		const fName = contactForm.elements["firstName"];
		const lName = contactForm.elements["lastName"];
		const phone = contactForm.elements["contactNum"];
		const email = contactForm.elements["email"];
		const question = contactForm.elements["question"];

		// Regex Patterns
		const regexPhone = /^((\+61\s?)?(\((0|0?2|0?3|0?4|0?7|0?8)\))?)?\s?\d{1,4}\s?\d{1,4}\s?\d{0,4}$/;
		const regexEmail = /^(\w*|[\.]*)+([@]\w+)+([\.]*|\w*)+$/;

		var message = "";

		if(fName.value.trim().length < 2){
			message = "Name Must Be At Least 2 Characters Long";
			showError(v, fName, message);
		}

		if(lName.value.trim().length < 2){
			message = "Name Must Be At Least Characters Long";
			showError(v, lName, message);
		}

		if(phone.value.trim() !== ""){
			if(!regexPhone.test(phone.value.trim())){
				message = "Please Enter A Valid Australian Phone Number";
				showError(v, phone, message);
			}
		}

		if(!regexEmail.test(email.value.trim())){
			message = "Please Enter A Valid Email Address";
			showError(v, email, message);
		}

		if(question.value.trim().length < 10){
			message = "Question Must Be At Least 10 Characters";
			showError(v, question, message);
		}

	});

}

let changePassword = document.getElementById("changePassword");

if(changePassword){

	// Disables HTML Default Validation
	changePassword.setAttribute("novalidate", "");

	changePassword.addEventListener("submit", (v)=>{
		resetErrors(changePassword);

		// Input Fields
		const newPassword = changePassword.elements["password"];
		const confirmPassword = changePassword.elements["confirmPassword"];

		// Regex Patterns
		const specialCharacter = /.*[!$#?%^*]|[0-9]+.*/;

		var message = "";

		// Validates confirmPassword
		if(newPassword.value.trim() !== confirmPassword.value.trim()){
			message = "Passwords Must Match";
			showError(v, confirmPassword, message);
		} else if (confirmPassword.value.trim() == ""){
			message = "Cannot Be Blank";
			showError(v, confirmPassword, message);
		}

		// Validates password
		if(newPassword.value.trim().length < 6){ 
			// 1. If Less Then 6 Characters
			message = "Password Must Be At Least 6 Characters";
			showError(v, newPassword, message);
		} else if (!specialCharacter.test(password.value.trim())){
			// 2. If It Doesn't Include A Number or Special Character
			message = "Password Must Include A Number Or One Of The Following Characters: !$#?%^*";
			showError(v, newPassword, message);
		} else if (newPassword.value.trim() !== confirmPassword.value.trim()){
			// 3. If It Doesn't Match With confirmPassword
			message = "Passwords Must Match";
			showError(v, newPassword, message);
		}
	});
}


// Clears All The Errors On A Form So 
// Any Fields That Have Been Corrected 
// Dont Still Show An Error
function resetErrors(form){
	const errors = form.querySelectorAll(".error");
	for (let i = 0; i < errors.length; i++){
		errors[i].classList.remove("error");
	}
}

// Goes Through All The Shit To 
// Display Error Messages
function showError(event, target, errorMessage){
	event.preventDefault();

	target.parentNode.classList.add("error");

	if (errorMessage) {
		let errorSpan = target.parentNode.querySelector(".error-message");

		// Creating span.error-message if it doens't already exist
		if (!errorSpan) {
			errorSpan = document.createElement("span");
			errorSpan.classList.add("error-message");
			target.parentNode.appendChild(errorSpan);
		}
		
		errorSpan.innerHTML = errorMessage;
	}
}