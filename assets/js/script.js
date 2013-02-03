/**
 *
 *  This script will handle picture clicking events for adding,
 *  editing and deleting favorites via AJAX.
 *
 */

url = "http://127.0.0.1/Imact/http/favorite/";

function notice(context, msg, fContext){
	$("span.info", context).html(msg).show(400).delay(3000).fadeOut(400);

	if(fContext == true) elParent.delay(3000).fadeOut(400);
}

function sense(state){

	$("a."+state).click(function(e){


		e.preventDefault(); //No default anchor click

		elParent = $(this).parent();
		id = $('input[name="id"]', elParent).val();


		//Values already initialised for easier understanding and known state
		//payload = { 'data': { "description": null, "title": null, "isFavorite": null ,  "isDel": null  } };

		payload = { };
		switch(state){
			case "add":
				payload.isFavorite = 1;
				type= "POST";
				break;
			case "edit":
				id = $('input[name="id"]', elParent.parent()).val();
				payload.description = $('textarea[name="description"]', elParent).val();
				payload.title = $('textarea[name="title"]', elParent).val();
				type= "POST";
				break;
			case "delete":
				payload.isDel = 1;
				type= "DELETE";
				break;
		}

		action = url+state+'/'+id;

		$.ajax({
			type: type,
			url: action,
			data: payload,
			dataType: 'json'
			}).done(function(data) {

				if(data.success == true){
					if(state=='add'){
						notice(elParent, "Added", true);
					}else if(state=='edit'){
						notice(elParent, "Updated");
					}else if(state=='delete'){
						notice(elParent, "Deleted", true);
					}
				}else{
					notice(elParent, "Failed");
				}
			});
	});
}

sense('add');
sense('edit');
sense('delete');