// ---------------------- CLASS ACTIVE MENU -------------------------------

let button_home = document.querySelector(".home");
let button_client = document.querySelector(".client");
let button_worker = document.querySelector(".worker");
let button_intervention = document.querySelector(".intervention");

console.log(button_home.className);

button_home.addEventListener("click", function() {
    if(button_home.className === "nav-link text-white p-3 a-menu home"){
    button_home.className = "nav-link active p-3 a-menu home";
    button_home.style.backgroundColor = '#ffffff'
    }
    console.log(button_home.className);
  });









