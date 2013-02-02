var loading = new loading_controller();
var random_data;

$(document).ready(function(){
   
    get_random();
   
    $('#get_random').click(function(e){
        e.preventDefault();
        get_random();
    });
});
  
/**
 * Delete Favorite Image
*/

function delete_it(id){
    if(confirm('Are You Sure ?')){
       loading.show();
   $.post('ajax.php',{
       action: 'favorite_del',
       id: id
    },function(){
        loading.hide();
      $('#img_li_'+id).hide();  
        });
       
        }
         return false;  
    }
 
/** 
* Edit Favorite image
*/

function edit_it(id){
   var p = prompt('Image Description',$('#img_'+id).attr('title'));
   loading.show();
   $.post('ajax.php',{
       action: 'favorite_edit',
       img_data: {
           id: id,
           description: p
           }
    },function(){
        loading.hide();
      $('#img_'+id).attr('title',p);  
        });
        return false;
    }
   
/** 
* Get Random Images 
*/

function get_random(){
    loading.show();
    $.post('ajax.php' , {
        action: 'get_random'
    },function(data){
        random_data = data;
      $('#random_div > ul ').html('');
        $.each(data,function(i,item){
          
            var img = $('<img />');
            $(img).attr({
                src : data[i].thumb,
                title: data[i].description
            }
        );
            
            var img_a = $('<a />').attr({
                href : data[i].url,
                target:'_blank'
            });
            
            $(img_a).append(img);
            
            var li = $('<li />');
            $(li).append(img_a);
        
            var favorite_it_btn =  $('<input />').attr({
                'type' : 'button',
                'value' : 'favorite it',
                'rel' : i
            }).addClass('favorite_it');
       
            $(li).append(favorite_it_btn);
        
            $('#random_div > ul').prepend(li);
        
        });
          
          
        $('.favorite_it').click(favorite_it_handler);
            
        loading.hide();
    },'json');
}

/**
 * Favorite butoon Handler
 */

function favorite_it_handler(){
    loading.show();
    var btn = $(this);
    $(this).attr('disabled','disabled');
   var i = $(btn).attr('rel');
      
    $.post('ajax.php' ,{
        action : 'favorite_it',
        img_data : random_data[i]
        },function(data){
       
        loading.hide();
        
        var img = $('<img />');
        $(img).attr({
            src : random_data[i].thumb,
            title: random_data[i].description,
            id: 'img_'+data
        });
        var li = $('<li />').attr('id','img_li_'+data);
       
        var btn_edit = $('<input />').attr({
            rel: data,
            type: 'button',
            value: 'Edit'
            }).addClass('edit_it');
          
           var btn_del = $('<input />').attr({
            rel: data,
            type: 'button',
            value: 'Delete'
            }).addClass('delete_it');
            
            
          $(btn_edit).click(function(e){
              e.preventDefault();
              edit_it(data);
              });
         
           $(btn_del).click(function(e){
              e.preventDefault();
              delete_it(data);
              });
              
              
         $(li).append(img);
          $(li).append(btn_edit);
            $(li).append(btn_del);
          
        $('#favorites_div > ul').prepend(li);
        
        $('#no_favorite').hide();
        $(btn).parent().hide();
    });
   
}

/**
 * loading image controller
 */
function loading_controller() {

    this.show = function(){
        
        $('#loading').css('top',getScrollTop()+'px').css('display','inline');
    }

    this.hide = function(){
        $('#loading').css('display','none');
    }
}

function getScrollTop() {

    if (typeof window.pageYOffset !== 'undefined' ) {
        // Most browsers
        return window.pageYOffset;
    }

    var d = document.documentElement; //IE with doctype

    if (d.clientHeight) {
        // IE in standards mode
        return d.scrollTop;
    }

    // IE in quirks mode
    return document.body.scrollTop;

}