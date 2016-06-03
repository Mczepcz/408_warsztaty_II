<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <ul class="nav nav-pills">
                     <li role="presentation"><a href='index.php'>Main Page</a></li>
                </ul>
                    
            </div>
            <h1>All registered users</h1>
            <?php

            session_start();
            require_once './src/User.php';
            require_once './src/Tweet.php';
            require_once './src/connection.php';
            $sql = "SELECT * FROM User";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                echo '<ul class="list-group">';
                while($row = $result->fetch_assoc()){
                    if($row['active']){
                        echo '<li>';
                        echo '<a href="user_page.php?id='.$row['id'].'">'.$row['full_name'].'</a>';
                        echo '</li>';    
                    }
                }
                echo '</ul>';
            }
            ?>
          
        </div>
    </body>
</html>
