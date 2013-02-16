// used to remember last clicked image id
var lastClickedImageId; // dont kill me, Im too global.

// builds image block used to present images - favorite or just random
function buildImageBlocks(jsonData, isFavorite) {
    var content = '';
    $.each(jsonData, function(key, val) {
        content += '<div class="imageBlock">';
        content += '<img id="' + val.id + '" src="' + val.url
                + '" alt="' + val.name + '" title="' + val.description + '"/>';
        if (isFavorite) {
            content += '<a class="removeFavorite">remove</a><br/>';
            content += '<a href="#descriptionPanel" class="addDescription">add description</a>';
        } else {
            content += '<a class="setFavorite">set favorite</a>';
        }
        content += '</div>';
    });
    return content;
}

// loads generated images from the server side
function loadRandomImages(data) {
    var imageBlock = buildImageBlocks(data, false);
    $("#randomStatus").hide();
    $('#randomList').append(imageBlock);
}

// loads favorite images from the server side
function loadFavoriteImages(data) {
    var imageBlock = buildImageBlocks(data, true);
    $("#favoriteStatus").hide();
    $('#favoriteList').append(imageBlock);
}

// send ajax request to the given url and tries to load received daata
function generateImages(ajaxPath) {
    $("#randomList").empty();
    $("#randomStatus").show().text("Loading new images...");
    $.getJSON(ajaxPath, loadRandomImages).fail(function () {
        $("#randomStatus").show().text("Error occurred while loading!");
    });
}

// close dialog, update image's description on client and on the server
function sendDescription(e){
    e.preventDefault();
    $.fancybox.close();

    $("img#" + lastClickedImageId).attr("title", $('#descriptionText').val());
    $.post("api/favorite/" + lastClickedImageId + "/description/add/", { 'text': $('#descriptionText').val() });
}

// bind events and load init data
function initDocument() {
    $("#flikrGenerate").click(function() { generateImages("api/flikr/") });
    $("#instagramGenerate").click(function() { generateImages("api/instagram/") });
    $('#descriptionForm').submit(sendDescription);
    $(".addDescription").fancybox();

    $.getJSON("api/favorite/", loadFavoriteImages).fail(
        function () {
            $("#randomStatus").show().text("Error occurred while loading favorite images!");
        });
    $.getJSON("api/", loadRandomImages);
}

// when clicked addDescription button - storage the clicked image id to use it in the future
$(document.body).on('click','a.addDescription', function(){
    var img = $(this).parent().find("img");
    lastClickedImageId = img.attr("id");
    $('#descriptionText').val(img.attr("title"));
});

// when clicked setFavorite link - remove from the random list and move to favorite list,
// decorate with favorite image specific links and send ajax request to the server
$(document.body).on('click','a.setFavorite', function() {
    var imageBlock = $(this).parent();
    imageBlock.appendTo('#favoriteList');
    imageBlock.find('a').attr('class', 'removeFavorite').text('remove');
    imageBlock.append('<br/><a href="#descriptionPanel" class="addDescription">add description</a>');
    $.getJSON("api/favorite/add/" + imageBlock.find("img").attr("id"));
});

// when clicked removeFavorite link - send ajax request to the server and remove block from the screen
$(document.body).on('click','a.removeFavorite', function() {
    $("#favoriteStatus").hide();
    var imageBlock = $(this).parent();
    $.getJSON("api/favorite/remove/" + imageBlock.find("img").attr("id"));
    imageBlock.remove();
});

// turn on link hover on IE6 and IE7
$(document.body).on('hover','a', function(){
    $(this).toggleClass('hover');
});

// initialize the document
$(document).ready(initDocument);