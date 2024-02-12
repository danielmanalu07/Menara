// const inputs = document.querySelectorAll(".input");


// function addcl(){
// 	let parent = this.parentNode.parentNode;
// 	parent.classList.add("focus");
// }

// function remcl(){
// 	let parent = this.parentNode.parentNode;
// 	if(this.value == ""){
// 		parent.classList.remove("focus");
// 	}
// }


// inputs.forEach(input => {
// 	input.addEventListener("focus", addcl);
// 	input.addEventListener("blur", remcl);
// });

const inputs = document.querySelectorAll(".input");

function addcl() {
    let parent = this.parentNode.parentNode;
    parent.classList.add("focus");
}

function remcl() {
    let parent = this.parentNode.parentNode;
    if (this.value == "") {
        parent.classList.remove("focus");
    }
}

inputs.forEach(input => {
    input.addEventListener("focus", addcl);
    input.addEventListener("blur", remcl);
});

// // Menambahkan animasi pada gambar logo
// document.addEventListener("DOMContentLoaded", function () {
//     const imgLogo = document.querySelector(".img-logo");
//     imgLogo.classList.add("fadeIn");
// });

document.addEventListener("DOMContentLoaded", function () {
    // Menambahkan animasi pada form login
    const loginContent = document.querySelector(".login-content");
    loginContent.classList.add("fadeInUp");

    // Menambahkan animasi pada tombol login
    const loginBtn = document.querySelector(".btn");
    loginBtn.classList.add("fadeInUp");
});

