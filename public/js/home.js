document.addEventListener('DOMContentLoaded', () => {

    const wrapper = document.getElementById('sliderWrapper');
    const slides = document.querySelectorAll('.slide');
    const dots = document.querySelectorAll('.dot');

    let currentIndex = 0;
    const totalSlides = slides.length;
    const slideDuration = 5000;

    function changeSlide(index) {
        wrapper.style.transform = `translateX(-${index * 100}%)`;

        dots.forEach(dot => dot.classList.remove('active'));
        dots[index].classList.add('active');

        currentIndex = index;
    }

    function nextSlide() {
        let newIndex = currentIndex + 1;
        if (newIndex >= totalSlides) {
            newIndex = 0;
        }
        changeSlide(newIndex);
    }

    let slideInterval = setInterval(nextSlide, slideDuration);

    dots.forEach((dot, idx) => {
        dot.addEventListener('click', () => {
            changeSlide(idx);
            clearInterval(slideInterval);
            slideInterval = setInterval(nextSlide, slideDuration);
        });
    });

});
