/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};

/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {

/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;

/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			exports: {},
/******/ 			id: moduleId,
/******/ 			loaded: false
/******/ 		};

/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);

/******/ 		// Flag the module as loaded
/******/ 		module.loaded = true;

/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}


/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;

/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;

/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";

/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ function(module, exports, __webpack_require__) {

	'use strict';

	var _markupMenu = __webpack_require__(1);

	var _main = __webpack_require__(3);

	var _accordion = __webpack_require__(4);

	(0, _markupMenu.markupMenu)(window.document);

	$(document).ready(function () {
	  (0, _main.main)();
	  (0, _accordion.initAccordion)();

	  /*Открыть-закрыть "Нав Меню"*/

	  $('.content').click(function () {
	    $('.nav-hidden-box').removeClass('active');
	    $('#nav-hamburger').removeClass('open');
	  });
	  $('.nav-hidden-box').click(function (e) {
	    e.stopPropagation();
	  });

	  /*Открыть-закрыть Обратную связь*/
	  $('.feedback').click(function () {
	    $('.hidden-feedback').addClass('active');
	  });

	  $('.close-feedback, .hidden-feedback').click(function () {
	    $('.hidden-feedback').removeClass('active');
	  });

	  $('.feedback-holder').click(function (e) {
	    e.stopPropagation();
	  });

	  /*Открыть-закрыть "Корзину"*/

	  $('.card-box').click(function () {
	    $('.hidden-card').toggleClass('active');
	    $('.card-box').toggleClass('active');
	    $('.hidden-menu').removeClass('active');
	    $('.nav-more').removeClass('active');
	    $('.nav-link').removeClass('active');
	    $('.nav-holder').removeClass('active');
	  });
	  $('.hidden-card, .card-box').click(function (e) {
	    e.stopPropagation();
	  });
	  $('body').click(function () {
	    $('.hidden-card').removeClass('active');
	    $('.card-box').removeClass('active');
	  });

	  /*Открыть-закрыть "Поиск"*/
	  $('.search-button').click(function () {
	    $('.hidden-search').addClass('active');
	  });

	  $('.search-close, .hidden-search').click(function () {
	    $('.hidden-search').removeClass('active');
	  });

	  $('.search-form').click(function (e) {
	    e.stopPropagation();
	  });

	  /*Если нужно убирать placehoder*/
	  $('input, textarea').focus(function () {
	    $(this).data('placeholder', $(this).attr('placeholder'));
	    $(this).attr('placeholder', '');
	  });

	  $('input, textarea').blur(function () {
	    $(this).attr('placeholder', $(this).data('placeholder'));
	  });

	  /*Добавляем Tabs*/
	  initTabs();

	  /*Ввод номера телефона*/
	  $('input[type="tel"]').mask('+38 (099) 999-99-99');

	  /*Если у товара есть Скидка, то перечеркивать старую цену))) Но оно не работает(((
	  $(function(){
	    var old = $('.old-price');
	    var sale = $('.catalog-sale');
	    var item = $('.catalog-item');
	     if (item.is(sale)) {
	      old.css("text-decoration" , "line-through");
	    }
	    else {
	      old.css("text-decoration" , "none");
	    }
	  });*/

	  /*Стилизация скролла*/
	  $(".box-text").mCustomScrollbar();

	  /*ДОБАВЛЯЕМ СЛАЙДЕРЫ*/

	  /*Большой верхний слайдер*/
	  $(function () {
	    $('.catalog-slider').slick({
	      dots: true
	    });
	  });

	  $(function () {
	    $('.catalog-image-hover').slick();
	  });

	  /*Слайдер "Выгодные предложения*/
	  $(function () {
	    $('.catalog-sale-slider').slick({
	      slidesToShow: 4,
	      swipeToSlide: true,
	      responsive: [{
	        breakpoint: 1279,
	        settings: {
	          slidesToShow: 3
	        }
	      }, {
	        breakpoint: 1023,
	        settings: {
	          slidesToShow: 2
	        }
	      }, {
	        breakpoint: 767,
	        settings: {
	          slidesToShow: 1,
	          dots: true,
	          arrows: false
	        }
	      }]
	    });
	  });

	  /*Слайдер "Последние статьи"*/
	  $(function () {
	    $('.news-slider').slick({
	      slidesToShow: 3,
	      swipeToSlide: true,
	      responsive: [{
	        breakpoint: 1023,
	        settings: {
	          slidesToShow: 2
	        }
	      }, {
	        breakpoint: 767,
	        settings: {
	          slidesToShow: 1,
	          arrows: false,
	          dots: true
	        }
	      }]
	    });
	  });

	  /*Слайдер "Наша команда"*/
	  $(function () {
	    $('.our-team-slider').slick({
	      slidesToShow: 4,
	      swipeToSlide: true,
	      responsive: [{
	        breakpoint: 1250,
	        settings: {
	          slidesToShow: 3
	        }
	      }, {
	        breakpoint: 1023,
	        settings: {
	          slidesToShow: 2
	        }
	      }, {
	        breakpoint: 767,
	        settings: {
	          slidesToShow: 1
	        }
	      }]
	    });
	  });

	  /*Слайдер "Галерея"*/
	  $(function () {
	    $('.gallery-slider').slick({
	      slidesToShow: 2,
	      swipeToSlide: true,
	      responsive: [{
	        breakpoint: 767,
	        settings: {
	          slidesToShow: 1
	        }
	      }]
	    });
	  });

	  /*Слайдеры блога в сайтбаре*/
	  $(function () {
	    $('.top-products-slider').slick();
	  });

	  /*Блог слайдер с баннерами*/
	  $(function () {
	    $('.special-sliders').slick({
	      slidesToShow: 2,
	      responsive: [{
	        breakpoint: 1023,
	        settings: {
	          slidesToShow: 1
	        }
	      }, {
	        breakpoint: 767,
	        settings: {
	          slidesToShow: 1,
	          arrows: false,
	          dots: true
	        }
	      }]
	    });
	  });

	  /*Блог двойной слайдер*/
	  $(function () {
	    $('.blog-big-slider').slick({
	      arrows: false,
	      asNavFor: '.blog-mini-slider',
	      fade: true
	    });
	    $('.blog-mini-slider').slick({
	      slidesToShow: 4,
	      asNavFor: '.blog-big-slider',
	      focusOnSelect: true,
	      swipeToSlide: true,
	      responsive: [{
	        breakpoint: 600,
	        settings: {
	          slidesToShow: 3
	        }
	      }, {
	        breakpoint: 479,
	        settings: {
	          slidesToShow: 2
	        }
	      }]
	    });
	  });

	  /*Иконка Меню-гамбургер*/
	  $(function () {
	    $('#nav-hamburger').click(function () {
	      $('#nav-hamburger').toggleClass('open');
	    });
	  });

	  $(function () {
	    $('#nav-footer-hamburger').click(function () {
	      $('#nav-footer-hamburger').toggleClass('open');
	    });
	  });

	  $(function () {

	    var flag = true;
	    $('#nav-footer-hamburger').click(function () {
	      if (flag) {
	        flag = false;
	        func1.call(this);
	      } else {
	        flag = true;
	        func2.call(this);
	      }
	      return false;
	    });

	    function func1() {
	      $('#nav-footer-hamburger').addClass('open');
	      $('.footer-nav-box').addClass('active');
	    }
	    function func2() {
	      $('#nav-footer-hamburger').removeClass('open');
	      $('.footer-nav-box').removeClass('active');
	    }
	  });

	  /*Если размер экрана меньше или равно 567px, то > Меню-аккордеон*/
	  $(function () {
	    if ($(window).width() <= 567) {
	      $('.open-dropdown').on('click', function (e) {
	        e.preventDefault();
	        $(this).toggleClass('active');
	        $(this).children('.dropdown').toggleClass('active');
	        $(this).children('.dropdown').slideToggle(400);
	      });
	      $('.dropdown').on('click', function (e) {
	        e.stopPropagation();
	      });
	    }
	  });

	  $(window).resize(function () {
	    if ($(window).width() <= 567) {
	      $('.open-dropdown').on('click', function (e) {
	        e.preventDefault();
	        $(this).toggleClass('active');
	        $(this).children('.dropdown').toggleClass('active');
	        $(this).children('.dropdown').slideToggle(400);
	      });
	      $('.dropdown').on('click', function (e) {
	        e.stopPropagation();
	      });
	    }
	  });

	  $('.question').click(function () {
	    $(this).toggleClass('active');
	  });
	  $('.answer').click(function (e) {
	    e.stopPropagation();
	  });

	  $('.read-more').click(function () {
	    $('.cooperation-info').toggleClass('active');
	  });

	  /*Новое*/
	  $(function () {
	    $('.slider-holder').slick();
	  });

	  $(function () {
	    $('.gallery-box').slick({
	      centerMode: true,
	      centerPadding: '601px',
	      responsive: [{
	        breakpoint: 1899,
	        settings: {
	          centerPadding: '351px'
	        }
	      }, {
	        breakpoint: 1279,
	        settings: {
	          centerPadding: '200px'
	        }
	      }, {
	        breakpoint: 1023,
	        settings: {
	          centerPadding: '50px'
	        }
	      }, {
	        breakpoint: 735,
	        settings: {
	          centerPadding: '0'
	        }
	      }]
	    });
	  });

	  $('.infobox-text-click').click(function () {
	    if ($(this).parents('.service-infobox-inner').hasClass('active')) {
	      $(this).parents('.service-infobox-inner').toggleClass('active');
	    } else {
	      $('.repair-services-box .service-infobox-inner').removeClass('active').find(".holder-text").mCustomScrollbar("destroy");
	      $(this).parents('.service-infobox-inner').toggleClass('active').find(".holder-text").mCustomScrollbar();
	    }
	    //   if ($('.service-infobox-inner').hasClass('active')) {
	    //       $(".holder-text").mCustomScrollbar();
	    //   } else {
	    //       $(".holder-text").mCustomScrollbar("destroy");
	    //   }
	  });

	  $(function () {
	    $('.big-slider').slick({
	      arrows: false,
	      asNavFor: '.mini-slider',
	      fade: true
	    });
	    $('.mini-slider').slick({
	      slidesToShow: 4,
	      asNavFor: '.big-slider',
	      focusOnSelect: true,
	      swipeToSlide: true,
	      responsive: [{
	        breakpoint: 526,
	        settings: {
	          slidesToShow: 3
	        }
	      }, {
	        breakpoint: 400,
	        settings: {
	          slidesToShow: 2
	        }
	      }]
	    });
	  });

	  /* 15.03.2017 */

	  /* Добавить отзыв */
	  $('.add-review').click(function () {
	    $('.popup-add-review').addClass('active');
	  });
	  $('.close-popup-review, .popup-add-review').click(function () {
	    $('.popup-add-review').removeClass('active');
	  });
	  $('.add-review-holder').click(function (e) {
	    e.stopPropagation();
	  });

	  /*после добавления отзыва*/
	  // $('.after-add-review').click(function(){
	  //   $('.popup-after-add-review').addClass('active');
	  //   $('.popup-add-review, .popup-service').removeClass('active');
	  //   setTimeout(function(){$('.popup-after-add-review').fadeOut('fast')},2000);
	  // });
	  // $('.close-popup-review, .popup-after-add-review').click(function(){
	  //   $('.popup-after-add-review').removeClass('active');
	  // });

	  /* Отзывы читать больше */
	  $('.review-read-more').click(function () {
	    $('.popup-read-more-review').addClass('active');
	  });
	  $('.close-popup-read-more, .popup-read-more-review').click(function () {
	    $('.popup-read-more-review').removeClass('active');
	  });
	  $('.read-more-holder').click(function (e) {
	    e.stopPropagation();
	  });

	  /*Countdown счетчик*/

	  $('#getting-started').each(function () {
	    var $this = $(this),
	        finalDate = $(this).data('countdown');
	    $this.countdown(finalDate, function (event) {
	      $this.html(event.strftime('' + '<div><span>%D</span> <em>\u0414\u043D\u0435\u0439</em></div>' + '<div><span>%H</span> <em>\u0427\u0430\u0441\u043E\u0432</em></div> ' + '<div><span>%M</span> <em>\u041C\u0438\u043D\u0443\u0442</em></div>' + '<div><span>%S</span> <em>\u0421\u0435\u043A\u0443\u043D\u0434</em></div>'));
	    });
	  });

	  /* 17.03.2017 */

	  /* select open */
	  // $('.select.open').click(function(){
	  //
	  //     if ($(this).hasClass('active')) {
	  //         $(this).toggleClass('active');
	  //     } else {
	  //         $('.select.open').removeClass('active');
	  //         $(this).toggleClass('active');
	  //     }
	  //
	  // });


	  $('.list-group-item').click(function () {
	    $(this).toggleClass('active');
	  });
	  $('.option-values').click(function (e) {
	    e.stopPropagation();
	  });

	  $('.opener-text').each(function () {
	    $(this).click(function (e) {
	      e.preventDefault();
	      $(this).toggleClass('active');
	      $(this).hasClass('active') ? $(this).html($(this).data('close')) : $(this).html($(this).data('open'));
	      if ($(this).hasClass('active')) {
	        $(this).parents('.list-group-item').find('label').show();
	      } else {
	        $(this).parents('.list-group-item').find('label').hide().slice(0, 5).show();
	      }
	    });
	  });
	  $('.option-values').each(function () {
	    $(this).find('label').hide().slice(0, 5).show();
	  });

	  $(function () {
	    var textShow = $('.opener-text').attr('data-text-show');
	    var textHide = $('.opener-text').attr('data-text-hide');
	    var flag = true;
	    $('.opener-text').click(function () {
	      if (flag) {
	        flag = false;
	        func1.call(this);
	      } else {
	        flag = true;
	        func2.call(this);
	      }
	      return false;
	    });

	    function func1() {
	      $(this).html(textShow);
	    }
	    function func2() {
	      $(this).html(textHide);
	    }
	  });

	  /*Popup service*/

	  $('.btn-service').click(function () {

	    var page = $(this).parents('.iphone-all').find('.info-title').attr('data');
	    var btn = $(this).attr('data');
	    var title = $(this).parents('.service-selection').find('.service-title').attr('data');

	    $('.title-service').html(title);
	    $('input[name="title"]').val(title);
	    $('.btn-title').html(btn);
	    $('input[name="subtitle"]').val(btn);
	    $('.popup-service').addClass('active');
	    $('input[name="page"]').val(page);
	  });
	  $('.close-popup, .popup-service').click(function () {
	    $('.popup-service').removeClass('active');
	    $('.title-service').html('');
	    $('.btn-title').html('');
	  });
	  $('.popup-holder').click(function (e) {
	    e.stopPropagation();
	  });

	  $('.btn-service.slider-btn').click(function () {

	    var page = $(this).parents('.iphone-all').find('.info-title').attr('data');
	    var title = $(this).parents('.product-list.repairs').find('.tab.active').attr('data');
	    var btn = $(this).parents('.slider-info').find('.info-title').attr('data');

	    $('.title-service').html(title);
	    $('input[name="title"]').val(title);
	    $('.btn-title').html(btn);
	    $('input[name="subtitle"]').val(btn);
	    $('.popup-service').addClass('active');
	    $('input[name="page"]').val(page);
	  });
	  $('.close-popup, .popup-service').click(function () {
	    $('.popup-service').removeClass('active');
	    $('.title-service').html('');
	    $('.btn-title').html('');
	  });
	  $('.popup-holder').click(function (e) {
	    e.stopPropagation();
	  });

	  // var slider = document.getElementById('scale-price');
	  // if(slider) {
	  //     noUiSlider.create(slider, {
	  //     	start: [0, 100],
	  //     	connect: true,
	  //     	range: {
	  //     		'min': 0,
	  //     		'max': 100
	  //     	}
	  //     });
	  // }

	  $(function () {
	    if ($(window).width() <= 1250) {
	      $('.tile-catalog').removeClass('line-catalog');
	    }
	    $(window).resize(function () {
	      if ($(window).width() <= 1250) {
	        $('.tile-catalog').removeClass('line-catalog');
	      }
	    });
	  });
	  $(function () {
	    if ($(window).width() > 1250) {
	      if ($('.line').hasClass('active')) {
	        $('.tile-catalog').addClass('line-catalog');
	      } else {
	        $('.tile-catalog').removeClass('line-catalog');
	      }
	    }
	    $(window).resize(function () {
	      if ($(window).width() > 1250) {
	        if ($('.line').hasClass('active')) {
	          $('.tile-catalog').addClass('line-catalog');
	        } else {
	          $('.tile-catalog').removeClass('line-catalog');
	        }
	      }
	    });
	  });

	  $('.products-controls').click(function () {
	    $('.sidebar-selection').addClass('popup-block');
	  });
	  $('.panel-ocfilter').click(function (e) {
	    e.stopPropagation();
	  });
	  $('.sidebar-selection, .close-panel').click(function () {
	    $('.sidebar-selection').removeClass('popup-block');
	  });

	  $(function () {
	    if ($(window).width() > 1250) {
	      if ($('.sidebar-selection').hasClass('popup-block')) {
	        $('.sidebar-selection').removeClass('popup-block');
	      }
	    }
	    $(window).resize(function () {
	      if ($(window).width() > 1250) {
	        if ($('.sidebar-selection').hasClass('popup-block')) {
	          $('.sidebar-selection').removeClass('popup-block');
	        }
	      }
	    });
	  });

	  $('.item-buy-click').click(function () {
	    $('.popup-order-click').addClass('active');
	  });
	  $('.close-feedback, .popup-order-click').click(function () {
	    $('.popup-order-click').removeClass('active');
	  });
	  $('.order-click-holder').click(function (e) {
	    e.stopPropagation();
	  });

	  $('.forgot-password').click(function () {
	    $('.popup-forgot-password').addClass('active');
	  });
	  $('.close-feedback, .popup-forgot-password').click(function () {
	    $('.popup-forgot-password').removeClass('active');
	  });

	  $('.video-opener').click(function () {
	    $('.popup-video').addClass('active');
	  });
	  $('.close-feedback, .popup-video').click(function () {
	    $('.popup-video').removeClass('active');
	  });
	  $('.popup-video-holder').click(function (e) {
	    e.stopPropagation();
	  });

	  $('.edit').click(function () {
	    $('.hidden-item-edit').addClass('active');
	  });
	  $('.close-feedback, .hidden-item-overlay').click(function () {
	    $('.hidden-item-edit').removeClass('active');
	  });

	  $(".big-slider a").fancybox();

	  $('.link-map').click(function (e) {
	    $('.link-map').removeClass('active');
	    $(this).toggleClass('active');
	    e.preventDefault();
	  });

	  $('.play-button').click(function () {
	    $('.video-holder').addClass('active');
	  });
	  $('.video-holder').find('.close-feedback').click(function () {
	    $('.video-holder').removeClass('active');
	  });

	  $('.estimate__label').click(function () {
	    var dataSmile = $(this).attr('for');
	    var dataText = $(this).attr('data-evaluation-text');
	    var dataColor = $(this).attr('data-evaluation-color');
	    $('.evaluation-text').html(dataText).css('color', dataColor);
	    $('.evaluation-icon').removeClass('active');
	    $('[data-smile=' + dataSmile + ']').addClass('active');
	  });
	  // $('.estimate__label').on('mouseover', function() {
	  //     $(this).trigger('click')
	  // })

	  // $('.quantity-answer').on('click', function () {
	  //     $(this).parents('li').find($('.quantity-answer-popup')).toggleClass('active');
	  // });


	  // $('.user-text-rating').find('.quantity-answer').click(function () {
	  //     $(this).parents('li').find($('.quantity-answer-popup')).toggleClass('active');
	  // });
	  $(document).on('click', '.user-text-rating .quantity-answer', function () {
	    $(this).parents('li').find('.quantity-answer-popup').toggleClass('active');
	  });

	  $('.user-text-rating .answer').click(function () {
	    $('.fast-answer').removeClass('active');
	    $('.fast-answer').toggleClass('active');
	    $(this).parents('.user-text-rating').append($('.fast-answer'));
	  });
	  $(document).on('click', '.user-text-rating .answer', function () {
	    $(this).parents('.user-text-rating').append($('.fast-answer'));
	    $('.fast-answer').removeClass('active');
	    $('.fast-answer').toggleClass('active');
	  });

	  $('body, .cancel-form').click(function () {
	    $('.fast-answer').removeClass('active');
	  });
	  $('.fast-answer').click(function (e) {
	    e.stopPropagation();
	  });

	  // $('.like, .dislike').click(function () {
	  //     $('.like-box').children('.like, .dislike').removeClass('active');
	  //     $(this).addClass('active');
	  // });

	});

/***/ },
/* 1 */
/***/ function(module, exports, __webpack_require__) {

	'use strict';

	Object.defineProperty(exports, "__esModule", {
	  value: true
	});
	exports.markupMenu = markupMenu;

	var _files = __webpack_require__(2);

	var _files2 = _interopRequireDefault(_files);

	function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

	function markupMenu(document) {
	  var nav = document.createElement('div');
	  var style = document.createElement('style');
	  var button = document.createElement('button');
	  var wrapper = document.createElement('div');
	  wrapper.appendChild(button);
	  wrapper.appendChild(nav);
	  wrapper.className = 'helper-nav-wrapper';
	  button.innerHTML = "Open pages list";
	  button.className = 'helper-nav-button';
	  nav.className = 'helper-nav';
	  style.innerHTML = '.helper-nav a:hover {\n      color:#fff;\n      background-color:#000;\n    }\n    .helper-nav a {\n      display:block;\n      color: #000;\n      padding: 3px;\n      margin:0\n    }\n    .helper-nav-button {\n      background: #000;\n      color: #fff;\n      padding: 5px;\n      font-weight: 300;\n      font-size: 12px;\n      border: none;\n      border-radius: 3px 0 0 0;\n      cursor: pointer;\n    }\n    .helper-nav-wrapper {\n      position: fixed;\n      bottom: 0;\n      right: 0;\n      font-family: monospace;\n      z-index: 9999;\n      text-align: right;\n      font-size: 14px;\n    }\n    .helper-nav {\n      text-align: left;\n      background-color: #fff;\n      border: 1px solid #000;\n      padding: 3px;\n      boxShadow: 0 0 40px 0 rgba(0,0,0,.2);\n      max-height: 300px;\n      overflow-y: auto;\n    }\n    @media all and (max-width:1024px) {\n      .helper-nav {\n        height: 160px;\n        overflow-y: scroll;\n      }\n    }';
	  document.head.appendChild(style);
	  if (_files2.default[0] !== 'dev') {
	    console.warn('Art Lemon production');
	    return;
	  }
	  for (var i = 1; i < _files2.default.length; i++) {
	    nav.innerHTML += '<a href="/' + _files2.default[i] + '">' + i + '-' + _files2.default[i] + '</a>';
	  }
	  document.body.appendChild(wrapper);
	  var flag = localStorage.getItem('flag') ? JSON.parse(localStorage.getItem('flag')) : false;
	  var display = flag ? 'block' : 'none';
	  var btnText = flag ? 'Close pages list' : 'Open pages list';
	  nav.style.display = display;
	  button.innerHTML = btnText;

	  function toggleNav() {
	    if (flag) {
	      nav.style.display = 'none';
	      button.innerHTML = 'Open pages list';
	    } else {
	      nav.style.display = 'block';
	      button.innerHTML = 'Close pages list';
	    }
	    flag = !flag;
	    localStorage.setItem('flag', flag);
	  }
	  document.addEventListener('keyup', function (e) {
	    if (e.type === 'keyup' && e.ctrlKey && e.keyCode === 88) {
	      toggleNav();
	    }
	  });
	  button.addEventListener('click', toggleNav);
	}

/***/ },
/* 2 */
/***/ function(module, exports) {

	"use strict";

	Object.defineProperty(exports, "__esModule", {
	  value: true
	});
	exports.default = ["dev", "about_us.html", "blog-notebook-asus.html", "blog.html", "cart.html", "catalog.html", "contacts.html", "cooperation.html", "enter-registration.html", "faq.html", "forgot-password.html", "index.html", "order-is-processed.html", "our-service-apple-iphone-iphone6.html", "our-service-smartphones-sony.html", "our-services-apple-iphone.html", "our-services-apple.html", "our-services.html", "page_not_found.html", "personal-area-login.html", "personal-area-orders-2.html", "personal-area-orders.html", "personal-area.html", "product-card.html", "reviews.html", "searching-results.html", "vacancies.html"];

/***/ },
/* 3 */
/***/ function(module, exports) {

	'use strict';

	Object.defineProperty(exports, "__esModule", {
	  value: true
	});
	exports.main = main;
	function main() {
	  var dropDownItems = $('.nav').find('li');
	  var dropDownImage = $('.nav-holder').find('.image-box');
	  $(dropDownItems).on('mouseover', function () {
	    $(dropDownImage).children().attr('src', $(this).attr('data-img'));
	  });
	  $(dropDownItems).on('mouseout', function () {
	    $(dropDownImage).children().removeAttr('src', $(this).attr('data-img'));
	  });

	  $('.nav-link').click(function () {
	    $('.hidden-menu').removeClass('active');
	    $('.nav-more').removeClass('active');
	    $('.hidden-card').removeClass('active');
	    $('.card-box').removeClass('active');
	    $('.nav-holder').toggleClass('active');
	    $('.nav-link').toggleClass('active');
	  });
	  $('.nav-holder, .nav-link').click(function (e) {
	    e.stopPropagation();
	  });
	  $('body').click(function () {
	    $('.nav-holder').removeClass('active');
	  });

	  $('.mobile-opener').click(function () {
	    $('.nav-blog-box').toggle();
	  });
	  if ($(window).width() <= 1279) {
	    $('.box-nav-menu').appendTo('.menu-box');
	    $('.menu-box').css("padding-top", "100px");
	  }
	  $(window).resize(function () {
	    if ($(window).width() <= 1279) {
	      $('.box-nav-menu').appendTo('.menu-box');
	      $('.menu-box').css("padding-top", "100px");
	    }
	  });
	  if ($(window).width() > 1279) {
	    $('.box-nav-menu').appendTo('.box-nav');
	    $('.menu-box').css("padding-top", "200px");
	  }
	  $(window).resize(function () {
	    if ($(window).width() > 1279) {
	      $('.box-nav-menu').appendTo('.box-nav');
	      $('.menu-box').css("padding-top", "200px");
	    }
	  });

	  $('.line').click(function () {
	    $('.tile-catalog').addClass('line-catalog');
	    $(this).addClass('active');
	    $('.tile').removeClass('active');
	  });
	  $('.tile').click(function () {
	    $('.tile-catalog').removeClass('line-catalog');
	    $(this).addClass('active');
	    $('.line').removeClass('active');
	  });

	  $('.nav-more, .hidden-menu-overlay, .menu-close').click(function (e) {
	    e.stopPropagation();
	    $('.nav-link').removeClass('active');
	    $('.nav-holder').removeClass('active');
	    $('.hidden-card').removeClass('active');
	    $('.card-box').removeClass('active');
	    $('.hidden-menu').toggleClass('active');
	    $('.nav-more').toggleClass('active');
	  });
	  $('.hidden-menu').click(function (e) {
	    e.stopPropagation();
	  });
	  $('body').click(function () {
	    $('.hidden-menu').removeClass('active');
	    $('.nav-more').removeClass('active');
	  });

	  if ($(window).width() < 1250) {
	    $('.language > ul > li > span').click(function () {
	      $('.language ul ul').toggle();
	    });
	  }

	  // $('.item-buy, .hidden-item-close, .continue-shopping, .hidden-item-overlay').click(function() {
	  //   $('.hidden-item').toggle();
	  // });

	  jcf.replaceAll();
	}

/***/ },
/* 4 */
/***/ function(module, exports) {

	'use strict';

	Object.defineProperty(exports, "__esModule", {
		value: true
	});
	exports.initAccordion = initAccordion;
	function initAccordion() {
		if ($(window).width() < 1250) {
			jQuery('.nav').slideAccordion({
				activeClass: 'active-link',
				opener: '> .parent > a',
				slider: '> .parent > ul',
				animSpeed: 300
			});
		}
	}

/***/ }
/******/ ]);
//# sourceMappingURL=app.js.map