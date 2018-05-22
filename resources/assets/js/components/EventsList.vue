<template>
    <div class="row" style="width:100%;margin:0">
        <div class="col-md-3" v-for="index in 7" v-if="events.length == 0 && !empty_list">
            <event-skeleton :index="index" />
        </div>
        <div class="col-md-12" v-if="events.length == 0 && empty_list" style="text-align:center;padding:50px">
            Aucun èvènement trouvè.
        </div>
        <div class="col-md-3" v-for="e in events" v-if="events.length > 0" v-cloak>
            <div class="event-block">
                <a :href="'/ev/' + e.slug + '/' + e.id">
                    <div class="event-image">
                        <img :src="'/storage/images/manager/events/' + e.cover" alt="">
                    </div>
                    <div class="event-info">
                        <p class="event-name" data-toggle="tooltip" data-placement="bottom" :title="e.name" v-if="e.name.length >= 40">
                            {{e.name | truncate(40)}}
                        </p>
                        <p class="event-name" v-if="e.name.length < 40">{{e.name | truncate(40)}}</p>
                        <p class="event-date">
                            <i class="fa fa-calendar"></i>
                            {{e.start_timestamp}}
                        </p>
                        <p class="event-location">
                            <i class="fa fa-map-marker primary-color-text"></i>
                            {{e.city}}
                        </p>
                    </div>
                </a>
                <a href="" class="event-button">Ajouter à mon calendrier</a>
            </div>
        </div>
    </div>
</template>

<script>
    import event_skeleton from './skeletons/EventSkeleton'

    export default {
        components:{
            'event-skeleton': event_skeleton
        },
        props: ['type'],
        data(){
            return{
                events: [],
                empty_list: false
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
                let link = (this.type == undefined) ? '/events' : '/events/' + this.type
                axios.get(link).then(events => {
                    this.events = events.data
                    this.events.forEach(e => e.start_timestamp = this.formatDate(new Date(e.start_timestamp)))
                    if(events.data.length == 0) this.empty_list = true
                    setTimeout(function(){ $('[data-toggle="tooltip"]').tooltip() }, 10)
                })   
            }
        },
        created(){
            this.getEvents()
        },
        watch: {
            type(newVal, oldVal) { 
                console.log('Prop changed: ', newVal, ' | was: ', oldVal)
                this.empty_list = false
                this.events = []
                this.getEvents()
            }
        }
    }
</script>

<style lang='scss'>

</style>