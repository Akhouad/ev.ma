<template>
    <div class="row" style="width:100%;margin:0">
        <div class="col-md-3" v-for="index in 7" v-if="events.length == 0">
            <event-skeleton :index="index" />
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
    export default {
        data(){
            return{
                events: []
            }
        },
        methods:{
            getEvents(){
                axios.get('/api/events').then(events => {
                    this.events = events.data
                    this.events.forEach(e => e.start_timestamp = this.formatDate(new Date(e.start_timestamp)))
                    
                    setTimeout(function(){$('[data-toggle="tooltip"]').tooltip()}, 100)
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