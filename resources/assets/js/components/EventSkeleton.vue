<template>
    <div class="event-skeleton" ref="el">
        <div class="image-part"></div>
        <div class="text-part"></div>
        <div class="small-text-part"></div>
        <div class="small-text-part"></div>
        <div class="button-part"></div>
    </div>
</template>
<script>
export default {
    props: ['index'],
    mounted(){
        this.$refs.el.style.animationDelay = this.index * 100 / 1000 + 's'
    }
}
</script>
<style lang="scss" scoped>
@keyframes fade{
    0%  { opacity:1 }
    50% { opacity: 0.5 }
    100%{ opacity: 1 }
}
.event-skeleton{
    margin-bottom:20px;
    animation: infinite fade 1s ease-in-out;

    *{ background-color: rgba(black, .05); border-radius:3px }

    * + *{ margin-top:10px }

    .image-part{
        height: 100px;
        width:100%;
    }

    .text-part{
        height: 30px;
        width:80%;
    }

    .small-text-part{
        height: 10px;
        width:50%;
    }

    .button-part{
        height: 30px;
        width:100%;
        margin-top:30px;
    }
}
</style>

