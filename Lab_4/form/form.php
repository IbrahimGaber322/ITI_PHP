<?php
$errors = [];
$old_data = [];

if (isset($_GET['errors'])) {
    $errors = json_decode($_GET['errors'], true);
}

if (isset($_GET['old_data'])) {
    $old_data = json_decode($_GET['old_data'], true);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="form.css">
</head>
<body>
    <div class="container">
        <h2>Register</h2>

        <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>
        
         <form class="mt-3" method="post" action="handleuploaded.php" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="Name" value="<?php echo $old_data['name'] ?? ''; ?>">
            </div>
            
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $old_data['email'] ?? ''; ?>">
                <?php if (!empty($errors['email'])) echo "<div class='text-danger'>{$errors['email']}</div>"; ?>
            </div>
            
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            
            <div class="form-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" class="form-control" id="confirm_password" name="confirmPassword">
            </div>
            
            <div class="form-group">
                <label for="room">Room No:</label>
                <select class="form-control" id="room" name="app">
                    <option value="application1" <?php echo isset($old_data['Room_no']) && $old_data['Room_no'] == 'application1' ? 'selected' : ''; ?>>Application 1</option>
                    <option value="application2" <?php echo isset($old_data['Room_no']) && $old_data['Room_no'] == 'application2' ? 'selected' : ''; ?>>Application 2</option>
                    <option value="cloud" <?php echo isset($old_data['Room_no']) && $old_data['Room_no'] == 'cloud' ? 'selected' : ''; ?>>Cloud</option>
                </select>
                <?php if (!empty($errors['app'])) echo "<div class='text-danger'>{$errors['app']}</div>"; ?>
            </div>
            
            <div class="form-group">
                <label for="ext">Ext:</label>
                <input type="text" class="form-control" id="ext" name="ext">
            </div>
            
            <div class="form-group">
                <label for="profile_picture">Profile Picture:</label>
                <input type="file" class="form-control-file" id="profile_picture" name="image" accept="image/*">
            </div>
            
            <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </form>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
