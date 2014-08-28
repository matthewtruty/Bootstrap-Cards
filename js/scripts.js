generate_cards_init();
$(document).ready(function(){

});

function delete_card(card_id, card_num, last_card){
    var deleteCard = confirm('Are you sure you want to delete this card?');
    if(deleteCard){
        $('#card-' +card_num).addClass('animated bounceOutLeft');
        var delay=200;//1 seconds
        setTimeout(function(){
         $.post( "cards.php", {action:"delete",id:card_id}, function( data ) {
            generate_cards();
         });
         //your code to be executed after 1 seconds
         },delay);
    }
    else{
        return false;
    }
}

function add_card(){
    $.post( "cards.php", {action:"add"}, function( data ) {
        generate_cards();
    });
}

function generate_cards_init(){
    $('#card-container').removeClass('animated zoomIn');
    /*$('#card-container').html("Loading cards....");*/
    $.post( "cards.php", {action:"generate"}, function( data ) {
        $('#card-container').html(data);
        $('#card-container').addClass('animated zoomIn');
    });
}

function generate_cards(){
    $('#card-container').removeClass('animated zoomIn');
    $.post( "cards.php", {action:"generate"}, function( data ) {
        $('#card-container').html(data);
    });
}
