document.addEventListener('DOMContentLoaded', () => {

    const wrapper = document.getElementById('sliderWrapper');
    const slides = document.querySelectorAll('.slide');
    const dots = document.querySelectorAll('.dot');

    let currentIndex = 0;
    const totalSlides = slides.length;
    const slideDuration = 5000; // 5 Detik

    // Fungsi Ganti Slide
    function changeSlide(index) {
        // Geser Wrapper
        // Kalau index 1, geser -100%. Kalau index 2, geser -200%.
        wrapper.style.transform = `translateX(-${index * 100}%)`;

        // Update Dots
        dots.forEach(dot => dot.classList.remove('active'));
        dots[index].classList.add('active');

        currentIndex = index;
    }

    // Auto Play Logic
    function nextSlide() {
        let newIndex = currentIndex + 1;
        if (newIndex >= totalSlides) {
            newIndex = 0; // Balik ke awal
        }
        changeSlide(newIndex);
    }

    // Jalankan Timer
    let slideInterval = setInterval(nextSlide, slideDuration);

    // Optional: Klik Dot buat pindah manual
    dots.forEach((dot, idx) => {
        dot.addEventListener('click', () => {
            changeSlide(idx);
            // Reset timer biar ga bentrok pas diklik manual
            clearInterval(slideInterval);
            slideInterval = setInterval(nextSlide, slideDuration);
        });
    });

});
