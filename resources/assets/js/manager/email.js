require('../bootstrap');
require('../trumbowyg.min');

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
                $('.editor').trumbowyg().on('tbwblur', function(){ 
                    self.$refs.message.value = $('.editor').trumbowyg('html')
                });
            }, 100 )
        },

        editCampaign(id, event){
            event.preventDefault()
            this.add_campaign = true
            let self = this
            setTimeout( function(){ 
                $('.editor').trumbowyg().on('tbwblur', function(){ 
                    self.$refs.message.value = $('.editor').trumbowyg('html')
                });
            }, 100 )

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
                self.$refs.campaign_id.value = id
                self.$refs.name.value = data.name
                self.$refs.subject.value = data.subject
                self.$refs.send_to.value = data.send_to
                self.$refs.message.value = data.message
                self.$refs.event_id.value = data.event_id
                self.$refs.organizer_id.value = data.organizer_id
                self.$refs.user_id.value = data.user_id
                self.$refs.editor_message.innerHTML = data.message
            }, 100 )
        }
    }
})