<?php 

if(isset($_POST['submit'])) {
    //if the thing is done, the thing we got from post, which is the submit (value)-will only do things if the button has been pushed
    
    require "../config.php"; //this basically inputs the config file here. 
    
    try {   //try/catch statment, which i don't know about yet. sounds like if the thing above works, try this -steps. if not =catch
        //connect to database 
        $connection = new PDO($dsn, $username, $password, $options);
        
        //get contents of the form and store it in an array
        $new_idea = array(  //does this have to be the same as anything else?
            "storytitle" => $_POST['storytitle'], //the story title is the thing we get from post, which is value storytitle
            "storytype" => $_POST['storytype'], 
            "storygenre" => $_POST['storygenre'],
            "storybrief" => $_POST['storybrief'],
            "datecreated" => $_POST['datecreated'],
        );
        
        //turn the array into sql statement
        $sql = "INSERT INTO stories (storytitle, storytype, storygenre, storybrief, datecreated) VALUES (:storytitle, :storytype, :storygenre, :storybrief, :datecreated)"; //not entire sure what that does. variable sql is inserted into the stories table, those names as those values 
        
        //write the sql to the database 
        $statement = $connection->prepare($sql);
        $statement->execute($new_idea);
    
    } catch(PDOException $error) {
        //if there is an error tell us what it is 
        echo $sql . "<br>" . $error->getMessage();
        
    }
}
?>

<?php include "templates/header.php"; ?>
<!-- if the the submit button has been pushed and we have a statement -->
<?php if (isset($_POST['submit']) && $statement) { ?>  
<p>Story successfully added.</p>
<?php } ?>

<form method="post">
    
    <label for="storytitle">Story Title</label>
    <input type="text" name="storytitle" id="storytitle"> 
    
    <label for="storytype">Story Type</label>
    <input type="text" name="storytype" id="storytype"> 
    
    <label for="storygenre">Story Genre</label>
    <input type="text" name="storygenre" id="storygenre"> 
    
    <label for="storybrief">Story Brief</label>
    <input type="text" name="storybrief" id="storybrief"> 
    
    <label for="datecreated">Date Created</label>
    <input type="text" name="datecreated" id="datecreated"> 
    
    <input type="submit" name="submit" value="submit"> 

<!-- i would love to do more complex stuff, check boxes, type and genre would be good drop down menues, but not yet in the draft. -->
    
</form>


<?php include "templates/footer.php"; ?> 