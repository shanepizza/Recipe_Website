if (document.readyState === "loading") {
	document.addEventListener("DOMContentLoaded", atStart);
} else {
	atStart();
}

function atStart() {
    // initialization code here
}



async function validateEmail() {
    if ( await doesEmailExistAlready()) {
        alert("This email already exists.");
    }
}




function storeFormData() {
    // code to store form data here
}

async function doesEmailExistAlready() {
    
    var emails = await getEmailsFromDatabase();
    for (var email of emails) {
        if (email.trim() === document.getElementById("email")?.value.trim()) {
            return true;
        }
    }
    return false; // for now, assume email does not exist
}