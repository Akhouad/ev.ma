require('../bootstrap');
var moment = require('../moment.js');
require('../daterangepicker');
var tagsInput = require('../tags-input');

window.Vue = require('vue');

const app = new Vue({
    el: '#app',
    data: {
        dateFixe: true,
        eventRecurrent: false,
        eventType: 'Quotidien',
        joursSemaine: false,
        tags: '',
        tagsList: [],
        showMap: false,
        city_id: -1,
        allowSearch: true,
        venue: '',
        venues: [],
        addNewPlace: false,
        suggestedVenues: [],
        addNewUser: false,
        suggestedUsers: []
        // venue_data: {city_lat: '', city_lng: '', venue_lat: '', venue_lng: '', venue_id: '', foursquare_id: ''}
    },
    methods: {
        toggleEvents(e){
            e.preventDefault()
            let self = this
            
            if(!this.eventRecurrent){
                document.querySelector("input[name='start_date']").value = ""
                document.querySelector("input[name='start_time']").value = ""
                document.querySelector("input[name='end_date']").value = ""
                document.querySelector("input[name='end_time']").value = ""
            }
            else{
                if(self.eventType == 'Hebdomadaire'){
                    document.querySelector("select[name='recurrent[weekly][day]']").value = ""
                }
                else if(self.eventType == 'Mensuel'){
                    if(!self.joursSemaine){
                        document.querySelector("input[name='recurrent[monthly][day_number]']").value = ""
                    }
                    else{
                        document.querySelector("input[name='recurrent[monthly][week_number]']").value = ""
                        document.querySelector("input[name='recurrent[monthly][day]']").value = ""
                    }
                }
                
                document.querySelector("input[name='recurrent[time][from]']").value = ""
                document.querySelector("input[name='recurrent[time][to]']").value = ""
                document.querySelector("input[name='recurrent[date][from]']").value = ""
                document.querySelector("input[name='recurrent[date][to]']").value = ""
                document.querySelector("[name*=recurrent]").value= null
            }

            setTimeout(function(){
                self.dateFixe = !self.dateFixe
                self.eventRecurrent = !self.eventRecurrent   
                
                Vue.nextTick(function () {
                    self.initDateTimePicker()
                })
            }, 100)
        },
        initDateTimePicker(){
            $('input.datetimepicker').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true
            }, function(start, end, label) {
                var years = moment().diff(start, 'years');
            });
        },
        eventTypeChanged(){
            console.log(this.eventType)
        },
        toggleJoursSemaine(e){
            e.preventDefault()
            if(!this.joursSemaine){
                $("body").find("input[name='recurrent[monthly][day_number]']").value = null
            }
            else{
                $("body").find("input[name='recurrent[monthly][week_number]']").value = null
                $("body").find("input[name='recurrent[monthly][day]']").value = null
            }
            let self = this
            setTimeout(function(){ self.joursSemaine = !self.joursSemaine }, 100)
        },
        cityChanged(){
            this.resetVenueInputs()
            document.querySelector("input[name='venue[name]']").value = ""
        },
        searchVenues: _.debounce(function(){
            this.venue = document.querySelector("input[name='venue[name]']").value
            this.city_id = document.querySelector("select[name='venue[city_id]']").value
            if(this.city_id == -1) return
            
            this.suggestedVenues = []
            if(this.venue.length == 0){ 
                if(this.addNewPlace) this.addNewPlace = false
                return 
            }
            
            axios.get("/manager/venues/" + this.city_id).then(data => {
                this.venues = data['data']
                this.venues.forEach((v) => {
                    if(v['name'].toLowerCase().startsWith(this.venue.toLowerCase())){
                        let exists = false
                        this.suggestedVenues.forEach((sv) => { if(sv.id == v.id) exists = true })
                        if(!exists) this.suggestedVenues.push(v)
                    }
                });
                if(this.suggestedVenues.length == 0) this.addNewPlace = true
            })
        }, 500),
        chooseSuggestedVenue(index){
            document.querySelector("input[name='city[lat]']").value = this.suggestedVenues[index]['city_lat']
            document.querySelector("input[name='city[lng]']").value = this.suggestedVenues[index]['city_lng']
            document.querySelector("input[name='venue[lat]']").value = this.suggestedVenues[index]['lat']
            document.querySelector("input[name='venue[lng]']").value = this.suggestedVenues[index]['lng']
            document.querySelector("input[name='venue[id]']").value = this.suggestedVenues[index]['id']
            document.querySelector("input[name='venue[foursquare_id]']").value = this.suggestedVenues[index]['foursquare_id']
            document.querySelector("input[name='venue[adress_1]']").value = this.suggestedVenues[index]['adress_1']
            document.querySelector("input[name='venue[name]']").value = this.suggestedVenues[index]['name']

            this.suggestedVenues = []
            this.addNewPlace = false
        },
        resetVenueInputs(){
            document.querySelector("input[name='city[lat]']").value = ""
            document.querySelector("input[name='city[lng]']").value = ""
            document.querySelector("input[name='venue[lat]']").value = ""
            document.querySelector("input[name='venue[lng]']").value = ""
            document.querySelector("input[name='venue[id]']").value = ""
            document.querySelector("input[name='venue[foursquare_id]']").value = ""
        },
        addPlace(){
            this.resetVenueInputs()
            this.suggestedVenues = []
            this.addNewPlace = false
            this.showMap = true
        },
        searchUsers: _.debounce(function(){
            let current_user_id = document.querySelector("input[name='current_user_id']").value
            let key = document.querySelector("input[name='user[name]']").value
            axios.get('/manager/users/' + current_user_id + '/' + key ).then(users => {
                this.suggestedUsers = users.data
                if(this.suggestedUsers.length == 0) this.addNewUser = true
            })
        }, 500),
        chooseSuggestedUser(index){
            document.querySelector("input[name='user[name]']").value = this.suggestedUsers[index]['fullname']
            document.querySelector("input[name='user[id]']").value = this.suggestedUsers[index]['id']
            this.suggestedUsers = []
        },
        addIntervenant(e){
            e.preventDefault()
            let event_id = document.querySelector("input[name='event_id']").value
            let data = {
                user_id: document.querySelector("input[name='user[id]']").value
            }
            axios.post('/api/add-intervenant/' + event_id, data).then(data => {
                console.log(data)
            })
        }
    },
    created(){              
        if(document.querySelector("input[name='venue[name]']") !== null)
            this.venue = document.querySelector("input[name='venue[name]']").value

        if(document.querySelector('.event_options') !== null 
            && document.querySelector('.event_options').value !== 'null'){ 
            this.dateFixe = false
            this.eventRecurrent = true
            let recurrent = JSON.parse(document.querySelector('.event_options').value)
            this.eventType = (recurrent.type == "monthly") ? "Mensuel" : (recurrent.type == "weekly") ? "Hebdomadaire" : "Quotidien"
            if(this.eventType == "Mensuel"){
                this.joursSemaine = (recurrent.monthly_type == "week_number") ? true : false
            }
            console.log(recurrent)
        }

    }
});

$(".checkbox-fn").on("click", function(){
    $(this).toggleClass("checked")
    $(this).find("input[type='checkbox']").prop("checked", $(this).hasClass("checked"))
})

$(function() {
    $('input.datetimepicker').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true
    }, function(start, end, label) {
        var years = moment().diff(start, 'years');
    });
    
    tagsInput(document.querySelector('input[type="tags"]'));

    if($("#map").length){
        function updateMarkerPositionTxt(latLng) {
            document.querySelector("input[name='venue[lat]']").value = latLng.lat()
            document.querySelector("input[name='venue[lng]']").value = latLng.lng()
        }
        
        function initialize(lat, lnt) {
          var latLng = new google.maps.LatLng(lat, lnt);
          var map = new google.maps.Map(document.getElementById('map'), {
              zoom: 5,
              center: latLng,
              mapTypeId: google.maps.MapTypeId.ROADMAP
          });
          var marker = new google.maps.Marker({
              position: latLng,
              title: 'Draggable Marker',
              map: map,
              draggable: true
          });
          
          updateMarkerPositionTxt(latLng);
         
          google.maps.event.addListener(marker, 'dragend', function() {
              updateMarkerPositionTxt(marker.getPosition());
          });
        }
        
        if($("#map").attr("data-lat") !== undefined){
            google.maps.event.addDomListener(window, 'load', initialize($("#map").data("lat"), $("#map").data("lng")));
        }else{
            // moroccan map
            google.maps.event.addDomListener(window, 'load', initialize(31.7917, -7.0926));
        }

        $(document).on("click", ".suggested_venue", function(){
            initialize($(this).data("lat"), $(this).data("lng"))
        })
    }
});