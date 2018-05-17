<template>
    <div>
        <div class="sidebar-heading">événements prés de vous</div>
        <user-skeleton v-if="events.length == 0" v-for="index in 5" :index="index" />
        <ul class="events-list green mt-2">
            <li v-for="e in events">
                <a :href="'/ev/' + e.slug + '/' + e.id">
                    <div class="event-date">
                        <div class="day">{{e.start_timestamp.split(' ')[0]}}</div>
                        <div class="month">{{e.start_timestamp.split(' ')[1].substring(0, 3)}}</div>
                    </div>
                    <div class="event-info">
                        <div class="event-name">{{e.name.substring(0, 25)}}{{(e.name.length > 25) ? '...' : ''}}</div>
                        <div class="event-location"><i class="fa fa-map-marker"></i> {{e.city}}</div>
                    </div>
                </a>
            </li>
        </ul>
    </div>
</template>

<script>
    import user_skeleton from "./skeletons/UserSkeleton"
    export default {
        components: {
            'user-skeleton': user_skeleton
        },
        props: ['city'],
        data(){
            return{
                events: []
            }
        },
        methods:{
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
            getEvents(){
                axios.get('/events/nearest/city/'+ this.city +'/5').then(data =>{
                    this.events = data.data
                    console.log(this.events)
                    this.events.forEach(e => {
                        if(e.option != null){
                            let parts = JSON.parse(e.option).date_from.split('/')
                            let date = parts[2] + '-' + parts[1] + '-' + parts[0] + " 00:00:00"
                            e.start_timestamp = this.formatDate(new Date(date))
                        }else{
                            e.start_timestamp = this.formatDate(new Date(e.start_timestamp))
                        }
                    })
                })
            }
        },
        created(){
            this.getEvents()
        }
    }
</script>

<style lang='scss'>

</style>