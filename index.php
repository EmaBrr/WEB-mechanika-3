<?php
    include("./functions.php");

    if(isset($_GET['update'])){
        $animal = find($_GET['update']);
    }

    if (isset($_POST['update']))  {
        echo "kazkas";
        update();
        header("location:./");
        die;
    }

    if(isset($_POST['delete'])){
        destroy();
        header("location:./");
        die;
    }

    if (isset($_POST['create'])) {
        store();
        header("location:./");
        die;
    };

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <title>Lentelė</title>
</head>
<body>
    <br>
    <form action="" method="post">
        <label for="">Species: </label>
        <input type="text" name="species" value=<?=(isset($animal)) ? $animal['species'] :""?>>
        <label for="">Name: </label>
        <input type="text" name="name"  value=<?=(isset($animal)) ? $animal['name'] :""?>>
        <label for="">Age: </label>
        <input type="text" name="age"  value=<?=(isset($animal)) ? $animal['age'] :""?>>
        <?php 
        if (isset($animal)) {
            echo '<button class = "btn btn-primary" type="submit" name = "update" value="'. $animal['id'] .'"  >Atnaujinti</button>';
        }
        else {
            echo '<button class = "btn btn-info" type="submit" name = "create" >Įrašom kažką</button>';
        }
        ?>
        <!-- <button type="submit">Įrašom kažką</button> -->
    </form>
    <br>
    <table class="table">
        <tr>
            <th>ID</th>
            <th>Species</th>
            <th>Name</th>
            <th>Age</th>
            <th>Edit</th>
            <th>Delete</th>
    </tr>
    
    
    <?php
    foreach (getData() as $animal) {
        echo '<tr>';
            echo '<td>' . $animal['id'] . '</td>';
            echo '<td>' . $animal['species'] . '</td>';
            echo '<td>' . $animal['name'] . '</td>';
            echo '<td>' . $animal['age'] . '</td>';
            echo '<td> 
                        <form action="" method="get">
                            <button type="submit" class = "btn btn-primary" name = "update" value="'. $animal['id'] .'">Redaguoti</button>
                        </form>
                   </td>';
            echo '<td> 
                        <form action="" method="post">
                            <button type="submit" class = "btn btn-danger" name = "delete" value="'. $animal['id'] .'">Ištrinti</button>
                        </form>
                  </td>';
        echo  '</tr>';  
     }
    ?>
    </table>
   
</body>
</html>