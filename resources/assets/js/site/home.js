Vue.component('event-skeleton', require('../components/EventSkeleton.vue'));
Vue.component('user-skeleton', require('../components/UserSkeleton.vue'));
var app = new Vue({
    el: "#app",
    data: {
        events: [],
        users: []
    },
    methods: {
        getEvents(){
            axios.get('/api/events').then(events => {
                this.events = events.data
                this.events.forEach(e => e.start_timestamp = this.formatDate(new Date(e.start_timestamp)))
                
                setTimeout(function(){$('[data-toggle="tooltip"]').tooltip()}, 100)
                console.log(this.events)
            })
        },
        formatDate(date) {
            var monthNames = [
              "Janvier", "Février", "Mars", "Avril", "Mai", "Juin", 
              "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Decembre"
            ];
          
            var day = date.getDate();
            var monthIndex = date.getMonth();
            var year = date.getFullYear();
          
            return (day + ' ' + monthNames[monthIndex] + ' ' + year)
                    .split(' ')
                    .splice(0, (day + ' ' + monthNames[monthIndex] + ' ' + year).split(' ').length - 1)
                    .join(' ');
        },
        getUsers(){
            axios.get('/api/users/city/' + this.$refs.city.value + '/5').then(users => {
                this.users = users.data
            })
        }
    },
    mounted(){
        this.getEvents()
        this.getUsers()
    }
})