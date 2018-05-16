require('../bootstrap')
window.Vue = require('vue');
require('../vue-filters')
var moment = require('../moment.js');
require('../daterangepicker');
require('../bootstrap-select')

$(document).ready(function(){
    $(window).scroll(function(){
        if ($(this).scrollTop() >= 100) $("header.main-header").addClass('sticky-header');
        else $("header.main-header").removeClass('sticky-header');
    });

    $(".checkbox-fn").on("click", function(){
        $(this).toggleClass("checked")
        $(this).find("input[type='checkbox']").prop("checked", $(this).hasClass("checked"))
    })

    $(".radio-fn").on("click", function(){
        let name = $(this).find('input[type=radio]').attr("name")
        $("[name=" + name + "]").parents(".radio-fn").removeClass("active")
        $(this).toggleClass("active")
        $(this).find("input[type=radio]").prop("checked", $(this).hasClass("active"))
    })
})