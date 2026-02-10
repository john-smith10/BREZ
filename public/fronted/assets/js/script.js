// $(function () {
//     let searchbtn = document.querySelector(".search_icon");
//     let searchbox = document.querySelector("#search-box");
//     let crossbtn = document.querySelector(".cross");

//     searchbtn.addEventListener('click', function () {
//         searchbox.classList.toggle('search_active');

//     });

//     crossbtn.addEventListener('click', function () {
//         searchbox.classList.remove('search_active');

//     });
// });



$(function () {

    document.body.style.overflow = 'hidden';
    let searchbtn = $('.search_icon');
    let searchbox = $('#search-box');
    let crossbtn = $('.cross');

    searchbtn.on('click', function () {
        searchbox.toggleClass('search_active');
         $('body').addClass('no-scroll');
    });

    crossbtn.on('click', function () {
        searchbox.removeClass('search_active');
        $('body').removeClass('no-scroll');

    });


    // Banner part for sliding

    $('.sliders').slick({
        dots: true,
        slidesToShow: 1,
        arrows: true,
        prevArrow: `<span class="prev"><iconify-icon icon="solar:arrow-left-linear" width="24" height="24"></iconify-icon></span>`,
        nextArrow: `<span class="next"><iconify-icon icon="mynaui:arrow-right" width="24" height="24"></iconify-icon></span>`,
        autoplay: true,
        autoplaySpeed: 3000,

    });

    // product(featured) part for sliding
    $(".products_parent").slick({
        infinite: true,
        slidesToShow: 5,
        slidesToScroll: 1,
        dots: true,
        arrows: true,
        prevArrow: `<span class="prev"><iconify-icon icon="solar:arrow-left-linear" width="24" height="24"></iconify-icon></span>`,
        nextArrow: `<span class="next"><iconify-icon icon="mynaui:arrow-right" width="24" height="24"></iconify-icon></span>`,
        autoplay: true,
        autoplaySpeed: 3000,
        responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: true,
        arrows: true,
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2, 
        dots: true,
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
    });


    // for tooltips
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    // for tooltips

    // category filter
    $('.category-button').categoryFilter();

    // for countdown
    $('.hq-countdown').hqCountdownTimer({
  endMessage: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"/></svg> Countdown Completed!',
  onEnd: function() {
    console.log('Countdown finished!');
  }
});

// for aos
AOS.init();


// for product description
 $('.slider-for').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: false,
  fade: true,
  asNavFor: '.slider-nav'
});
$('.slider-nav').slick({
  slidesToShow: 4,
  slidesToScroll: 1,
  asNavFor: '.slider-for',
  dots: false,
  vertical: true,
  centerMode: false,
  centerPadding: "0px",
  focusOnSelect: true, 
  arrows: true, 
  prevArrow: `<span class="prev"><iconify-icon icon="simple-line-icons:arrow-up" width="24" height="24"></iconify-icon></span>`,
  nextArrow: `<span class="next"><iconify-icon icon="simple-line-icons:arrow-down" width="24" height="24"></iconify-icon></span>`,
   responsive: [
    {
      breakpoint: 992,
      settings: {
       arrows: false,
        vertical: false,
      }
    },
    // {
    //   breakpoint: 600,
    //   settings: {
    //     slidesToShow: 2,
    //     slidesToScroll: 2
    //   }
    // },
    // {
    //   breakpoint: 480,
    //   settings: {
    //     slidesToShow: 1,
    //     slidesToScroll: 1
    //   }
    // }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]


});

// for zoom
$(".example").imagezoomsl();

//for product_desc inc & dec
let inc = document.querySelector("#product_desc .inc");
let dec = document.querySelector("#product_desc .dec");
let text = document.querySelector("#product_desc .text");


//for real price
let price_real = document.querySelector("#product_desc .price1");
let rawPrice = price_real.textContent; // or innerText
let price = parseFloat(rawPrice.replace(/[^0-9.]/g, '')); // removes $ and parses number

//for discounted price
let price_dis = document.querySelector("#product_desc .price_d");
let rawPrice2 = price_dis.textContent; // or innerText
let price_d = parseFloat(rawPrice2.replace(/[^0-9.]/g, '')); // removes $ and parses number
console.log(price_d);

inc.addEventListener('click', function() {
  let count = Number(text.value);

  if(count+1 <16)
  {
    count++;
    text.value = count;
    dec.style.cursor = 'cursor';
    let total = price*count;
    let total_dis = price_d * count;
    price_real.textContent = `$${total.toFixed(2)}`;
    price_dis.textContent = `$${total_dis.toFixed(2)}`;
  }

  else
  {
    inc.style.cursor = 'not-allowed';
   
  }

  
});


dec.addEventListener('click', function()
{
   let count = Number(text.value);

   if(count >1)
   {
    count--;
    text.value = count;
    inc.style.cursor = 'pointer';
    let total = price*count;
    let total_dis = price_d*count;
    price_real.textContent = `$${total.toFixed(2)}`;
    price_dis.textContent = `$${total_dis.toFixed(2)}`;
   }
   else
   {
     dec.style.cursor = 'not-allowed';
   }
  
});


//for product_desc inc & dec

//for vtabs
$('.example').vTabs({
  // 'hover' : true,
});
//for vtabs

//for price ranger
$("#slider-range").slider({
  range: true,
  orientation: "horizontal",
  min: 0,
  max: 10000,
  //10000
  values: [0, 10000],
  step: 100,

  slide: function (event, ui) {
    if (ui.values[0] == ui.values[1]) {
      return false;
    }
    
    $("#min_price").val(ui.values[0]);
    $("#max_price").val(ui.values[1]);
  }
});
//for price ranger



});




