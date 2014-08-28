
<?php
include "db.php";
/**
 * Created by PhpStorm.
 * User: mtruty
 * Date: 8/28/14
 * Time: 11:47 AM
 */


if($_POST['action'] == "delete"){
    $db_connection = mysqli_connect(DB_H, DB_U, DB_P, DB_N);
    mysqli_query($db_connection,"DELETE FROM cards WHERE id='$_POST[id]'");
    mysqli_close($db_connection);
}
elseif($_POST['action'] == "add"){
    $db_connection = mysqli_connect(DB_H, DB_U, DB_P, DB_N);
    mysqli_query($db_connection,"INSERT INTO cards (title, body)
VALUES ('New Card Title', 'Etiam imperdiet imperdiet orci. Phasellus consectetuer vestibulum elit. Pellentesque egestas, neque sit amet convallis pulvinar, justo nulla eleifend augue, ac auctor orci leo non est.')");

    mysqli_close($db_connection);
}
elseif($_POST['action'] == "generate"){
    $db_connection = mysqli_connect(DB_H, DB_U, DB_P, DB_N);

// Check connection
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    $result = mysqli_query($db_connection,"SELECT * FROM cards");
    $cards_html = "";
    $count = 0;

    /* determine number of rows result set */
    $row_cnt = mysqli_num_rows($result);
    if($row_cnt == 0){
        echo "<h1>No cards to load!</h1>";
    }
    else{
        while($row = mysqli_fetch_array($result)) {
        $cards_html .=<<<CARDS_HTML
<div class="col-md-3" style="padding: 5px 5px;">
                <div id="card-{$count}" class="card">
<div class="pull-right card-icons">
  <div class="btn-group"><span class="glyphicon glyphicon-cog"></span></div>
  <div class="btn-group ">
      <a href="ajax.php?item={$row['id']}" class="simple-ajax-popup">
       <span class="glyphicon glyphicon-resize-full">
       </span>
       </a>
   </div>
  <div class="btn-group"><span onclick="delete_card({$row['id']})" class="glyphicon glyphicon-remove"></span></div>
  </div>
 <a href="ajax.php?item={$row['id']}" class="simple-ajax-popup">                <img src="http://placehold.it/350x150/4AA248/ffffff" /></a>
                {$row['title']}
                <p style="text-decoration:none;">
                {$row['body']}
                 </p>

</div>
</div>

CARDS_HTML;

$count++;
    }
    }
    mysqli_close($db_connection);
    echo $cards_html;
}
else{

}
