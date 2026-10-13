if (document.readyState === "loading") {
	document.addEventListener("DOMContentLoaded", atStart);
} else {
	atStart();
}

function atStart() {
	// initialization code here
    window.emailPairs = [];
}

async function validateFormFields() {
    //Until we host on a real server, this is the best we can do for email and password validation
    const file = document.getElementById("credentialFile").files[0];
    
    //Check if file was got from the input element
    if (!file) {
        alert("Choose a credentials file first.");
        return;
    } else {
        // I do not like how this works currently, but it will suffice for now
        // We create a long list of email-password pairs from the uploaded file
        emailPairs = await getEmailPairsFromDatabase(file);
    }

    // Validate email and password against the retrieved email pairs
    if (validateEmail(emailPairs)) {
        if (validatePassword(emailPairs)) {
            alert("You logged in successfully!");   // password is valid
        } else {
            badLoginAttempt(); // password is invalid
        } // end of password validation check
    } else {
        badLoginAttempt(); // email is invalid
    } // end of email validation check
}// end of validateFormFields function


async function getEmailPairsFromDatabase(file) {
    const emailsPairs = [];
    //This code will be replaced when we start creating the actual database connection and query logic.
    try {
        const data = await file.text();
        emailsPairs.push(...data.split("\n"));
    } catch (error) {
        console.error("Error fetching emails from the database:", error);
    }
    return emailsPairs;
} // end of getEmailPairsFromDatabase function


function validatePassword(emailPairs) {
    // Does this password match the given users password in the database?
    const givenEmailAddress = document.getElementById("username")?.value.trim();
    const givenPassword = document.getElementById("password")?.value.trim();
    const matchingPassword = getPasswordForGivenEmail(givenEmailAddress, emailPairs);
    if (matchingPassword && matchingPassword === givenPassword) {  
        return true; // Password matches
    }
    return false; // If no match, deny access
}// end of validatePassword function


function validateEmail(emailPairs) {
    //get the submitted email from the form
    const givenEmailAddress = document.getElementById("username")?.value.trim();
    for (const emailPair of emailPairs) {
        const [storedEmail, storedPassword] = emailPair.split(",");
        if (storedEmail.trim() === givenEmailAddress) {
            return true;
        }
    }
    return false;
}//end of validateEmail function

function getPasswordForGivenEmail(email, emailPairs) {
    for (const pair of emailPairs) {
        const [storedEmail, storedPassword] = pair.split(",");
        if (storedEmail.trim() === email) {
            return storedPassword?.trim() || null;
        }
    }
    return null;
} // end of getPasswordForGivenEmail function

function badLoginAttempt() {
    alert("Invalid email or password.");
} // end of badLoginAttempt function




function fillTestCredentialsCorrect() {
    document.getElementById("username").value = "rowan.clark@example.com";
    document.getElementById("password").value = "Golden$Thistle216";
} // end of fillTestCredentials function

function fillTestCredentialsIncorrect() {
    document.getElementById("username").value = "incorrect@example.com";
    document.getElementById("password").value = "WrongPassword123";
} // end of fillTestCredentialsIncorrect function
