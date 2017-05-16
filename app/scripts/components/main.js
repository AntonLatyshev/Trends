export function main() {
  var dropDownItems = $('.nav').find('li');
  var dropDownImage = $('.nav-holder').find('.image-box');
  $(dropDownItems).on('mouseover', function() {
    $(dropDownImage).children().attr('src', $(this).attr('data-img'));
  });
  $(dropDownItems).on('mouseout', function() {
    $(dropDownImage).children().removeAttr('src', $(this).attr('data-img'));
  });

  $('.nav-link').click(function() {
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

  $('.mobile-opener').click(function() {
    $('.nav-blog-box').toggle();
  });
  if ($(window).width() <= 1279) {
    $('.box-nav-menu').appendTo('.menu-box');
    $('.menu-box').css("padding-top" , "100px");
  }
  $(window).resize(function () {
    if ($(window).width() <= 1279) {
      $('.box-nav-menu').appendTo('.menu-box');
      $('.menu-box').css("padding-top" , "100px");
    }
  });
  if ($(window).width() > 1279) {
    $('.box-nav-menu').appendTo('.box-nav');
    $('.menu-box').css("padding-top" , "200px");
  }
  $(window).resize(function () {
    if ($(window).width() > 1279) {
      $('.box-nav-menu').appendTo('.box-nav');
      $('.menu-box').css("padding-top" , "200px");
    }
  });

  $('.line').click(function(){
    $('.tile-catalog').addClass('line-catalog');
    $(this).addClass('active');
    $('.tile').removeClass('active');
  });
  $('.tile').click(function(){
    $('.tile-catalog').removeClass('line-catalog');
    $(this).addClass('active');
    $('.line').removeClass('active');
  });

  $('.nav-more, .hidden-menu-overlay, .menu-close').click(function(e) {
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
  })
  $('body').click(function () {
      $('.hidden-menu').removeClass('active');
      $('.nav-more').removeClass('active');
  });


  if ($(window).width() < 1250) {
    $('.language > ul > li > span').click(function() {
      $('.language ul ul').toggle();
    });
  }

  // $('.item-buy, .hidden-item-close, .continue-shopping, .hidden-item-overlay').click(function() {
  //   $('.hidden-item').toggle();
  // });

  jcf.replaceAll();

}
