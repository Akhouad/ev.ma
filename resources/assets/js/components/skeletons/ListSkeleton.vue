<template>
    <div class="user-skeleton" ref="el">
        <div class="left-part"></div>
        <div class="right-part"></div>
    </div>
</template>
<script>
export default {
    props: ['index'],
    mounted(){
        this.$refs.el.style.animationDelay = this.index * 100 / 1000 + 's'
        this.$refs.el.children[0].style.width = this.index * 20 + 'px'
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
    margin-top:10px;
    animation: infinite fade 1s ease-in-out;

    *{ background-color: rgba(black, .05); border-radius:3px }

    .left-part{
        min-width:50px!important;
        height:20px;
        display:inline-block;
    }

    .right-part{
        float: right;
        width:20px;
        height:20px;
    }
}
</style>

