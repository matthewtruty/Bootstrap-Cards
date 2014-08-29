<?php
include "db.php";
/**
 * Created by PhpStorm.
 * User: mtruty
 * Date: 8/28/14
 * Time: 11:47 AM
 */


if($_POST['action'] == "delete"){
   // $db_connection = mysqli_connect(DB_H, DB_U, DB_P, DB_N);
   // mysqli_query($db_connection,"DELETE FROM cards WHERE id='$_POST[id]'");
   // mysqli_close($db_connection);
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

    $result = mysqli_query($db_connection,"SELECT * FROM table_data");
    $cards_html = "";
    $count = 0;

    /* determine number of rows result set */
    $row_cnt = mysqli_num_rows($result);
    if($row_cnt == 0){
        echo "<h1>No cards to load!</h1>";
    }
    else{


        $cards_html='<table class="table table-bordered">
        <thead>
        <tr>
            <th>#</th>
            <th>Image</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Content</th>
            <th>Ref #</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <form action="" id="table_row_data" method="post">
        ';




        while($row = mysqli_fetch_array($result)) {
            $cards_html .=<<<CARDS_HTML
            <tr id="row-{$count}">
                <td>{$row['id']}</td>
                <td><img src="{$row['image']}"/></td>
                <td>{$row['first_name']}</td>
                <td>{$row['last_name']}</td>
                <td>{$row['content']}</td>
                <td>{$row['ref_num']}</td>
                <td> <div class="pull-right card-icons">
                        <div class="btn-group">
                            <span onclick="delete_card({$row['id']},{$count},{$row_cnt})" class="glyphicon glyphicon-remove glyphicon-md"></span>
                        </div></td>
            </tr>
CARDS_HTML;

            $count++;
        }

        $new_row_id = $count + 1;
        $cards_html.=<<<HTML
            </form>
        <form action="" id="add_new_row">

        </form>
        <tr id="last-row">
        <td>{$new_row_id}</td>
        <td></td>
        <td> <input type="text" class="form-control" placeholder="First Name"></td>
        <td> <input type="text" class="form-control" placeholder="Last Name"></td>
        <td> <input type="text" class="form-control" placeholder="Content"></td>
        <td> <input type="text" class="form-control" placeholder="Ref #"></td>
        <td class="plus-col"><a href="#" onclick="add_row();"><span class="glyphicon glyphicon-plus glyphicon-md"></span></td></a>
        </tr>
        </tbody></table>
HTML;

    }
    mysqli_close($db_connection);
    echo $cards_html;
}
else{   }
