<?php
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format";
    }
   
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    if ($password !== $confirm_password) {
        $errors['password'] = "Passwords do not match";
    }

    if ($_FILES['profile_picture']['error'] !== UPLOAD_ERR_OK) {
        $errors['profile_picture'] = "Error uploading file";
    } else {
        $file_type = $_FILES['profile_picture']['type'];
        if ($file_type !== 'image/jpeg' && $file_type !== 'image/png') {
            $errors['profile_picture'] = "Invalid image";
        }
    }

    if (empty($errors)) {
        $upload_dir = 'uploads/';
        $file_name = basename($_FILES['profile_picture']['name']);
        $upload_path = $upload_dir . $file_name;

        if (!move_uploaded_file($_FILES['profile_picture']['tmp_name'], $upload_path)) {
            $errors['profile_picture'] = "Failed to move uploaded file";
        }

        // Prepare user data
        $data = [
            'name' => $_POST['name'],
            'email' => $email,
            'password' => $password,
            'room' => $_POST['room'],
            'ext' => $_POST['ext'],
            'profile_picture' => $upload_path 
        ];

        if (empty($errors)) {
            // Save user data to file
            file_put_contents('users.txt', json_encode($data) . PHP_EOL, FILE_APPEND);
    
            header("Location: login.php");
            exit;
        }
    } else {
        $error_query = http_build_query(['errors' => $errors]);
        header("Location: index.php?$error_query");
        exit;
    }
}
?>
