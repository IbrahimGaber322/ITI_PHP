
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome</title>
</head>

<body>
  <div class="container">
  <?php

include "../base.php";
include "./PDO.php";
include "./utils.php";

$errors = [];

function sanitize_input($input)
{
    $input = trim($input);
    $input = htmlspecialchars($input);
    return $input;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_FILES['image']['tmp_name'])){
        $filename = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $saved = move_uploaded_file($tmp_name, "images/{$filename}");
        $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif');
        $file_extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        if (!in_array($file_extension, $allowed_extensions)) {
            $errors['image'] = "Invalid file format. Only JPG, JPEG, PNG, and GIF files are allowed.";
        } else {
            $saved = move_uploaded_file($tmp_name, "images/{$filename}");
            // echo "<img  width='300' height='300' src='images/{$filename}'> ";
        }
    }else{
        $errors['image'] = "image is required";
    }
    if (empty($_POST["Name"])) {
        $errors['Name'] = "Name is required";
    } else {
        $Name = sanitize_input($_POST["Name"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $Name)) {
            $errors['Name'] = "Only letters and white space allowed";
        }
    }
    if (empty($_POST["email"])) {
        $errors['email'] = "Email is required";
    } else {
        $email = sanitize_input($_POST["email"]);
        // $pattern = "^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$";
        
        //////1//////
        // if (!preg_match($pattern, $email)) {
        //     $errors['email'] = "Invalid email format";
        // }

        //////2//////
        // preg_match_all($pattern, $email, $matches);

        // if (!empty($matches[0])) {
        //     // Email is valid
        //     return true;
        // } else {
        //     // Email is invalid
        //     return false;
        // }
        
         //////3//////
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Invalid email format";
        }
    }
    if (empty($_POST["app"])) {
        $errors['app'] = "Room No is required";
    } else {
        $app = sanitize_input($_POST["app"]);
    }
    $password = isset($_POST["password"]) ? $_POST["password"] : "";
    $confirmPassword = isset($_POST["confirmPassword"]) ? $_POST["confirmPassword"] : "";
    
    if (empty($password)) {
        $errors['password'] = "Password is required";
    } elseif ($password !== $confirmPassword) {
        $errors['confirmPassword'] = "Passwords do not match";
    }
    
    $password = sanitize_input($password);

    if (!empty($errors)) {
        $errors = json_encode($errors);
        header("Location: form.php?errors={$errors}");
        exit;
    } else {
        $pass = password_hash($password, PASSWORD_DEFAULT);
        $ext = $_POST["ext"];
        if($_POST["id"]){
            $pass = password_hash($password, PASSWORD_DEFAULT);
            $ext = $_POST["ext"];
            $id = $_POST["id"];
            update_user_prepared($id,$Name,$email,$pass,$app,$ext,$filename);
            header("Location:table.php");
        }else{

            insert_user_prepared($Name,$email,$pass,$app,$ext,$filename);
            header("Location:table.php");
        }
    }
} else {
            echo "Invalid request method.";
}

// select_students();

?>
  </div>
</body>

</html>



















