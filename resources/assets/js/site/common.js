require('../bootstrap')
window.Vue = require('vue');
require('../vue-filters')


$(document).ready(function(){
    $(window).scroll(function(){
        if ($(this).scrollTop() >= 100) $("header.main-header").addClass('sticky-header');
        else $("header.main-header").removeClass('sticky-header');
    });

    $(".checkbox-fn").on("click", function(){
        $(this).toggleClass("checked")
        $(this).find("input[type='checkbox']").prop("checked", $(this).hasClass("checked"))
    })
})