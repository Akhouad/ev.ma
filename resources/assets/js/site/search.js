var moment = require('../moment.js');

Vue.component('users-sidebar', require('../components/UsersSidebar.vue'));
const app = new Vue({
    el: "#search",
    data: {
        search_type: 'event',
        users: []
    },
    methods: {
        toggle_search_type(type, event){
            this.search_type = type
  
            setTimeout(function(){
                Vue.nextTick(function () {})
            }, 100)
        }
    }
})

$(document).ready(function(){
    $(".radio-search").on("click", function(e){
        let name = $(this).find('input[type=radio]').attr("name")
        $("[name=" + name + "]").parents(".radio-search").removeClass("active")
        $(this).toggleClass("active")
        $(this).find("input[type=radio]").prop("checked", $(this).hasClass("active"))
        let type = $(this).data('type')

        app.toggle_search_type(type)
        if(type == 'event'){
            setTimeout(function(){ $('.selectpicker').selectpicker(); }, 10)
        }
        $('input.datetimepicker').singleDatePicker();
    })

    $('input.datetimepicker').singleDatePicker();
})
$.fn.singleDatePicker = function() {
    $(this).on("apply.daterangepicker", function(e, picker) {
      picker.element.val(picker.startDate.format('DD-MM-YYYY'));
    });
    return $(this).daterangepicker({
      singleDatePicker: true,
      autoUpdateInput: false
    });
};