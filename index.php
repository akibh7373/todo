<?php 
    // connect to the database
    $db = mysqli_connect('localhost', 'root', '' , 'todo');
    if(isset($_POST['submit'])){
        $get_text = $_POST['task'];
        $get_number = $_POST['number'];
        if ($get_text === '' || $get_number === '') {
            die("You didn't submit any data. Please provide both name and number.");
        } else {
            // Insert both name and number into the same row
            $query = "INSERT INTO details (name, number) VALUES ('$get_text', '$get_number')";
            mysqli_query($db, $query);
            header('location: /');
        }
    }
    // Query for display all the data
    $getAllData = mysqli_query($db, 'SELECT * FROM details ORDER BY id ASC')
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo "To Do"; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="heading">
            <h2><a href="/">To Do App (PHP)</a></h2>
        </div>
        <form action="index.php" method="POST" class="mb-4">
            <input type="text" name="task" class="task_input mb-3 w-100" placeholder="Enter your task" >
            <input type="number" name="number" class="task_number mb-3 w-100" placeholder="Enter a number" >
            <button type="submit" class="add_btn btn btn-primary w-100" name="submit">Add Task</button>
        </form>
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Number</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_array($getAllData)) { ?>
                    <tr>
                        <td scope="row"><?php echo $row['id'] ?></td>
                        <td class="name"><?php echo $row['name'] ?></td>
                        <td class="number"><?php echo $row['number'] ?></td>
                        <td class="delete">
                            <a href="index.php?del_task=>?php echo $row='id';">x</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
