<?php
 
$post_data['uname'] = 'uname';
$post_data['email'] = 'email';
$post_data['phone'] = 'phone';
$post_data['file'] = 'file';

foreach ( $post_data as $key => $value) {
    $post_items[] = $key . '=' . $value;
}
 

?>
