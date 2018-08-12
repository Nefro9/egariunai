"use strict";
$(function(){
  //Initialize Sidebar Switching
  $('.sidebar.sidebar-left').collpasibleSlider({
      toggleButtons:'.sidebar-toggle',
      hideButtons:'.sidebar-hide',
      gestures: true,
      closeOnClick: true

  });
  $('.sidebar.sidebar-right').collpasibleSlider({
      hideButtons:'.toggle-settings',
  });
  var scrollelements = document.querySelectorAll('.scroll');
  for(var i = 0; i< scrollelements.length; i++) {
    (function(element){
      var ps = new PerfectScrollbar(element, { suppressScrollX: true });
    })(scrollelements[i]);
  }

  var scrollelementsEnd = document.querySelectorAll('.scroll-end');
  for(var i = 0; i< scrollelementsEnd.length; i++) {
    (function(element){
      var ps = new PerfectScrollbar(element, { suppressScrollX: true });
      element.scrollTop = element.scrollHeight;
    })(scrollelementsEnd[i]);
  }



  // Initialize search toggle on topbar
  $('.topbar-search-toggle').on('click', function(){

    if($('.topbar-search').hasClass('collapsed')){

      $('.topbar-search').removeClass('collapsed');
      $('.topbar-search').focus();

    } else {
      $('.topbar-search').blur();
      $('.topbar-search').addClass('collapsed');
    }
  })


    // Initialize Tooltips

    $('[data-toggle="tooltip"]').tooltip();


    // Sidebar Nav Collapse
    $('.sidebar-left .sidebar-nav').CollapsibleMenu({autoDetectActive: true});


    // Initialize email sidebar
    $('.email-toggle').on('click', function(){
      $('.email-sidebar').toggleClass('expanded');
    })

})
