document.querySelector(".menu-burger").addEventListener("click", function() {
    const nav = document.querySelector(".menu-navigation");
    const burger = document.querySelectorAll(".ligne-burger");
  
    nav.classList.toggle("menu-navigation-active");
    
    burger[0].classList.toggle("ligne-burger-rotate1");
    burger[1].classList.toggle("ligne-burger-hidden");
    burger[2].classList.toggle("ligne-burger-rotate2");
  
    if (nav.style.display === "none") {
      nav.style.display = "block";
    } else {
      nav.style.display = "none";
    }
  });
