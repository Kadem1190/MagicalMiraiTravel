document.addEventListener("DOMContentLoaded", function() {
    const darkModeToggle = document.querySelector(".toggle-darkmode");
    const darkModeIcon = darkModeToggle.querySelector("i"); 
    const darkModeText = darkModeToggle.querySelector("span"); 

    darkModeToggle.addEventListener("click", function() {
        document.body.classList.toggle("dark-mode");

        if (document.body.classList.contains("dark-mode")) {
            darkModeIcon.classList.remove("fa-moon");  
            darkModeIcon.classList.add("fa-sun");  
            darkModeText.textContent = "Light Mode"; 
        } else {
            darkModeIcon.classList.remove("fa-sun");  
            darkModeIcon.classList.add("fa-moon");    
            darkModeText.textContent = "Dark Mode"; 
        }
    });

    const menuToggle = document.querySelector(".menu-toggle");
    const navLinks = document.querySelector(".nav-links");

    menuToggle.addEventListener("click", function() {
        navLinks.classList.toggle("active"); 
    });
});
