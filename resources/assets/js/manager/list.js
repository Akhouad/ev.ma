window.Vue = require('vue');
require('../bootstrap');

const app = new Vue({
    el: "#list",
    data: {
        items: [],
        show_collection: false
    },
    methods: {
        check_item(item, remove = false){
            if(!remove){
                if(!this.items.includes(item)) this.items.push(item)
            }
            else this.items.splice(this.items.indexOf(item), 1)
            this.$refs.events.value = this.items.join(',')
        },
        add_collection(){
            this.show_collection = true
        }
    }
})

$(".list-group .checkbox-fn").on('click', function(){
    $(this).parents('.list-group-item').toggleClass('checked')
    if(!$(this).hasClass('checked')) app.check_item($(this).find('input').val())
    else app.check_item($(this).find('input').val(), true)
})