generate_cards_init();
$(document).ready(function(){

});

function delete_card(card_id, card_num, last_card){
    var deleteCard = confirm('Are you sure you want to delete this card?');
    if(deleteCard){
        $('#row-' +card_num).addClass('red animated bounceOutLeft');
        var delay=200;//1 seconds
        setTimeout(function(){
            $.post( "cards.php", {action:"delete",id:card_id}, function( data ) {
                generate_cards("delete");
            });
            //your code to be executed after 1 seconds
        },delay);
    }
    else{
        return false;
    }
}

function add_card(){
    $.post( "rows.php", {action:"add"}, function( data ) {
        generate_cards("add");
    });
}
function add_row(){
    var formElement = document.getElementById("add_new_row");
    var formData = new FormData(formElement);
    console.log(formData);
    alert("h" + formData);
}


function generate_cards_init(){
    $('#table-container').removeClass('animated zoomIn');
    /*$('#card-container').html("Loading cards....");*/
    $.post( "rows.php", {action:"generate"}, function( data ) {
        $('#table-container').html(data);
    });
}
function generate_cards(action){
    $('#table-container').removeClass('animated zoomIn');
    /*$('#card-container').html("Loading cards....");*/
    $.post( "rows.php", {action:"generate"}, function( data ) {
        $('#table-container').html(data);
    });
}

