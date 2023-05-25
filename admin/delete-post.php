<?php
require 'config/database.php'; 


if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    //fetch user from database in order to delete thumb from img folder
    $query = "SELECT * FROM posts WHERE id=$id";
    $result = mysqli_query($connection, $query);

    // make sure only 1 record/post was fetched
    if (mysqli_num_rows($result) == 1){
        $post = mysqli_fetch_assoc($result);
        $thumb_name = $post['thumb'];
        $thumb_des_path = '../img/' . $thumb_name;

        
        if ($thumb_des_path) {
           unlink($thumb_des_path);
           
           // delete user from database
            $delete_user_query = "DELETE FROM posts WHERE id=$id LIMIT 1";
            $delete_user_result = mysqli_query($connection, $delete_user_query);

            if(!mysqli_errno($connection)) {
                $_SESSION['delete-post-success'] = "post deleted successfully";
            }
        }
    }
}

header('location: ' . ROOT_URL . 'admin/');
die();

?>
