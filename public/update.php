<?php 
// this code will only execute after the submit button is clicked
	
    // include the config file that we created before
    require "../config.php"; 
    
    // this is called a try/catch statement 
	try {
        // FIRST: Connect to the database
        $connection = new PDO($dsn, $username, $password, $options);
		
        // SECOND: Create the SQL 
        $sql = "SELECT * FROM stories";
        
        // THIRD: Prepare the SQL
        $statement = $connection->prepare($sql);
        $statement->execute();
        
        // FOURTH: Put it into a $result object that we can access in the page
        $result = $statement->fetchAll();
	} catch(PDOException $error) {
        // if there is an error, tell us what it is
		echo $sql . "<br>" . $error->getMessage();
	}	
?>


<?php include "templates/header.php"; ?>


    
<h2>Results</h2>

<?php 
                // This is a loop, which will loop through each result in the array
                foreach($result as $row) { 
            ?>

<p>
    ID:
    <?php echo $row["id"]; ?><br> Story Title:
    <?php echo $row['storytitle']; ?><br> Story Type:
    <?php echo $row['storytype']; ?><br> Story Genre:
    <?php echo $row['storygenre']; ?><br> Story Brief:
    <?php echo $row['storybrief']; ?><br> Date Created:
    <?php echo $row['datecreated']; ?><br>
    <a href='update-work.php?id=<?php echo $row['id']; ?>'>Edit</a> 
    <!-- what does that link do??? adds a link, but the bit in the middle got me confused oh, it's a query string, sends thing to url it adds an id as a parameter tothe url --> 
</p>
<?php 
            // this willoutput all the data from the array
            //echo '<pre>'; var_dump($row); 
        ?>

<hr>
<?php }; //close the foreach
?>



<form method="post">

    <input type="submit" name="submit" value="View all">

</form>


<?php include "templates/footer.php"; ?>