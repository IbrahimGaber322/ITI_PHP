
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
<?php
include "./PDO.php";

if(isset($_GET['id'])){
    $std_id = $_GET['id'];
    $old_data  = select_user($std_id);
}

?>
<div class="container">
    <h1> Update User </h1>
    <form action="handleuploaded.php" method="post" enctype="multipart/form-data">
      <div class="form-group">
          <label for="Name">Name:</label>
          <input type="text" class="form-control" id="Name" name="Name" value="<?php echo $old_data['name'] ?? ''; ?>">
        </div>

      <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" name="email" value="<?php echo $old_data['email'] ?? ''; ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" id="password" name="password" value="<?php echo $old_data['email'] ?? ''; ?>">
      </div>

      <div class="form-group">
        <label for="confirmPassword">Confirm Password:</label>
        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" value="">
      </div>

      <div class="form-group">
        <label for="app">Room No:</label>
        <select class="form-control" id="app" name="app">
          <option value="Application1" <?php echo ($old_data['Room_no'] ?? '') === 'Application1' ? 'selected' : ''; ?>>Application1</option>
          <option value="Application2" <?php echo ($old_data['Room_no'] ?? '') === 'Application2' ? 'selected' : ''; ?>>Application2</option>
          <option value="Cloud" <?php echo ($old_data['Room_no'] ?? '') === 'Cloud' ? 'selected' : ''; ?>>Cloud</option>
        </select>
      </div>

      <div class="form-group">
        <label for="ext">EXT:</label>
        <input type="text" class="form-control" id="ext" name="ext" value="<?php echo $old_data['EXT'] ?? ''; ?>">
      </div>

      <div class="mb-3">
            <label for="" class="form-label">Profile picture</label>
            <input type="file" name="image" class="form-control"  aria-describedby="emailHelp">
      </div>

      <button type="submit" class="btn btn-primary">Update</button>
      <input type="hidden" name="id" value="<?php echo $std_id; ?>">
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>