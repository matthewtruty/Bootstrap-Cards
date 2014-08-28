$('#card-container').hide();
generate_cards();
$(document).ready(function(){



});



function delete_card(card_id){


    var deleteCard = confirm('Are you sure you want to delete this card?');
    if(deleteCard){
    $.post( "cards.php", {action:"delete",id:card_id}, function( data ) {
        $('#card-container').hide();
        generate_cards();
    });
    }
    else{
        return false;
    }
}

function add_card(){
    $.post( "cards.php", {action:"add"}, function( data ) {
        $('#card-container').hide();
        generate_cards();
    });
}

function generate_cards(){
    $('#card-container').html("Loading cards....");
    $.post( "cards.php", {action:"generate"}, function( data ) {
         $('#card-container').html(data);
         $('#card-container').fadeIn(500);
    });


}
