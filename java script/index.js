
// nav bar hamberger menu form mobile
const bar = document.getElementById('bar');
const nav = document.getElementById('navbar');
const close_btn = document.getElementById('close');
if(bar){
    bar.addEventListener('click',()=>{
        nav.classList.add('active1');
        
    });
}
if(close_btn){
    close_btn.addEventListener('click',()=>{
        nav.classList.remove('active1');
    });
}

// Navbar 
// Get the current page URL
var currentURL = window.location.href;

// Select the anchor element with a matching href attribute
var activeLink = document.querySelector('#navbar a[href="' + currentURL + '"]');

// Add the active class if the anchor element exists
if (activeLink) {
  activeLink.classList.add('active');
}


// carosel effect
let slideIndex = 0;
showSlides();

function showSlides() {
  let slides = document.getElementsByClassName("carousel-slide");
  for (let i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  slides[slideIndex-1].style.display = "block";  
  setTimeout(showSlides, 1000); // Change image every 2 seconds
}

document.getElementById("prevBtn").addEventListener("click", function() {
  slideIndex -= 2;
  showSlides();
});

document.getElementById("nextBtn").addEventListener("click", function() {
  showSlides();
});


