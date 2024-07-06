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
  setTimeout(showSlides, 6000); // Change image every 2 seconds
}

document.getElementById("prevBtn").addEventListener("click", function() {
  slideIndex -= 2;
  showSlides();
});

document.getElementById("nextBtn").addEventListener("click", function() {
  showSlides();
});
