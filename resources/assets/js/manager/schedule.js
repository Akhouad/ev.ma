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
    }
})

$(function() {
    invalid_dates = $('.valid_dates').val().split('-');    
    $('input.datetimepicker').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        startDate: $('.valid_dates').val().split('-')[0],
        isInvalidDate: function(date) {
            return !(invalid_dates.indexOf(date.format('MM/DD/YYYY')) > -1);
        }
    }, function(start, end, label) {
        var years = moment().diff(start, 'years');
    });
});