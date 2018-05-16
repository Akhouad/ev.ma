Vue.component('event-skeleton', require('../components/EventSkeleton.vue'));
Vue.component('users-sidebar', require('../components/UsersSidebar.vue'));
Vue.component('events-list', require('../components/EventsList.vue'));
var app = new Vue({
    el: "#app",
    data: {
    },
    methods: {
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