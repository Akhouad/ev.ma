window.Vue = require('vue');

const app = new Vue({
    el: "#comments",
    data:{
        comments: []
    },
    methods: {
        checkComment(comment_id, checked){
            if(!checked){
                this.comments.forEach( (c, index) => {if(comment_id == c) this.comments.splice(index, 1) } )
                return
            }

            let exists = false
            this.comments.forEach( c => {if(comment_id == c) exists = true} )
            if(!exists){ this.comments.push(comment_id) }
            this.$refs.comments_ids.value = this.comments.join(",")
        },
        handleCheck(comment_id, event){
            this.checkComment(comment_id, event)
        }
    },
    created(){
    }
})

$(".comment .checkbox-fn").on("click", function(e){
    $(this).toggleClass("checked")
    $(this).find("input[type='checkbox']").prop("checked", $(this).hasClass("checked"))
    $(this).parents('.comment').toggleClass('checked')
    
    let ref = $(this).find("input:checkbox").data("id"),
        checked = $(this).find("input[type='checkbox']").prop("checked")
    app.checkComment(ref, checked)
})
