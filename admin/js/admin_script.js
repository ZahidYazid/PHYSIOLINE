
// the managing of the users profile in the navigation bar.
let navbar = document.querySelector('.header .flex .navbar');
let profile = document.querySelector('.header .flex .profile');

document.querySelector('#menu-btn').onclick = () =>{
   navbar.classList.toggle('active');
   profile.classList.remove('active');
}

document.querySelector('#user-btn').onclick = () =>{
   profile.classList.toggle('active');
   navbar.classList.remove('active');
}

window.onscroll = () =>{
   navbar.classList.remove('active');
   profile.classList.remove('active');
}


// Displaying of the images in the main image in the quick view.
let mainImage = document.querySelector('.update-product .image-container .main-image img');
let subImages = document.querySelectorAll('.update-product .image-container .sub-image img');

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