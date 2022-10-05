let slides = document.getElementsByClassName("slide");
let slideIndex = -1;
let arrayOfImages = [
    "img/headlines-1.png",
    "img/headlines-2.png",
    "img/headlines-3.png"
]


/* NEWS2 */
let news2Headline = document.getElementById("news2__headline");
let news2HeadlineP = document.getElementById("news2__headline__p");
let news2Div = document.getElementById("news2");
let news2Img = document.getElementById("news2__img");
let news2Txt = document.getElementById("news2__txt");


/* TEXT HOVER */
news2HeadlineP.addEventListener('mouseover', function hoverNews() {
    news2Headline.style.visibility = "hidden";
    news2Img.style.visibility = "hidden";
    news2Txt.style.visibility = "visible";
});

news2Div.addEventListener('mouseleave', function hoverNewsLeave() {
    news2Headline.style.visibility = "visible";
    news2Img.style.visibility = "visible";
    news2Txt.style.visibility = "hidden";
});
/* TEXT HOVER END */

/*Hide AJAX div*/
let searchBar = document.getElementById("search__bar");
let ajaxDiv = document.getElementById("ajax__dropdown");

searchBar.addEventListener('keyup', function() {
    if (searchBar.value.length < 3) {
        ajaxDiv.style.visibility = "hidden";
    } else {
        ajaxDiv.style.visibility = "visible";
    }
});
/*Hide AJAX div end*/

/* AJAX search */

$(document).ready(function () {
    $("#search__bar").keyup(function () {
        let inputText = $("#search__bar").val();
        if (inputText.length > 2) {
            $.ajax(
                {
                    url: 'ajax_data.php',
                    method: 'POST',
                    data: {
                        recieved: 1,
                        query: inputText
                    },
                    dataType: 'text',
                    success: function (data) {
                        $("#ajax__dropdown").html(data);
                    }
                }
            );
        }
    });
});
/* AJAX search end */


infiniteChangeSlidesLoop();

function nextSlide() {
    if (++slideIndex > slides.length - 1) {
        slideIndex = 0;
    }
    showSlide(slideIndex);
}

function infiniteChangeSlidesLoop() {
    nextSlide();
    setTimeout(infiniteChangeSlidesLoop, 5000);
}

function showSlide(index) {
    for (let i = 0; i < slides.length; i++) {
        console.log(slides[i]);
        slides[i].classList.remove("active");
    }
    slides[index].classList.add("active");
    slides[index].style.background = `url('${arrayOfImages[index]}') no-repeat`;
    slides[index].style.backgroundSize = "100%";
    slides[index].style.backgroundPosition = "center center";
}
