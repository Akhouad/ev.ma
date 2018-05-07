window.$ = window.jQuery = require('jquery');

(function($){
    return{
        init(){
            let self = this
            $(document).ready(function(){
                self.toggle_sidebar_nav()
            })
        },
        toggle_sidebar_nav(){
            $('.sidebar_mobile_menu').on("click", function(){
                $(this).parent().find('ul').toggleClass('active')
            })
        }
    }.init()
})(jQuery);