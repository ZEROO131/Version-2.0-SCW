document.addEventListener('DOMContentLoaded', () => {
    const sideNav = document.getElementById('sideNav');
    const toggleButton = document.getElementById('toggleButton');

    toggleButton.addEventListener('click', () => {
        sideNav.classList.toggle('expanded');
    });
});


document.getElementById("mobile-menu").addEventListener("click", function() {
    document.querySelector(".nav-links").classList.toggle("active");
});