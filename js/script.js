let currentSlide = 0;

function changeSlide(direction) {
    const slides = document.getElementById("slides");
    const totalSlides = slides.children.length;

    currentSlide += direction;

    if (currentSlide < 0) currentSlide = totalSlides - 1;
    if (currentSlide >= totalSlides) currentSlide = 0;

    slides.style.transform = `translateX(${-currentSlide * 600}px)`;
}
