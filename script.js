let currentSlide = 0;
const images = ["hero1.jpg", "hero2.jpg", "hero3.jpg"]; // Replace with your images
const hero = document.querySelector(".hero");

function showSlide(index) {
  if (index >= images.length) currentSlide = 0;
  else if (index < 0) currentSlide = images.length - 1;
  else currentSlide = index;

  hero.style.background = `url('${images[currentSlide]}') no-repeat center center/cover`;
}

function nextSlide() {
  showSlide(currentSlide + 1);
}

function prevSlide() {
  showSlide(currentSlide - 1);
}

// Auto slide
setInterval(nextSlide, 5000);
