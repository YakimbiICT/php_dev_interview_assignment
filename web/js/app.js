(function ($) {
    
    AppView = Backbone.View.extend({
        el: $("body"),
        initialize: function(){
        },        
        events: {
            "click .is-favorite-true":   "setIsFavoriteTrue",
            "click .is-favorite-false":  "setIsFavoriteFalse"
        },
        setIsFavoriteTrue: function (el) {
            this.setIsFavorite(el, true);
        },
        setIsFavoriteFalse: function (el) {
            this.setIsFavorite(el, false);
        },
        setIsFavorite: function (el, isFavorite) {
            var id = $(el.srcElement).parents('[data-id]').attr('data-id');
            var url = '?r=/image/'+id;
            var data = JSON.stringify({isFavorite: isFavorite});
            $.ajax({
                url: url,
                data: data,
                dataType: 'text',
                type: 'POST',
                error: function(data) {
                    $['.flash-msg']
                        .addClass('error')
                        .html('Communication errors. Please retry later');
                },
                success: function (data) {
                    var el = $('[data-id="'+data.id+'"]');
                    var a = el.find('a[data-action="setIsFavorite"]');
                    if (data.isFavorite) {
                        a.replaceWith(_.template($("#is-favorite-true").html(),{}));                    
                    } else {
                        a.replaceWith(_.template($("#is-favorite-false").html(),{}));                    
                    } 
                }
            });
            return false;
        }
        
    });
    
    var appview = new AppView;

})(jQuery);