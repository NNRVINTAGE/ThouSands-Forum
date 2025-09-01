fetch('slide.php')
.then(response => response.json())
.then(banners => {
    const slidesContainer = document.querySelector('#slides');
    banners.forEach(banner => {
        const slide = document.createElement('div');
        slide.className = 'autoMg wh100p flex acjc';
        slide.innerHTML = `
        <img src="../libsImg/${banner.bannerRefImg}"  class="autoMg w79 h100p objfit" alt="">
        <a href="redirect.php?ids=${banner.refLinks}" class="link-cover" target="_blank" rel="noopener noreferrer">.</a>
        `;
        slidesContainer.appendChild(slide);
    });

    const slides = document.querySelector('#slides');
    let index = 0;
    const totalSlides = slides.children.length;
    const autoSlideInterval = 5000;

    function showSlide(n) {
        if (n >= totalSlides) index = 0;
        if (n < 0) index = totalSlides - 1;
        slides.style.transform = `translateX(${-index * 100}%)`;
    }

    function nextSlide() {
        showSlide(++index);
    }
    function prevSlide() {
        showSlide(--index);
    }

    document.querySelector('.prev').addEventListener('click', function() {
        prevSlide();
        resetAutoSlide();
    });
    document.querySelector('.next').addEventListener('click', function() {
        nextSlide();
        resetAutoSlide();
    });

    let autoSlideTimer = setInterval(nextSlide, autoSlideInterval);
    function resetAutoSlide() {
        clearInterval(autoSlideTimer);
        autoSlideTimer = setInterval(nextSlide, autoSlideInterval);
    }

    showSlide(index);
});
