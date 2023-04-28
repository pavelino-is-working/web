function displayMessage(message, type) {
  const messageDiv = document.createElement("div");
  messageDiv.textContent = message;
  messageDiv.classList.add(type);
  document.body.appendChild(messageDiv);
}

function hideMessage() {
  const messageDiv = document.querySelector(".success, .error");
  if (messageDiv) {
    messageDiv.remove();
  }
}
function validateForm() {
    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;
    const emailRegex = /^\S+@\S+\.\S+$/;
  
    // Check if fields are empty
    if (username.trim() === "" || password.trim() === "") {
      displayMessage("Please fill in all fields", "error");
      return false;
    }
  
    // Check if username is valid email
    if (!emailRegex.test(username) && !/^[a-zA-Z0-9]+$/.test(username)) {
      displayMessage("Please enter a valid email address or username", "error");
      return false;
    }
  
    // Send form data to PHP script using fetch API
    fetch("../login.php", {
      method: "POST",
      body: new FormData(document.querySelector("form")),
    })
      .then((response) => response.json())
      .then((data) => {
        console.log(data); // add this line
        if (data.status === "success") {
          displayMessage(data.message, "success");
          setTimeout(() => hideMessage(), 5000);
          // Redirect to main page after successful login
          window.location.href = "main.php";
        } else {
          displayMessage(data.message, "error");
        }
      })
      .catch((error) => {
        console.log(error);
        window.location.href = "main.php";
        displayMessage(
          
          "An error occurred while processing your request.",
          "error"
        );
      });
  
    return false;
  }
  