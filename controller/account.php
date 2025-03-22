<?php

require_once 'model/users.php';
$user = new Users();

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = (empty($_POST['password'])) ? null : $_POST['password'];
    $mail = $_POST['email'];
    $fullname = $_POST['fullname'];



    #them code for CSRF
    $token = isset($_SESSION['edit_user_token']) ? $_SESSION['edit_user_token'] : "";
    if ($token && $_POST['token'] === $token) {
        // delete the record
       // remove token after successful delete
        
        $data = array(
            'password' => $password,
            'email' => $mail,
            'fullname' => $fullname,
            'avatar' => $avatar
        );
        $update = $user->update_user($data, $username);
        if ($update) {
            $msg = array("status" => true, "txt" => "Cập nhật tài khoản thành công!");
        } else {
            $msg = array("status" => false, "txt" => "Có lỗi xảy ra!");
        }
            unset($_SESSION['edit_user_token']);
    } else {
             // log potential CSRF attack.
    }
    ####


    #Nếu null thì không up ảnh
    $acceptMime = array("image/png", "image/jpeg", "image/gif", "image/bmp", "image/jpg");
    if ($_FILES["file"]["error"] > 0) {
        $avatar = null;
    } else {
        #kiểm tra MiME
        $mime = $_FILES['file']['type'];
        if (!in_array(strtolower($mime), $acceptMime)) {
            $avatar = null;
        } else {
            $avatar = $username . "/" . $_FILES["file"]["name"];
            move_uploaded_file($_FILES["file"]["tmp_name"], AVATAR_DIR . $avatar);    //AVATAR_DIR
        }
    }

    //Fixed

    // $acceptMime = array("image/png", "image/jpeg", "image/gif", "image/bmp", "image/jpg");

    // // Mở fileinfo để kiểm tra MIME type
    // $finfo = finfo_open(FILEINFO_MIME_TYPE);
    // $mime_type = finfo_file($finfo, $_FILES['file']['tmp_name']);
    // finfo_close($finfo); // Đóng fileinfo sau khi sử dụng
    
    // $filename = $_FILES["file"]["name"];
    // $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION)); // Lấy phần mở rộng tệp
    
    // if ($_FILES["file"]["error"] > 0) {
    //     $avatar = null;
    // } else {
    //     // Kiểm tra MIME type và phần mở rộng tệp
    //     if (!in_array($mime_type, $acceptMime, true) || !in_array($extension, ["png", "jpeg", "jpg", "gif", "bmp"])) {
    //         $avatar = null;
    //     } else {
    //         $avatar = $username . "/" . $_FILES["file"]["name"];
    //         if (!move_uploaded_file($_FILES["file"]["tmp_name"], AVATAR_DIR . $avatar)) {
    //             $avatar = null; // Đặt avatar thành null nếu việc di chuyển tệp thất bại
    //         }
    //     }
    // }
    

   #code chính
    // $data = array(
    //     'password' => $password,
    //     'email' => $mail,
    //     'fullname' => $fullname,
    //     'avatar' => $avatar
    // );
    // $update = $user->update_user($data, $username);
    // if ($update) {
    //     $msg = array("status" => true, "txt" => "Cập nhật tài khoản thành công!");
    // } else {
    //     $msg = array("status" => false, "txt" => "Có lỗi xảy ra!");
    // }

}
$u = $user->get_user(getUsername());
require_once 'view/account/account.php';
$user->connect_close();
?>
