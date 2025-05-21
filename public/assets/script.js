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
        setSliderSectionBg(img);
      });
    }
    $('#imageDisplay').css('background-image', 'url(' + slidesData[tabId][0] + ')');
    setSliderSectionBg(slidesData[tabId][0]);
  }

  function setSliderSectionBg(imgUrl) {
    const sliderSection = document.querySelector('.slider-section');
    if (window.innerWidth <= 900) {
      sliderSection.style.backgroundImage = imgUrl ? `url('${imgUrl}')` : '';
    } else {
      sliderSection.style.backgroundImage = '';
    }
  }

  function isMobile() {
    return window.innerWidth <= 900;
  }

  // Example: Call this function whenever the slide changes
  // setSliderSectionBg(currentImageUrl);

  // Also update on resize
  window.addEventListener('resize', function() {
    // Call with the current image URL
    setSliderSectionBg(currentImageUrl);
  });

  // Init first tab
  if (firstTabId) {
    initSlider(firstTabId);
    if (isMobile()) {
      $('.slider-' + firstTabId).addClass('active').show();
    } else {
      $('.slider-' + firstTabId).show();
    }
  }

  $('.tab-btn').on('click', function() {
    var tabId = $(this).data('tab');
    if (isMobile()) {
      // Accordion behavior
      if ($(this).hasClass('active')) {
        $(this).removeClass('active');
        $('.slider-' + tabId).removeClass('active');
        $('.slider-' + tabId).hide();
      } else {
        $('.tab-btn').removeClass('active');
        $(this).addClass('active');
        $('.slider-section .slider').removeClass('active').hide();
        $('.slider-' + tabId).addClass('active').show();
        initSlider(tabId);
      }
    } else {
      // Desktop behavior (original)
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
    }
  });
});