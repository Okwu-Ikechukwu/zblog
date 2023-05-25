<?php
require 'config/database.php';

// make sure edit post button was clicked
if (isset($_POST['submit'])) {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $previous_thumb_name = filter_var($_POST['previous_thumb_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category_id = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
    $is_featured = filter_var($_POST['is-featured'], FILTER_SANITIZE_NUMBER_INT);
    $thumb = $_FILES['thumb'];


    // set is_featured to 0 if it was unchecked
    $is_featured = $is_featured == 1 ?: 0;

    // check and validate input values
    if(!$title) {
        $_SESSION['edit-post'] = "Couldn't update post. invalid form data on edit post page.";
    } elseif (!$category_id){
        $_SESSION['edit-post'] = "Couldn't update post. invalid form data on edit post page.";
    } elseif (!$body){
        $_SESSION['edit-post'] = "Couldn't update post. invalid form data on edit post page.";
    } else {
        // delete existing thumb if new thumb is available
        if ($thumb['name']) {
            $previous_thumb_path = '../img/' . $previous_thumb_name;
            if ($previous_thumb_path) {
                unlink($previous_thumb_path);
            }

            // work on new thumb
            // rename image
            $time = time(); //make each image name unique using current timestamp
            $thumb_name = $time . $thumb['name'];
            $thumb_tmp_name = $thumb['tmp_name'];
            $thumb_des_path = '../img/' . $thumb_name;

             // make sure file is an image
            $allowed_files = ['png', 'jpg', 'jpeg'];
            $extension = explode('.', $thumb_name);
            $extension = end($extension);
            if (in_array($extension, $allowed_files)) {
                // make sure img is not too large (2mb+)
                if($thumb['size'] < 2_000_000){
                    // upload avatar
                    move_uploaded_file($thumb_tmp_name, $thumb_des_path);
                } else{
                    $_SESSION['edit-post'] = "File size too big. should be less than 2mb";
                }
            } else{
                $_SESSION['edit-post'] = "File should be png, jpg, jpeg";
            }
        }
    }

    // redirect back (with form data) to admin page if there is any prob
    if (isset($_SESSION['edit-post'])) {
        $_SESSION['edit-post-data'] = $_POST;
        header('location: ' . ROOT_URL . 'admin/');
        die();
    } else{
         // set is_featured of all posts to 0 if is_featured for this post is 1
         if ($is_featured == 1) {
            $zero_all_is_featured_query = "UPDATE posts SET is_featured=0";
            $zero_all_is_featured_result = mysqli_query($connection, $zero_all_is_featured_query);
        }

        // set thumb name if a new one was uploaded, else keep old thumb name
        $thumb_to_insert = $thumb_name ?? $previous_thumb_name;

        // update post database
        $query = "UPDATE posts SET title='$title', body='$body', thumbnail='$thumb_to_insert', category_id=$category_id, is_featured=$is_featured 
        WHERE id=$id LIMIT 1";
        $result = mysqli_query($connection, $query);
    }

    if (!mysqli_errno($connection)){
        $_SESSION['edit-post-success'] = "post updated successfully";
    }

}

header('location: ' . ROOT_URL . 'admin/');
die();
?>