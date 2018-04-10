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
        searchUsers(){
            let current_user_id = document.querySelector("input[name='current_user_id']").value
            let key = document.querySelector("input[name='user[name]']").value
            if( key.length == 0 ) {this.suggestedUsers = []; this.add_new_intervenant = false; return;}
            this.users_loader = true
            axios.get('/api/users/' + current_user_id + '/' + key ).then(users => {
                this.users_loader = false
                this.suggestedUsers = users.data
                if(this.suggestedUsers.length == 0) this.add_new_intervenant = true
            })
        },
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
                user_id: document.querySelector("input[name='user[id]']").value
            }
            axios.post('/api/intervenants/' + this.event_id + '/add', data).then(data => {
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
            axios.delete('/api/intervenants/' + this.event_id + '/delete/' + this.intervenants[index]['user_id']).then(data => {
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
        axios.get('/api/intervenants/' + this.event_id + '/get').then(data => {
            this.fillIntervenants(data.data)
            this.show_loader = false
        })
    }
});