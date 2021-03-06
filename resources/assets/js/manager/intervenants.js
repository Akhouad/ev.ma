require('../bootstrap');
window.Vue = require('vue');

Vue.component('loader-component', require('../components/Loader.vue'));
const app = new Vue({
    el: '#app',
    data: {
        suggestedUsers: [],
        intervenants: [],
        event_id: -1,
        show_loader: false,
        users_loader: false,
        add_new_intervenant: false,
        add_new_intervenant_form: false
    },
    methods: {
        searchUsers: _.debounce(function () {
            let current_user_id = document.querySelector("input[name='current_user_id']").value
            let key = document.querySelector("input[name='user[name]']").value.trim()

            // return nothing when field is empty
            if( key.length == 0 ) {
                this.suggestedUsers = []; 
                this.add_new_intervenant = false; 
                return;
            }

            this.users_loader = true
            axios.get('/manager/users/' + current_user_id + '/' + key ).then(users => {
                this.users_loader = false
                this.suggestedUsers = users.data
                if(this.suggestedUsers.length == 0) this.add_new_intervenant = true
            })
        }, 500),
        chooseSuggestedUser(index){
            this.add_new_intervenant_form = false
            this.add_new_intervenant = false
            document.querySelector("input[name='user[name]']").value = this.suggestedUsers[index]['fullname']
            document.querySelector("input[name='user[id]']").value = this.suggestedUsers[index]['id']
            this.suggestedUsers = []
        },
        addIntervenant(e){
            e.preventDefault()
            this.show_loader = true
            let data = {
                user_id: document.querySelector("input[name='user[id]']").value,
                event_id: this.event_id
            }
            // /manager/intervenants
            axios.post('/manager/intervenants', data).then(data => {
                // console.log(data);return;
                this.show_loader = false
                this.fillIntervenants(data.data)
                document.querySelector("input[name='user[name]']").value = ""
                document.querySelector("input[name='user[id]']").value = ""
            })
        },
        addUser(){
            this.add_new_intervenant_form = true
            this.add_new_intervenant = false
            this.suggestedUsers = []
            setTimeout(function(){
                document.querySelector("input[name='fullname']").value = document.querySelector("input[name='user[name]']").value
                document.querySelector("input[name='user[name]']").value = ""
                document.querySelector("input[name='user[id]']").value = ""
            }, 100)
        },
        removeIntervenant(index){
            this.show_loader = true
            this.intervenants[index]['loader'] = true
            // /manager/event/22/intervenant/2/delete
            axios.delete('/manager/event/' + this.event_id + '/intervenants/' + this.intervenants[index]['user_id'] + '/delete').then(data => {
                this.show_loader = false
                this.fillIntervenants(data.data)
            })
        },
        fillIntervenants(data){
            this.intervenants = data
        }
    },
    created(){
        this.show_loader = true
        this.event_id = document.querySelector("input[name='event_id']").value
        // /manager/event/22/intervenants
        axios.get('/manager/event/' + this.event_id + '/intervenants').then(data => {
            this.fillIntervenants(data.data)
            this.show_loader = false
        })
    }
});