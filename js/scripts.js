
$(document).ready(function(){
    $('.simple-ajax-popup').magnificPopup({
        type:'ajax',
        mainClass: 'mfp-fade',
        overflowY: 'scroll', // as we know that popup content is tall we set scroll overflow by default to avoid jump
        midClick: true // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.
    });


    generate_cards();


});



function delete_card(card_id){


    var deleteCard = confirm('Are you sure you want to delete this card?');
    if(deleteCard){
    $.post( "cards.php", {action:"delete",id:card_id}, function( data ) {
        generate_cards();
    });
    }
    else{
        return false;
    }
}

function add_card(){
    alert();
    $.post( "cards.php", {action:"add"}, function( data ) {

        generate_cards();
    });
}

function generate_cards(){
    $('#card-container').html("Loading cards....");
    $.post( "cards.php", {action:"generate"}, function( data ) {
         $('#card-container').html(data);
    });


}
