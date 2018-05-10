window.$ = window.jQuery = require('jquery');

(function($){
    return{
        init(){
            let self = this // do not remove ready function
            $(document).ready(function(){
                self.toggle_sidebar_nav()
                self.toggle_mobile_nav()
            })
        },
        toggle_mobile_nav(){
            $(".mobile-menu").on("click", function(){
                $(this).parent().find(".header-nav").stop().slideToggle(200)
            })
        },
        toggle_sidebar_nav(){
            $('.sidebar_mobile_menu').on("click", function(){
                $(this).parent().find('ul').stop().slideToggle(200)
            })
        }
    }.init()
})(jQuery);