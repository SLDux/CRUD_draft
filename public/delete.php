<?php 
// this code will only execute after the submit button is clicked
	
    // include the config file that we created before
    require "../config.php"; 
require "common.php";

//this code will only run if the delete button is clicked
if (isset($_GET["id"])) {
    
    // this is called a try/catch statement 
	try {
        // Connect to the database
        $connection = new PDO($dsn, $username, $password, $options);
        
        //set id variable 
        $id = $_GET["id"];
		
        // SECOND: Create the SQL 
        $sql = "DELETE FROM stories WHERE id = :id";
        
        // THIRD: Prepare the SQL
        $statement = $connection->prepare($sql);
        
        //bind the id to the PDO
        $statement->bindValue(':id', $id);
        
            //execute statement
        $statement->execute();
        
        //success message 
        $success = "Work successfully deleted"; 
        
	} catch(PDOException $error) {
        // if there is an error, tell us what it is
		echo $sql . "<br>" . $error->getMessage();
	}	
    
};

//this code runs on startup -what's the difference between this one and the last one?
try {
    $connection = new PDO($dsn, $username, $password, $options);
    
    //Second create the sql
    $sql = "SELECT * FROM stories";
    
    //3rd prepare sql
    $statement = $connection->prepare($sql);
    $statement->execute();
    
    //4th put into a $result object we can access in the page 
    $result = $statement->fetchAll();
}   catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
}
?>


<?php include "templates/header.php"; ?>


    
<h2>Delete a story</h2>

<?php 
                // This is a loop, which will loop through each result in the array
                foreach($result as $row) { ?>

<p>
    ID:
    <?php echo $row["id"]; ?><br> Story Title:
    <?php echo $row['storytitle']; ?><br> Story Type:
    <?php echo $row['storytype']; ?><br> Story Genre:
    <?php echo $row['storygenre']; ?><br> Story Brief:
    <?php echo $row['storybrief']; ?><br> Date Created:
    <?php echo $row['datecreated']; ?><br>
    <a href='delete.php?id=<?php echo $row['id']; ?>'>Delete</a> 
    <!-- what does that link do??? adds a link, but the bit in the middle got me confused oh, it's a query string, sends thing to url it adds an id as a parameter tothe url --> 
</p>
<?php 
            // this willoutput all the data from the array
            //echo '<pre>'; var_dump($row); 
        ?>

<hr>
<?php }; //close the foreach
?>

<?php include "templates/footer.php"; 
?>