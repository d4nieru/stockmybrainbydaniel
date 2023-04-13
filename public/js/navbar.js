
const navbarToggle = document.querySelector('.navbar-toggle');
const navbarLinks = document.querySelector('.navbar-links');

navbarToggle.addEventListener('click', () => {
  navbarToggle.classList.toggle('active');
  navbarLinks.classList.toggle('active');
});