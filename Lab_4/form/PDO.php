<?php
include '../base.php';
require './connection_data.php';
// include './utils.php';


function insert_user_prepared($name, $email, $hashedPassword, $Room_no, $ext, $profile)
{
    try {
        $conn = connect_to_db_pdo();
        
        $inst_template = "INSERT INTO `users`.`user` (`name`, `email`, `password`, `Room_no`, `EXT`, `profile`) VALUES (?, ?, ?, ?, ?, ?)";
        
        $prepared_stmt = $conn->prepare($inst_template);
        
        $prepared_stmt->execute([$name, $email, $hashedPassword, $Room_no, $ext, $profile]);
        
        $inserted_id = $conn->lastInsertId();
        
        echo "<h4 style='color: green'>Student inserted successfully. ID: $inserted_id</h4>";

    } catch (PDOException $e) {
        echo "<h3 style='color: red'>{$e->getMessage()}</h3>";
    }
}
// insert_user_prepared("alaa", "pp@gmail.com", "14592", "Application", 22, "714OPSMZzwL._AC_SX679_.jpg");
function update_user_prepared($id, $name, $email, $hashedPassword, $Room_no, $ext, $profile)
{
    try {
        $conn = connect_to_db_pdo();
        
        $update_template = "UPDATE `users`.`user` SET `name` = ?, `email` = ?, `password` = ?, `Room_no` = ?, `EXT` = ?, `profile` = ? WHERE `id` = ?";
        
        $prepared_stmt = $conn->prepare($update_template);
        
        $res = $prepared_stmt->execute([$name, $email, $hashedPassword, $Room_no, $ext, $profile, $id]);
        
        if ($res && $prepared_stmt->rowCount() > 0) {
            echo "<h4 style='color: green'>User updated successfully</h4>";
        } else {
            echo "<h4 style='color: red'>User not updated</h4>";
        }

    } catch (PDOException $e) {
        echo "<h3 style='color: red'>{$e->getMessage()}</h3>";
    }
}

function delete_user_prepared($id)
{
    try {
        // var_dump("here");
        $conn = connect_to_db_pdo();
        // var_dump($conn);
        $delete_template = "DELETE FROM `users`.`user` WHERE `id` = ?";
        
        $prepared_stmt = $conn->prepare($delete_template);
        
        $res = $prepared_stmt->execute([$id]);
        
        if ($res) {
            header("Location:table.php");
        } else {
            echo "<h4 style='color: red'>User not deleted</h4>";
        }

    } catch (PDOException $e) {
        echo "<h3 style='color: red'>{error}</h3>";
    }
}
// delete_user_prepared(11);
function select_users()
{
    try {
        $conn = connect_to_db_pdo();
        
        $select_query = "SELECT * FROM `users`.`user`";
        
        $stmt= $conn->prepare($select_query); 
        $res= $stmt->execute();

        if($res){
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        display_in_table($rows);
        }
    } catch (PDOException $e) {
        echo "<h3 style='color: red'>{$e->getMessage()}</h3>";
    }
}
function select_user($id)
{
    try{
        $conn = connect_to_db_pdo();
        $data = "select * from `users`.`user` where id=$id";
        $stmt =  $conn->prepare($data);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
    }catch(PDOException $e){
        echo $e->getMessage();
    
    }
    return $data;
}

function display_in_table($rows){
    echo "<table class='table'>";
    echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Password</th><th>Room_No</th><th>EXT</th><th>Image</th><th>Edit</th><th>Delete</th></tr>";

    foreach ($rows as $row){
        echo "<tr>";
        $id = $row['id'];
        $delete_url = "delete_user.php?id={$id}";
        $edit_url = "update_user.php?id={$id}";
        foreach ($row as $key => $value){  
            if ($key === 'profile') { 
                echo "<td><img width='100' height='100' src='images/{$value}'></td>";
            } else {
                echo "<td>{$value}</td>";
            }
        }
        echo "<td><a href='{$edit_url}' class='btn btn-warning'>Edit</a></td>";
        echo "<td><a href='{$delete_url}' class='btn btn-danger'>Delete</a></td>";
        echo "</tr>";
    }
    echo "</table>";
}

?>