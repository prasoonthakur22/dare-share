jQuery(document).ready(function ($) {
  'use strict'
  // Fly-Out Navigation
  $('.arya-fly-but-click').on('click', function () {
    $('#arya-fly-wrap').toggleClass('arya-fly-menu')
    $('#arya-fly-wrap').toggleClass('arya-fly-shadow')
    $('.arya-fly-but-wrap').toggleClass('arya-fly-open')
    $('.arya-fly-fade').toggleClass('arya-fly-fade-trans')
  })

  $('#overlay').on('click', function () {
    $('#arya-fly-wrap').toggleClass('arya-fly-menu')
    $('#arya-fly-wrap').toggleClass('arya-fly-shadow')
    $('.arya-fly-but-wrap').toggleClass('arya-fly-open')
    $('.arya-fly-fade').toggleClass('arya-fly-fade-trans')
  })
})



