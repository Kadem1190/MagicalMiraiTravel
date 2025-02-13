function applyDarkMode(darkModeIcon, darkModeText) {
    darkModeIcon.classList.remove("fa-moon");  
    darkModeIcon.classList.add("fa-sun");  
    darkModeText.textContent = "Light Mode"; 
}

function applyLightMode(darkModeIcon, darkModeText) {
    darkModeIcon.classList.remove("fa-sun");  
    darkModeIcon.classList.add("fa-moon");    
    darkModeText.textContent = "Dark Mode"; 
}

document.addEventListener("DOMContentLoaded", function() {
    const darkModeToggle = document.querySelector(".toggle-darkmode");
    const darkModeIcon = darkModeToggle.querySelector("i"); 
    const darkModeText = darkModeToggle.querySelector("span"); 
    const darkModeStatus = localStorage.getItem("dark-mode") || "off";

    if (darkModeStatus === "on") {
        document.body.classList.add("dark-mode");
        applyDarkMode(darkModeIcon, darkModeText);
    } else {
        document.body.classList.remove("dark-mode");
        applyLightMode(darkModeIcon, darkModeText);
    }

    darkModeToggle.addEventListener("click", function() {
        document.body.classList.toggle("dark-mode");

        if (document.body.classList.contains("dark-mode")) {
            localStorage.setItem("dark-mode", "on");
            applyDarkMode(darkModeIcon, darkModeText);
        } else {
            localStorage.setItem("dark-mode", "off");
            applyLightMode(darkModeIcon, darkModeText);
        }
    });

    const menuToggle = document.querySelector(".menu-toggle");
    const navLinks = document.querySelector(".nav-links");

    menuToggle.addEventListener("click", function() {
        navLinks.classList.toggle("active"); 
    });
});


window.addEventListener("load", function() {
    const preloader = document.getElementById("preloader");
    const content = document.getElementById("content");
    // if(this.document.readyState == "loading"
    //     {} --------------------------------- Replace using readystate instead of forcing it to load even at good connection
    // )
    setTimeout(() => {
        preloader.style.opacity = "0"; 
        setTimeout(() => {
            preloader.style.display = "none"; 
        }, 800); 
    }, 3000); 
});
