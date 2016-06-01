<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h1>All registered users</h1>
        <?php
        
        session_start();
        require_once './src/User.php';
        require_once './src/Tweet.php';
        require_once './src/connection.php';
        $sql = "SELECT * FROM User";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            echo '<ul>';
            while($row = $result->fetch_assoc()){
             
                echo '<li>';
                echo '<a href="user_page.php?id='.$row['id'].'">'.$row['full_name'].'</a>';
                echo '</li>';
            }
            echo '</ul>';
        }
        ?>
        <a href='index.php'>Main Page</a>
    </body>
</html>
