require('../bootstrap');
window.Vue = require('vue');

const app = new Vue({
    el: "#images",
    data: {
        deleting_files: [],
        files: []
    },
    methods: {
        add_deleting_file(id, checked){
            if(!checked) {
                this.deleting_files.forEach( (f, index) => {if(id == f) this.deleting_files.splice(index, 1) } )
                this.$refs.deleting_files.value = this.deleting_files.join(',')
                return
            }

            if(!this.deleting_files.includes(id)){
                this.deleting_files.push(id)
                this.$refs.deleting_files.value = this.deleting_files.join(',')
            } 
        },
        fileChosen(event){
            document.querySelector('.plus').classList.add('filled')

            for(let i = 0 ; i < event.target.files.length ; i++){
                if( !this.files.includes(event.target.files[i].name) ) 
                    this.files.push(event.target.files[i].name)
            }
        },
        resetFiles(event){
            let filled = event.target.classList.contains('filled')
            if( filled ){
                this.$refs.file_input.value = null
                this.files = []
                event.target.classList.remove('filled')
            }
        }
    }
})

$(".checkbox-fn").on("click", function(event){
    $(this).toggleClass("checked")
    $(this).find("input[type='checkbox']").prop("checked", $(this).hasClass("checked"))
    
    let checked = $(this).find("input[type='checkbox']").prop("checked")
    app.add_deleting_file($(this).data('id'), checked)
})

$('[data-toggle="tooltip"]').tooltip()