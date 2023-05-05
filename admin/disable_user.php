<?php
    include "../connect.php";
    
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];

        $sql_delete = "update users set activation = 2 where id ='$id' ";
        mysqli_query($conn, $sql_delete);

        ?>
            <script>
                location.href = "index.php";
            </script>
        <?php
    }
?>