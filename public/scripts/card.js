"use strict";
$(function(){
  $('.card').on('click', '.toggle-fullscreen', function(e){
    var cards = $(this).parents('.card');
    var card = $(cards[0]);
    e.preventDefault();
    if(card.hasClass('card-fullscreen')) {
      card.removeClass('card-fullscreen');
    } else {
        card.addClass('card-fullscreen');
    }
    $(this).blur();
  });
  $('.card').on('click', '.toggle-collapse', function(e){
    var cards = $(this).parents('.card');
    var card = $(cards[0]);
    e.preventDefault();
    if(card.hasClass('card-collapsed')) {
      card.removeClass('card-collapsed');
    } else {
        card.addClass('card-collapsed');
    }
    $(this).blur();
  });


})
