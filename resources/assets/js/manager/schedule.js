require('../bootstrap');
var moment = require('../moment.js');
require('../daterangepicker');

window.Vue = require('vue');
var app = new Vue({
    el: "#schedule",
    data: {
        formErrors: {
            date: {error: false, message: ''},
            heure: {error: false, message: ''},
            titre: {error: false, message: ''}
        }
    },
    methods: {
        addSchedule(e){
            e.preventDefault()
            
        }
    }
})

$(function() {
    $('input.datetimepicker').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true
    }, function(start, end, label) {
        var years = moment().diff(start, 'years');
    });
});