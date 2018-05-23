<template>
    <div class="row" style="width:100%;margin:0">
        <div class="col-md-3 col-sm-4 col-xs-6" v-for="index in 7" v-if="events.length == 0 && !empty_list">
            <event-skeleton :index="index" />
        </div>
        <div class="col-md-12" v-if="events.length == 0 && empty_list" style="text-align:center;padding:50px">
            <h6 class="paragraph-title centered">Aucun èvènement trouvè.</h6>
            <p>
                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                    viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve" width="200">
                    <polygon style="fill:#37bc9b;" points="225.697,24.265 225.697,193.566 368.849,287.773 512,313.69 512,120.125 "/>
                    <polygon style="fill:#26967a;" points="225.697,0 141.715,35.236 428.013,155.359 512,120.125 "/>
                    <polygon style="fill:#3fa5ca;" points="99.212,340.069 286.303,432.651 424.921,365.498 225.697,272.914 "/>
                    <polygon style="fill:#50c1e9;" points="225.697,297.18 237.83,245.373 225.697,193.566 0,288.261 65.643,364.334 "/>
                    <polygon style="fill:#309bc1;" points="388.523,365.498 512,313.69 225.697,193.566 225.697,297.18 "/>
                    <polygon style="fill:#309bc1;" points="0,288.261 0,391.875 286.303,512 310.568,460.193 286.303,408.386 "/>
                    <polygon style="fill:#5fbdde;" points="286.303,408.386 286.303,512 512,417.304 512,313.69 "/>
                </svg>
            </p>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-6" v-for="e in events" v-if="events.length > 0" v-cloak>
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
                this.type = newVal
                this.empty_list = false
                this.events = []
                this.getEvents()
            }
        }
    }
</script>

<style lang='scss'>

</style>