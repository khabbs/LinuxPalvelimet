 <?php
 // Include config file
 require_once "config.php";
$query = "SELECT * FROM `paaruoka` ORDER BY RAND() Limit 1";  
$result = mysqli_query($link, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <a href="create.php" class="btn btn-success pull-right">Lisää uusi resepti</a>
                        <a href="list.php" class="btn btn-success pull-right">Näytä kaikki</a>
                        <h2 class="pull-left">Tämän päivän ruokana on:</h2>
		</div>
                    <div>
                        <p><?php while ($row = mysqli_fetch_assoc($result)) {
			    printf("%s (%s)\n", $row["name"], $row["link"]);};?>
			</p>
                    </div>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
