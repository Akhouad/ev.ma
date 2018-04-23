<template>
    <div class="user-skeleton" ref="el">
        <div class="image-part"></div>
        <div class="info-part">
            <div class="text-part"></div>
            <div class="text-part"></div>
        </div>
        <div class="buttons-part"></div>
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
.user-skeleton{
    margin-top:15px;
    animation: infinite fade 1s ease-in-out;

    *{ background-color: rgba(black, .05); border-radius:3px }

    .image-part{
        width:30px;
        height:30px;
        display:inline-block;
    }

    .info-part{
        width:calc(100% - 80px);
        display:inline-block;
        background-color: transparent;

        .text-part{
            height: 10px;
            margin-bottom:5px;
            
            &:first-child{ width:70% }
            &:last-child{ width:30% }
        }
    }

    .buttons-part{
        float: right;
        width:20px;
        height:20px;
    }
}
</style>

