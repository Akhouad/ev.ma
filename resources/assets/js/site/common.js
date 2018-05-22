require('../bootstrap')
window.Vue = require('vue');
require('../vue-filters')
var moment = require('../moment.js');
require('../daterangepicker');
require('../bootstrap-select')

Vue.component('users-sidebar', require('../components/UsersSidebar.vue'));
Vue.component('events-list', require('../components/EventsList.vue'));
Vue.component('most-used', require('../components/MostUsed.vue'));
Vue.component('latest-events', require('../components/LatestEvents.vue'));
Vue.component('near-events', require('../components/NearEvents.vue'));

if($('#app').length){
    var app = new Vue({
        el: "#app",
        data: {
            events_type: undefined
        },
        methods:{
            toggle_event_type(type, e){
                e.preventDefault()
                document.querySelector('.filter-bar a.active').classList.remove('active')
                e.target.classList.add('active')
                this.events_type = type
            }
        }
    })
}

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