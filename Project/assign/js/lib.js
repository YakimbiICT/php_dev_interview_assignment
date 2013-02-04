 $(document).ready(function(){ 
	 
	 $("#cmd_search").click(function(){
		 
		 var error = false;
		 var f = $("#search").val();
		 var keyword = $("#keyword").val();
		 
		 if(f == ""){
			 error = true;
		 }
		 if(keyword == ""){
			 error = true;
			
			 $('#keyword').animate({'background-color': '#ffe1e1'});
		     setTimeout(changeColor('#keyword'), 500);
		 }
		 
		 if(!error){
			  $("#gf").submit();
		 }
		
	 })
	 
	 

	 
	 $(".addtofav").click(function(){
		 var t = $(this).attr('t');
		 var r = $(this).attr('r');
		
		$(this).hide();
		$(this).attr("src", 'images/done.jpg');
		$(this).show();
		 var qrystr = '5gc3fcs=fav'+'&t='+t+'&r='+r;
		    $.ajax({
		        url: 'lib/ajax_service.php',
		        type: 'POST',
		        data: qrystr,
		        success: function(res){
		        	
		           
		        }
		  });
	 })
	 
	 
	  $(".delfav").click(function(){
		
		 var id = $(this).attr('id');
		
		$(this).parent('a').parent('p').parent('li').hide();
		
		 var qrystr = '5gc3fcs=del'+'&id='+id;
		    $.ajax({
		        url: 'lib/ajax_service.php',
		        type: 'POST',
		        data: qrystr,
		        success: function(res){
		        	
		           
		        }
		  });
	 })
	 
 });
 
 function changeColor(id){
	 $(id).animate({'background-color': '#ffffff'});
 }
 
 function altrtnplcy(id){
	    var wD = 400;
	    var hG = 195;
	    var lF=($(document).width()/2) - (wD/2);
	    var tP=($(document).height()/2) - (hG/2);
	    
	    var txt = $("#i_"+id).val();
	    
	    
	    
	    var ht = '<div id="popup_overlay"></div><div id="overlay_container" style="left:'+lF;
	    ht += 'px;top:'+tP+'px;width:'+wD+'px;height:'+hG+'px;">'
	    ht += '<div style="padding: 10px; text-align:center"><br /><span class="notice">Comment</span><p class="popup_text"> ';
	    ht += '<textarea row="5" cols="40" name="txt" class="txt" >'+txt+'</textarea> ';
	   
	    ht += '</p>';
	    ht += '<br/><br/><a href="javascript: void(0)" id="cmd_rnp_ok" style="background: #C49506; padding:4px 7px 3px 7px; border:0; text-decoration:none; color:#fff;">Submit</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
	    ht += '<a href="javascript: void(0)" id="cmd_rnp_cancel" style="background: #666; padding:4px 7px 3px 7px; border:0; text-decoration:none; color:#fff;">Close</a></div>';
	    ht += '</div>';
	    $("body").append(ht);
	           
	    $("#cmd_rnp_ok").click(function(){	          	    	
	    		add_comment(id);	    		            
	    });

	    $("#cmd_rnp_cancel").click(clsrnppo);
	}
 
    function clsrnppo(){
	    $("#overlay_container").remove();
	    $("#popup_overlay").remove();
	}
    
    
   
    
    function add_comment(id)
    {
    	var id = id;
 	    var txt = $.trim($(".txt").val());
 	    if(id !="" ){
 	    	var qrystr = '5gc3fcs=add&id='+id+'&txt='+txt;
	    	$.ajax({
		        url: 'lib/ajax_service.php',
		        type: 'POST',
		        data: qrystr,
		        success: function(res){
		        	$("#i_"+id).val(txt);
		        	 clsrnppo();
			            $('html,body').animate({
			            	scrollTop: 0
			            	}, 1000);
		        	}
		    });
 	    	
 	    }
    	
    }
    
    