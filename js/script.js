
// the managing of the users profile in the navigation bar.
let profile = document.querySelector('.header .flex .profile');
let navbar = document.querySelector('.header .flex .navbar');

document.querySelector('#user-btn').onclick = () =>{
   profile.classList.toggle('active')
   navbar.classList.remove('active');
}

document.querySelector('#menu-btn').onclick = () =>{
   navbar.classList.toggle('active');
   profile.classList.remove('active');
}

window.onscroll = () =>{
   profile.classList.remove('active');
   navbar.classList.remove('active');
}


// Displaying of the images in the main image in the quick view.
let mainImage = document.querySelector('.quick-view .box .row .image-container .main-image img');
let subImages = document.querySelectorAll('.quick-view .box .row .image-container .sub-image img');

subImages.forEach(images =>{
   images.onclick = () =>{
      src = images.getAttribute('src');
      mainImage.src = src;
   }
});

// Changing the theme of the design of the web application to the dark mode.
// JavaScript for dark mode persistence
window.addEventListener('DOMContentLoaded', () => {
    const themeToggler = document.querySelector('#theme-toggler');
    const body = document.body;

    // Check if the user has a dark mode preference
    const darkModePreference = localStorage.getItem('darkMode');

    // If the dark mode preference is set, apply dark mode
    if (darkModePreference === 'enabled') {
        body.classList.add('dark-mode');
        themeToggler.classList.add('fa-sun'); // Assuming sun icon represents light mode
    }

    // Toggle dark mode when the themeToggler is clicked
    themeToggler.addEventListener('click', () => {
        body.classList.toggle('dark-mode');

        // Update the user's preference in local storage
        if (body.classList.contains('dark-mode')) {
            localStorage.setItem('darkMode', 'enabled');
            themeToggler.classList.add('fa-sun');
        } else {
            localStorage.setItem('darkMode', 'disabled');
            themeToggler.classList.remove('fa-sun');
        }
    });
});




/*
let themeToggler = document.querySelector('#theme-toggler');

themeToggler.onclick = () =>{
   themeToggler.classList.toggle("fa-sun");
   if(themeToggler.classList.contains('fa-sun')){
      document.querySelector('body').classList.add('active');
      
   }else{
      document.querySelector('body').classList.remove('active');
   }
}

*/




/*

function eye() {
   // body...
   var a = document.getElementById("eyeInput");
   var b = document.getElementById("hide1");
   var c = document.getElementById("hide2");
   if(a.type === 'password') {
      a.type = "text";
      b.style.display = "block";
      c.style.display = "none";
   }else{
      a.type = "password";
      b.style.display = "none";
      c.style.display = "block";
   }
}
*/