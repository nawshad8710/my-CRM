var header = document.getElementsByClassName("header_section")[0];
var sticky = header.offsetTop;


window.addEventListener('scroll', function () {
    if (window.pageYOffset > sticky) {
        header.classList.add("sticky");
    } else {
        header.classList.remove("sticky");
    }
})

$('.video_popup').magnificPopup({
    type: 'iframe'
});


//   socket year
let socketYear = document.getElementById("socket_year")
let PresentYear = (year) =>{
  let date = new Date()
  let PreYear = date.getFullYear()
  year.innerHTML = PreYear
}
PresentYear(socketYear)

// sub nav
$(".mobile_product").on("click", function () {
  $(".mobile_product_list").slideToggle();
});

// sub nav
$(".mobile_producttwo").on("click", function () {
  $(".mobile_product_listtwo").slideToggle();
});


// achievementItem

let achievementItem = document.getElementsByClassName("achievement_item");
[...achievementItem].forEach((item, index) => {
  let sum = [index];
  item.addEventListener("mouseenter", () => {
    let achievemenShape = document.getElementsByClassName("achievement_item_shape")[index];
    let rotate = setInterval(() => {
      sum++;
      achievemenShape.style.cssText = `transform: rotate(${sum}deg)`
    }, 10);

    item.addEventListener("mouseleave", () =>{
        clearInterval(rotate);
    })
    
  });
});

// scroll top

var srollTop = document.getElementsByClassName("sroll_top")[0];
window.addEventListener("scroll", () => {
  if (window.scrollY < 300) {
    srollTop.style.visibility = "hidden";
  } else {
    srollTop.style.visibility = "visible";
  }
});

srollTop.addEventListener("click", () => {
  document.documentElement.scrollTop = 0;
});




// slider
$(document).ready(function () {
    $(".testimonial_slider").slick({
      dots: false,
      autoplay: true,
      arrows: false,
      infinite: true,
      slidesToShow: 3,
      speed: 1000,
      responsive: [
        {
          breakpoint: 1240,
          settings: {
            slidesToShow: 2,
            infinite: true,
          }
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 1,
          }
        }
      ]
    });
  });

// slider
$(document).ready(function () {
    $(".clint_slider").slick({
      dots: false,
      autoplay: true,
      arrows: false,
      infinite: true,
      slidesToShow: 4,
      speed: 1000,
      responsive: [
        {
          breakpoint: 1240,
          settings: {
            slidesToShow: 2,
            infinite: true,
          }
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 1,
          }
        }
      ]
    });
  });
