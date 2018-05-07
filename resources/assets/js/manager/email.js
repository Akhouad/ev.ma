require('../bootstrap');
require('../trumbowyg.min');
require('../trumbowyg_fr.min');

window.Vue = require('vue');
const app = new Vue({
    el: "#email",
    data: {
        add_campaign: false
    },
    methods: {
        addCampaign(e){
            e.preventDefault()
            this.add_campaign = true
            let self = this
            setTimeout( function(){ 
                self.initEditor()
            }, 1 )
        },

        initEditor(){
            let self = this
            $('.editor').trumbowyg({
                btns:[
                    ['viewHTML'],
                    ['undo', 'redo'], // Only supported in Blink browsers
                    ['formatting'],
                    ['strong', 'em', 'del'],
                    ['superscript', 'subscript'],
                    ['link'],
                    ['insertImage'],
                    ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
                    ['unorderedList', 'orderedList'],
                    ['horizontalRule'],
                ],     
                lang: 'fr'
            }).on('tbwblur', function(){ 
                self.$refs.message.value = $('.editor').trumbowyg('html')
            });
        },

        editCampaign(id, event){
            event.preventDefault()
            this.add_campaign = true
            let self = this

            let data = {
                name: this.$refs['c-name-' + id].value,
                subject: this.$refs['c-subject-' + id].value,
                message: this.$refs['c-message-' + id].value,
                send_to: this.$refs['c-to-' + id].value,
                event_id: this.$refs['c-event-' + id].value,
                organizer_id: this.$refs['c-organizer-' + id].value,
                user_id: this.$refs['c-user-' + id].value
            }
            setTimeout( function(){ 
                self.initEditor()
                self.$refs.campaign_id.value = id
                self.$refs.name.value = data.name
                self.$refs.subject.value = data.subject
                self.$refs.send_to.value = data.send_to
                self.$refs.message.value = data.message
                self.$refs.event_id.value = data.event_id
                self.$refs.organizer_id.value = data.organizer_id
                self.$refs.user_id.value = data.user_id
                self.$refs.editor_message.innerHTML = data.message
            }, 1 )
        }
    }
})