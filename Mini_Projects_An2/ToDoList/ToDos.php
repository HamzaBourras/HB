<?php

session_start();
include("Tools.php"); 
// $_SESSION["data"] = $data;
if (!isset($_SESSION["data"])) {
      $_SESSION["data"] = $data;
}

        // ***** Inserer un noveau todo dans le tableau *********

    if(isset($_POST['userId']) && isset($_POST['Todos']) && isset($_POST['Completed']) && isset($_POST['add'])) {
      $userId = $_POST['userId'];
      $toDos = $_POST['Todos'];
      $completed = $_POST['Completed'];

      $taille = count($_SESSION["data"]);

      $_SESSION["data"][$taille+1]['userId'] = $userId;
      $_SESSION["data"][$taille+1]['todos'] = $toDos;
      $_SESSION["data"][$taille+1]['completed'] = $completed;

      
      
    }


         

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>ToDos</title>

</head>
<body>
    <div class="container">
    <h1>ToDos</h1>
    
    
    
    </div>

    <div class="container">
      <div class="row">
        <div class="col-sm  mx-2 border border-primary">

        <form action="ToDos.php" method="post">
          <div class="form-group">
            <label for="userid">UserId</label>
            <input type="text" name="userId" class="form-control" id="userid" placeholder="Number...." 
                value="<?php echo isset($_GET['UserId']) ? $_GET['UserId'] : ''; ?>">
          </div>

          <div class="form-group">
            <label for="todo">Todo</label>
            <input type="text" name="Todos" class="form-control" id="todo"  placeholder="Todos...."
                value="<?php echo isset($_GET['Todos']) ? $_GET['Todos'] : ''; ?>">
          </div>

          <div class="form-group">
            <label for="todo">Completed</label>
            <input type="text" name="Completed" class="form-control" id="completed"  placeholder="Completed...."
                value="<?php echo isset($_GET['Completed']) ? $_GET['Completed'] : ''; ?>">
          </div>
          
          <input type="submit" id="add" class="btn btn-primary" name="add"
                value="<?php echo isset($_GET['add']) ? $_GET['add'] : 'Add'; ?>">
        </form>
        
        <hr>
        <form >
          <div class="form-group">
            <label for="todoSearche">Todo Filter</label>
            <input type="text" class="form-control" id="todoSearche" placeholder="todo">
          </div>
          <div class="form-group">
            <label for="userSearche">User Filter</label>
            <input type="text" class="form-control" id="userSearche" placeholder="233">
          </div>
       </form>
        </div>
        <div class="col-sm-8  border border-primary" >
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">UserID</th>
                <th scope="col">Todo</th>
                <th scope="col">Completed</th>
                <th scope="col" colspan="2" >Actions</th>
              </tr>
            </thead>
            <tbody id="tb">
              <?php
              
              foreach($_SESSION["data"] as $id=>$d){ ?>
                <tr>
                  <td><?= $id ?></td>
                  <td><?= $d['userId'] ?></td>
                  <td><?= $d['todos'] ?></td>
                  <td><?php printf('<input type="checkbox" %s>', ($d['completed']==true) ? 'checked' : ''); ?></td>
                  <td><a href="edit.php?id=<?= $id ?>" class="btn btn-success">edit</a></td>
                  <td><a href="delete.php?id=<?= $id ?>" class="btn btn-danger">Delete</a></td>
                  
                </tr>
              <?php

              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <script>
    
    </script>
</body>
</html>