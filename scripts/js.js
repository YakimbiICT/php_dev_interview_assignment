//jQuery(document).ready(function(){
$('.options').on('click','.like',function(){
    var id = $(this).attr('value');
    var image_title = $('#title_'+id).val();
    var image_url = $('#url_'+id).val();
    var imagethumb_url = $('#thumburl_'+id).val();
    var image_description = $('#description_'+id).val();
    $.ajax({
        url: base_url+'api.php',
        type: "GET",
        data: 'method=favourite&auth_key='+auth_key+'&user_id='+user_id+'&title='+image_title+'&url='+image_url+'&thumb='+imagethumb_url+'&description='+image_description+'&format=json',
        success: function(data) {
            var result = JSON.parse(data);
            if(result.head.status=='1'){
                alert('Image favourited successfully.');
                $('#options_'+id).html('<div class="liked" value="'+result.body.id+'" id="liked_'+result.body.id+'"><img src="scripts/images/liked.png" width="20px" height="20px" title="Click to Un-favourite"></div><div class="remove_description" value="'+result.body.id+'" id="remove_description_'+result.body.id+'"></div><div class="description" value="'+result.body.id+'" id="description_'+result.body.id+'"><img src="scripts/images/description.png" width="20px" height="20px" title="Add Description"></div><div class="image_description" id="image_description_'+result.body.id+'" title=""></div><input type="hidden" id="title_'+result.body.id+'" name="title_'+result.body.id+'" value=""></input><input type="hidden" id="url_'+result.body.id+'" name="url_'+result.body.id+'" value=""></input><input type="hidden" id="thumburl_'+result.body.id+'" name="thumburl_'+result.body.id+'" value=""></input><input type="hidden" id="description_'+result.body.id+'" name="description_'+result.body.id+'" value=""></input>');
                $('#options_'+id).attr('id','options_'+result.body.id);
                $('#li_'+id).attr('id','li_'+result.body.id);
            }else{
                alert('Like failed. Please try agian.');
            }
        },
        error:function (jqXHR){
            alert('Like failed. Please try agian.');
        }
    });
        
});
    
$('.options').on('click','.liked',function(){
    var conf = confirm('Are you sure you want to Un-favourite this image?');
    if(conf){
        var id = $(this).attr('value');
        $.ajax({
            url: base_url+'api.php',
            type: "GET",
            data: 'method=unfavourite&auth_key='+auth_key+'&id='+id+'&format=json',
            success: function(data) {
                var result = JSON.parse(data);
                if(result.head.status=='1'){
                    $('#li_'+id).fadeOut('slow', function() {
                        $('#li_'+id).remove();
                    });
                }else{
                    alert('Un-favourite failed. Please try agian.');
                }
            },
            error:function (jqXHR){
                alert('Un-favourite failed. Please try agian.');
            }
        });
    }else{
        return false;
    }
});
    
$('.options').on('click','.favourite',function(){
    var conf = confirm('Are you sure you want to Un-favourite this image?');
    if(conf){
        var id = $(this).attr('value');
        $.ajax({
            url: base_url+'api.php',
            type: "GET",
            data: 'method=unfavourite&auth_key='+auth_key+'&id='+id+'&format=json',
            success: function(data) {
                var result = JSON.parse(data);
                if(result.head.status=='1'){
                    $('#li_'+id).fadeOut('slow', function() {
                        $('#li_'+id).remove();
                    });
                }else{
                    alert('Un-favourite failed. Please try agian.');
                }
            },
            error:function (jqXHR){
                alert('Un-favourite failed. Please try agian.');
            }
        });
    }else{
        return false;
    }
});

$('.options').on('click','.remove_description',function(){
    var conf = confirm('Are you sure you want to remove the description of this image?');
    if(conf){
        var id = $(this).attr('value');
        $.ajax({
            url: base_url+'api.php',
            type: "GET",
            data: 'method=removedescription&auth_key='+auth_key+'&id='+id+'&format=json',
            success: function(data) {
                var result = JSON.parse(data);
                if(result.head.status=='1'){
                    $('#description_'+id+' img').attr('title','Click to add description');
                    $('#description_'+id).attr('class','description');
                    $('#image_description_'+id).attr('title','');
                    $('#image_description_'+id).html('');
                    $('#description_'+id).html('<img width="20px" height="20px" src="scripts/images/description.png" title="Click to edit description">');
                    $('#remove_description_'+id).html('');
                }else{
                    alert('Un-favourite failed. Please try agian.');
                }
            },
            error:function (jqXHR){
                alert('Un-favourite failed. Please try agian.');
            }
        });
    }else{
        return false;
    }
});
    
$('.options').on('click','.description',function(){
    var id = $(this).attr('value'); 
    var current_description = $('#image_description_'+id).attr('title');
    $('#image_description_'+id).html('<textarea type="text" rows="3" class="textarea" id="image_description_input_'+id+'" name="image_description_input_'+id+'">'+current_description+'</textarea>');
    $('#description_'+id).replaceWith('<div id="description_'+id+'" value="'+id+'" class="description_save"><img width="20px" height="20px" title="Save description" src="scripts/images/save.png"></div>');
});


$('.options').on('click','.description_save',function(){
    var id = $(this).attr('value');
    var description = $('#image_description_input_'+id).val();
    if(description==''){
        alert('Please add the description.');
    }else{
    $.ajax({
            url: base_url+'api.php',
            type: "GET",
            data: 'method=updatedescription&auth_key='+auth_key+'&id='+id+'&description='+description+'&format=json',
            success: function(data) {
                var result = JSON.parse(data);
                if(result.head.status=='1'){
                    $('#image_description_input_'+id).remove();
                    $('#image_description_'+id).html(description);
                    $('#image_description_'+id).attr('title',description);
                    $('#description_'+id).attr('class','description');
                    $('#description_'+id).html('<img width="20px" height="20px" title="Click to edit description" src="scripts/images/description.png">');
                    $('#remove_description_'+id).html('<img width="20px" height="20px" title="Click to remove description" src="scripts/images/remove_description.png">');
                }else{
                    alert('Un-favourite failed. Please try agian.');
                }
            },
            error:function (jqXHR){
                alert('Un-favourite failed. Please try agian.');
            }
        });
    }
    
});

//});

