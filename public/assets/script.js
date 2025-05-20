$(function(){
  function initSlider(tabId) {
    var selector = '.slider-' + tabId;
    if(!$(selector).hasClass('slick-initialized')) {
      $(selector).slick({
        arrows: true,
        dots: true,
        infinite: false,
        adaptiveHeight: false,
      }).on('afterChange', function(event, slick, currentSlide){
        var img = slidesData[tabId][currentSlide];
        $('#imageDisplay').css('background-image', 'url(' + img + ')');
      });
    }
    $('#imageDisplay').css('background-image', 'url(' + slidesData[tabId][0] + ')');
  }

  // Init first tab
  if (firstTabId) {
    initSlider(firstTabId);
  }

  $('.tab-btn').on('click', function() {
    var tabId = $(this).data('tab');
    $('.tab-btn').removeClass('active');
    $(this).addClass('active');
    $('.slider-section .slider').hide();
    $('.slider-' + tabId).show();
    $('.slider-section .slider').not('.slider-' + tabId).each(function(){
      if($(this).hasClass('slick-initialized')) {
        $(this).slick('unslick');
      }
    });
    initSlider(tabId);
  });
});