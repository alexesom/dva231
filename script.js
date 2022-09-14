let slides = document.getElementsByClassName("slide");
let slideIndex = -1;
let arrayOfImages = [
    "img/headlines-1.png",
    "img/headlines-2.png",
    "img/headlines-3.png"
]

infiniteChangeSlidesLoop();

function nextSlide() {
    if(++slideIndex > slides.length-1) {
        slideIndex = 0;
    }
    showSlide(slideIndex);
}

function infiniteChangeSlidesLoop() {
    nextSlide();
    setTimeout(infiniteChangeSlidesLoop, 5000);
}

function showSlide(index) {
    for(let i = 0; i < slides.length; i++) {
        console.log(slides[i]);
        slides[i].classList.remove("active");
    }
    slides[index].classList.add("active");
    slides[index].style.background = `url('${arrayOfImages[index]}') no-repeat`;
    slides[index].style.backgroundSize = "100%";
    slides[index].style.backgroundPosition = "center center";
}
