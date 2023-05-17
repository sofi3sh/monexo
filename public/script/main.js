$('.faq_item').click(function(){
  $('.faq_item').removeClass('faq_item_active').children('.faq_content').slideUp('slow')
  $(this).toggleClass('faq_item_active').children('.faq_content').slideToggle('slow');
})
$(".fancybox").fancybox();
$(".slider_investors").slick({
  dots: false,
  infinite: true,
  slidesToShow: 2,
  slidesToScroll:  1,
  prevArrow: '<div class="prevArrow"><svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.375 12.293V1.20703C0.375 0.834635 0.546875 0.576823 0.890625 0.433594C1.26302 0.290365 1.57812 0.347656 1.83594 0.605469L7.37891 6.14844C7.55078 6.32031 7.63672 6.52083 7.63672 6.75C7.63672 6.97917 7.55078 7.17969 7.37891 7.35156L1.83594 12.8945C1.57812 13.1523 1.26302 13.2096 0.890625 13.0664C0.546875 12.9232 0.375 12.6654 0.375 12.293Z" fill="#5E72E4" fill-opacity="0.7"/></svg></div>',
  nextArrow: '<div class="nextArrow"><svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.375 12.293V1.20703C0.375 0.834635 0.546875 0.576823 0.890625 0.433594C1.26302 0.290365 1.57812 0.347656 1.83594 0.605469L7.37891 6.14844C7.55078 6.32031 7.63672 6.52083 7.63672 6.75C7.63672 6.97917 7.55078 7.17969 7.37891 7.35156L1.83594 12.8945C1.57812 13.1523 1.26302 13.2096 0.890625 13.0664C0.546875 12.9232 0.375 12.6654 0.375 12.293Z" fill="#5E72E4" fill-opacity="0.7"/></svg></div>',
  responsive: [{
      breakpoint: 992,
      settings: {
          slidesToShow: 2
      }
  }, {
      breakpoint: 768,
      settings: {
          slidesToShow: 1
      }
  }]
});
$(".slider_why").slick({
  dots: false,
  infinite: true,
  slidesToShow: 3,
  slidesToScroll:  1,
  prevArrow: '<div class="prevArrow"><svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.375 12.293V1.20703C0.375 0.834635 0.546875 0.576823 0.890625 0.433594C1.26302 0.290365 1.57812 0.347656 1.83594 0.605469L7.37891 6.14844C7.55078 6.32031 7.63672 6.52083 7.63672 6.75C7.63672 6.97917 7.55078 7.17969 7.37891 7.35156L1.83594 12.8945C1.57812 13.1523 1.26302 13.2096 0.890625 13.0664C0.546875 12.9232 0.375 12.6654 0.375 12.293Z" fill="#5E72E4" fill-opacity="0.7"/></svg></div>',
  nextArrow: '<div class="nextArrow"><svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.375 12.293V1.20703C0.375 0.834635 0.546875 0.576823 0.890625 0.433594C1.26302 0.290365 1.57812 0.347656 1.83594 0.605469L7.37891 6.14844C7.55078 6.32031 7.63672 6.52083 7.63672 6.75C7.63672 6.97917 7.55078 7.17969 7.37891 7.35156L1.83594 12.8945C1.57812 13.1523 1.26302 13.2096 0.890625 13.0664C0.546875 12.9232 0.375 12.6654 0.375 12.293Z" fill="#5E72E4" fill-opacity="0.7"/></svg></div>',
  responsive: [{
      breakpoint: 992,
      settings: {
          slidesToShow: 2
      }
  }, {
      breakpoint: 768,
      settings: {
          slidesToShow: 1
      }
  }]
});

$('.card-wrapper').slick({
  slidesToShow: 4,
  slidesToScroll: 1,
  prevArrow: '<div class="prevArrow"><svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.375 12.293V1.20703C0.375 0.834635 0.546875 0.576823 0.890625 0.433594C1.26302 0.290365 1.57812 0.347656 1.83594 0.605469L7.37891 6.14844C7.55078 6.32031 7.63672 6.52083 7.63672 6.75C7.63672 6.97917 7.55078 7.17969 7.37891 7.35156L1.83594 12.8945C1.57812 13.1523 1.26302 13.2096 0.890625 13.0664C0.546875 12.9232 0.375 12.6654 0.375 12.293Z" fill="#5E72E4" fill-opacity="0.7"/></svg></div>',
  nextArrow: '<div class="nextArrow"><svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.375 12.293V1.20703C0.375 0.834635 0.546875 0.576823 0.890625 0.433594C1.26302 0.290365 1.57812 0.347656 1.83594 0.605469L7.37891 6.14844C7.55078 6.32031 7.63672 6.52083 7.63672 6.75C7.63672 6.97917 7.55078 7.17969 7.37891 7.35156L1.83594 12.8945C1.57812 13.1523 1.26302 13.2096 0.890625 13.0664C0.546875 12.9232 0.375 12.6654 0.375 12.293Z" fill="#5E72E4" fill-opacity="0.7"/></svg></div>',
  responsive: [
      {
          breakpoint: 1199,
          settings: {
            slidesToShow: 2,
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 1,
            centerPadding: '40px',
          }
        }
    ]
});
let dark = true;
const one = document.querySelector('html')
localStorage.setItem('theme',false);
$(".btn-dark").click(function() {
  one.style.setProperty('--main-theme' , '#14172a');
  one.style.setProperty('--main-fonts' , '#ffffff');
  one.style.setProperty('--card-theme' , '#1b203d');
  one.style.setProperty('--faq-bgc' , '#1b203d');
  one.style.setProperty('--faq-header' , '#171c35');
  one.style.setProperty('--footer-bgc' , '#131833');
  one.style.setProperty('--img' , 'invert(1)');
  html.style.setProperty('--dark' , '#5e72e4');
  html.style.setProperty('--light' , '#dfe4ff');
  localStorage.setItem('theme' , dark);
});
$(".btn-bright").click(function() {
 one.style.setProperty('--main-theme' , '#ffffff');
 one.style.setProperty('--main-fonts' , '#1c1c1c');
 one.style.setProperty('--card-theme' , '#ffffff');
 one.style.setProperty('--wrap-main' , '#c3c3c3');
 one.style.setProperty('--faq-bgc' , '#fafaff');
 one.style.setProperty('--faq-header' , '#e8ebff');
 one.style.setProperty('--header-shadow' , '0 5px 50px rgba(0, 0, 0, .05)');
 one.style.setProperty('--footer-bgc' , '#ffffff');
 one.style.setProperty('--img' , 'invert(0)');
 html.style.setProperty('--dark' , '#dfe4ff');
 html.style.setProperty('--light' , '#5e72e4');
 localStorage.removeItem('theme');
});

//switcher
$('.tab-switcher').click(function () {
    $('.tab-switcher').removeClass('active');
    $(this).addClass('active');

    if ($(this).hasClass('first')) {
        $('.plan').removeClass('active');
        $('.plan-first').addClass('active');
        $('.plugin__list .plugin__list-item .col').removeClass('active');
        $('.plugin__list .plugin__list-item .first').addClass('active');
    }
    if ($(this).hasClass('second')) {
        $('.plan').removeClass('active');
        $('.plan-second').addClass('active');
        $('.plugin__list .plugin__list-item .col').removeClass('active');
        $('.plugin__list .plugin__list-item .second').addClass('active');
    }
    if ($(this).hasClass('third')) {
        $('.plan').removeClass('active');
        $('.plan-third').addClass('active');
        $('.plugin__list .plugin__list-item .col').removeClass('active');
        $('.plugin__list .plugin__list-item .third').addClass('active');
    }
    if ($(this).hasClass('four')) {
        $('.plan').removeClass('active');
        $('.plan-four').addClass('active');
        $('.plugin__list .plugin__list-item .col').removeClass('active');
        $('.plugin__list .plugin__list-item .third').addClass('active');
    }
    if ($(this).hasClass('five')) {
        $('.plan').removeClass('active');
        $('.plan-five').addClass('active');
        $('.plugin__list .plugin__list-item .col').removeClass('active');
        $('.plugin__list .plugin__list-item .five').addClass('active');
    }
});


function myFunction() {
    var copyText = document.getElementById("myInput");
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    document.execCommand("copy");

    var tooltip = document.getElementById("myTooltip");
    tooltip.innerHTML = "Скопировано: " + copyText.value;
}

function outFunc() {
    var tooltip = document.getElementById("myTooltip");
    tooltip.innerHTML = "Скопировать email";
}
