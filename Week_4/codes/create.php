
<?php
//Virheilmoitusten esiin saaminen
error_reporting(E_ALL | E_STRICT);  
ini_set('display_startup_errors',1);  
ini_set('display_errors',1);

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$name = $linkURL = "";
$name_err = $linkURL_err = "";
//$link = mysqli_connect('localhost', 'jj', 'etikinaarvaa');
//mysqli_select_db('SQLtesti', $link);
//mysqli_set_charset('UTF-8', $link);

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $name = $input_name;
    }
    
    // Validate link URL
    $input_linkURL = trim($_POST["linkURL"]);
    if(empty($input_linkURL)){
        $linkURL_err = "Please enter a link to the recipe.";     
    } else{
        $linkURL = $input_linkURL;
    }
    
    // Check input errors before inserting in database
    if(empty($name_err) && empty($linkURL_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO paaruoka (name, link) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_name, $param_linkURL);
            
            // Set parameters
            $param_name = $name;
            $param_linkURL = $linkURL;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lisää uusi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Lisää uusi resepti</h2>
                    </div>
                    <p>Täyttele tämä lomake lisätäksesi uuden pääruoan listalle</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Nimi</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                            <span class="help-block"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($linkURL_err)) ? 'has-error' : ''; ?>">
                            <label>Linkki reseptiin</label>
                            <input type="text" name="linkURL" class="form-control" value="<?php echo $linkURL; ?>">
                            <span class="help-block"><?php echo $linkURL_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Peru</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
