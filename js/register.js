function validateForm() {
  const username = document.getElementById("username").value;
  const email = document.getElementById("email").value;
  const password = document.getElementById("password").value;
  const passwordAgain = document.getElementById("password_again").value;

  // Check if fields are empty
  if (username == "" || email == "" || password == "" || passwordAgain == "") {
    displayMessage("Please fill in all fields", "error");
    return false;
  }

  // Validate username
  if (!isValidUsername(username)) {
    displayMessage("Username must contain only letters, numbers, and underscores", "error");
    return false;
  }

  // Validate email
  if (!isValidEmail(email)) {
    displayMessage("Please enter a valid email address", "error");
    return false;
  }

  // Validate password
  if (!isValidPassword(password)) {
    displayMessage("Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character", "error");
    return false;
  }

  // Check if passwords match
  if (password !== passwordAgain) {
    displayMessage("Passwords do not match", "error");
    return false;
  }

  // Send form data to PHP script using fetch API
  fetch("../register.php", {
    method: "POST",
    body: new FormData(document.querySelector("form")),
  })
  .then((response) => response.json())
  .then((data) => {
    if (data.status === "success") {
      displayMessage(data.message, "success");
      setTimeout(() => hideMessage(), 5000);
      // Redirect to main page after successful registration
      window.location.href = "main.php";
    } else {
      displayMessage(data.message, "error");
    }
  })
  .catch((error) => {
    displayMessage("An error occurred while processing your request.", "error");
  });

  return false;
}

function isValidUsername(username) {
  const regex = /^[a-zA-Z0-9_]+$/;
  return regex.test(username);
}

function isValidEmail(email) {
  const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return regex.test(email);
}

function isValidPassword(password) {
  const regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z!#$%&? "])[a-zA-Z0-9!#$%&? ]{8,}$/;
  return regex.test(password);
}

function displayMessage(message, type) {
  const messageContainer = document.getElementById("message");
  let messageElement = messageContainer.querySelector(".message");

  if (!messageElement) {
    messageElement = document.createElement("div");
    messageElement.classList.add("message");
    messageContainer.appendChild(messageElement);
  }

  messageElement.innerText = message;
  messageElement.classList.remove("success", "error");
  messageElement.classList.add(type);
}




function hideMessage() {
  const messageContainer = document.getElementById("message");
  messageContainer.innerHTML = "";
}