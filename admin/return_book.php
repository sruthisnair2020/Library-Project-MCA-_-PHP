<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header("location:login.php");
    }
   
    $con = Mysqli_Connect("localhost","root","","library_management");
    if(!$con){
        echo "Connection error !";
    }

$result = mysqli_query($con, "SELECT * FROM book_issue where status=1");
?>
 
<html>
<head>    
    <title>book issue statements</title>
    <link href="library/table.css" type="text/css" rel="stylesheet">
    <style>
        .odd{
            background-color: lightgrey;
        }
        .even{
            background-color: white;
        }
        table{
            margin-top:3em;
        }
    </style>
</head>
 

<body>
    <table>
        <tr bgcolor='lightpink'>
            <td>Ref. NO</td>
            <td>User Name</td>
            <td>Book ID</td>
            <td>Issue Date</td>
            <td>Return Date</td>
            <td>Return</td>
        </tr>
        <?php 
            $i = 0;
        while($res = mysqli_fetch_array($result)) {         
            if($i % 2 != 0){
                $classes = "odd";
            }
            else{
                $classes = "even";
            }
            echo "<tr class=".$classes.">";
            echo "<td>".$res['no']."</td>";
            echo "<td>".$res['user_name']."</td>";
            echo "<td>".$res['book_id']."</td>";    
            echo "<td>".$res['issue_date']."</td>";
            echo "<td>".$res['return_date']."</td>"; 
            echo "<td><a href=\"return_form.php?id=$res[no]\">Edit</a>";        
            $i++;
        }
        ?>
    </table>
</body>
</html>