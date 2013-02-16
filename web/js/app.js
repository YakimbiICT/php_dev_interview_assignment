(function ($) {
    
    AppView = Backbone.View.extend({
        el: $("body"),
        initialize: function(){
        },        
        events: {
            "click .is-favorite-true":     "setIsFavoriteFalse",
            "click .is-favorite-false":    "setIsFavoriteTrue",
            "click .description-false":    "insertDescription",
            "focusout input.description":  "saveDescription",
            "keypress input.description":  "saveDescription",
            "click .description-true":     "editDescription",
            "click .description-remove":   "removeDescription"
        },
        setIsFavoriteTrue: function (el) {
            var image = $(el.srcElement).parents('.image[data-id]');
            var id = image.attr('data-id');
            var url = image.find('img').attr('src');
            var link = image.find('a').attr('href');
            var data = JSON.stringify({id: id, url: url, link: link});
            $.ajax({
                url: '/api/v1/favorites/'+id,
                data: data,
                dataType: 'json',
                type: 'PUT',
                error: function(data) {
                    $['.flash-msg']
                        .addClass('error')
                        .html('Communication errors. Please retry later');
                },
                success: function (data) {
                    var image = $('[data-id="'+data.id+'"]');
                    var a = image.find('div[data-action="setIsFavorite"]');
                    a.replaceWith(_.template($("#is-favorite-true").html(),{}));                    
                }
            });
            return false;
        },
        setIsFavoriteFalse: function (el) {
            var image = $(el.srcElement).parents('.image[data-id]');
            var id = image.attr('data-id');
            $.ajax({
                url: '/api/v1/favorites/'+id,
                type: 'DELETE',
                error: function(data) {
                    $['.flash-msg']
                        .addClass('error')
                        .html('Communication errors. Please retry later');
                },
                success: function (data) {
                    var image = $('[data-id="'+data.id+'"]');
                    var a = image.find('div[data-action="setIsFavorite"]');
                    a.replaceWith(_.template($("#is-favorite-false").html(),{}));                    
                }
            });
            return false;
        },
        insertDescription: function (el) {
            var image = $(el.srcElement).parents('.image[data-id]');
            var id = image.attr('data-id');
            var div = image.find('div[data-action="setDescription"]');
            div.replaceWith(_.template($("#description-edit").html(),{description: ''}));
            image.find('input[name="description"]').focus();
            
            
            return false;
        },
        saveDescription: function (el) {
            if ( typeof event.which !== 'undefined' & (event.which != 13) ) {
                return;
            }
            var image = $(el.srcElement).parents('.image[data-id]');
            var id = image.attr('data-id');
            var description = image.find('input.description').val();
            var data = JSON.stringify({id: id, description: description});
            $.ajax({
                url: '/api/v1/favorites/'+id,
                data: data,
                dataType: 'json',
                type: 'PUT',
                error: function(data) {
                    $['.flash-msg']
                        .addClass('error')
                        .html('Communication errors. Please retry later');
                },
                success: function (data) {
                    var image = $('[data-id="'+data.id+'"]');
                    var div = image.find('div[data-action="setDescription"]');
                    if (data.description) {
                        div.replaceWith(_.template($("#description-true").html(),{description: description}));                    
                    } else {
                        div.replaceWith(_.template($("#description-false").html(),{}));                    
                    } 
                }
            });
            return false;
        },
        editDescription: function (el) {
            var image = $(el.srcElement).parents('.image[data-id]');
            var id = image.attr('data-id');
            var div = image.find('div[data-action="setDescription"]');
            var description = $.trim(div.find('a.description-true').text());
            div.replaceWith(_.template($("#description-edit").html(),{description: description}));  
            return false;
        },
        removeDescription: function (el) {
            var image = $(el.srcElement).parents('.image[data-id]');
            var id = image.attr('data-id');
            var data = JSON.stringify({id: id, description: ''});
            $.ajax({
                url: '/api/v1/favorites/'+id,
                data: data,
                dataType: 'json',
                type: 'PUT',
                error: function(data) {
                    $['.flash-msg']
                        .addClass('error')
                        .html('Communication errors. Please retry later');
                },
                success: function (data) {
                    var image = $('[data-id="'+data.id+'"]');
                    var div = image.find('div[data-action="setDescription"]');
                    if (data.description) {
                        div.replaceWith(_.template($("#description-true").html(),{description: description}));                    
                    } else {
                        div.replaceWith(_.template($("#description-false").html(),{}));                    
                    } 
                }
            });
            return false;
        }
        
    });
    
    var appview = new AppView;

})(jQuery);