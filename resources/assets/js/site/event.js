require('../lightbox.min');
require('../rater.min');

(function($){
    return{
        init(){
            $('.collapse').collapse()
            this.initRater()
        },

        initRater(){
            $(".rating").rate();
            $(".rating").on("change", function(ev, data){
                $("input[name='rating']").val(data.to)
                $("body, html").animate({
                    scrollTop: $(".comment").offset().top - 100
                }, 1000, function(){
                    $(".comment textarea").focus()
                })
            });
        }
    }.init()
})(jQuery);