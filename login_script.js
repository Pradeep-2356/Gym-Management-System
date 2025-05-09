
let signup = document.querySelector(".signup");

let login = document.querySelector(".login");

let slider = document.querySelector(".slider");

let formSection = document.querySelector(".form-section");
 

signup.addEventListener("click", () => {

    slider.classList.add("moveslider");

    formSection.classList.add("form-section-move");
});
 

login.addEventListener("click", () => {

    slider.classList.remove("moveslider");

    formSection.classList.remove("form-section-move");
});


document.addEventListener("DOMContentLoaded", function () {
    const loginBtn = document.querySelector(".login-box .clkbtn");
  
    loginBtn.addEventListener("click", function () {
      const email = document.querySelector(".login-box .email").value.trim();
      const password = document.querySelector(".login-box .password").value.trim();
  
      if (!email || !password) {
        alert("Please fill in all fields.");
        return;
      }
  
      const formData = new FormData();
      formData.append("email", email);
      formData.append("password", password);
  
      fetch("http://localhost/gym-management-system/backend/login.php", {
        method: "POST",
        body: formData,
      })
        .then((response) => response.text())
        .then((data) => {
          alert(data); // Show backend response
          if (data.includes("successful")) {
            // redirect or do something
            window.location.href = "index.html"; // or your homepage
          }
        })
        .catch((error) => {
          console.error("Error:", error);
          alert("Something went wrong.");
        });
    });
  });



 // Inside your signup button event listener
 document.addEventListener("DOMContentLoaded", () => {
  const signupBtn = document.querySelector(".signup-box .clkbtn");

  if (signupBtn) {
      signupBtn.addEventListener("click", () => {
          const name = document.querySelector("#signup-name").value;
          const email = document.querySelector("#signup-email").value;
          const password = document.querySelector("#signup-password").value;
          const confirm_password = document.querySelector("#signup-confirm").value;

          const formData = new FormData();
          formData.append("name", name);
          formData.append("email", email);
          formData.append("password", password);
          formData.append("confirm_password", confirm_password);

          fetch("http://localhost/gym-management-system/backend/signup.php", {
              method: "POST",
              body: formData,
          })
          .then((res) => res.text())
          .then((data) => {
              console.log("Response from server:", data);
              alert(data);
          })
          .catch((error) => {
              console.error("Fetch error:", error);
              alert("Something went wrong during signup.");
          });
      });
  } else {
      console.error("Signup button not found in the DOM.");
  }
});



  
 