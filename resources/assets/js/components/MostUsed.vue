<template>
    <div>
        <list-skeleton v-if="list.length == 0" v-for="index in 5" :index="index" />
        <ul class="sidebar-list">
            <li v-for="l of list">
                <a :href="'/' + type + '/' + l.slug">
                    {{l.name}}
                    <span>({{l.events.length}})</span>
                </a>
            </li>
            <li class="last">
                <a :href="'/categories#' + type">+ Voir Plus</a>
            </li>
        </ul>
    </div>
</template>

<script>
    import list_skeleton from './skeletons/ListSkeleton'
    export default {
        components:{
            'list-skeleton': list_skeleton
        },
        props: ['type'],
        data(){
            return{
                list: []
            }
        },
        methods: {
            getData(){
                axios.get('/'+ this.type +'/popular/5').then(data => {
                    this.list = data.data
                })
            }
        },
        created(){
            this.getData()
        }
    }
</script>

<style lang='scss'>

</style>