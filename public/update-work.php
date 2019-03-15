<?php 

require "../config.php";
require "common.php";

//run when submit button is clicked 
if (isset($_POST['submit'])){
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        
        //grab elements from form and set as variable
        
        $story =[
            "id"            => $_POST['id'],
            "storytitle"    => $_POST['storytitle'],
            "storytype"     => $_POST['storytype'],
            "storygenre"    => $_POST['storygenre'],
            "storybrief"    => $_POST['storybrief'],
            "datecreated"   => $_POST['datecreated'],
            "date"          => $_POST['date'],
          
        ];
        
        //create sql statement 
     //these aren't comma's there the things under the wavy line. left of 1 on the keybouard
        $sql = "UPDATE `stories`  
                SET id = :id,
                storytitle = :storytitle,
                storytype = :storytype,
                storygenre = :storygenre,
                storybrief = :storybrief,
                datecreated = :datecreated,
                date = :date
                	
            WHERE id =:id";
        //date = :date -this was under date created above but was causing errors, undefined, variable? 
        
        //prepare sql statement
        $statement = $connection->prepare($sql);
        
        //execute sql statement
        $statement->execute($story);
        
        
    }   catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}


//simple if else statement to check if id is avaible
if (isset($_GET['id'])) {
    // yes the id exits 
    
    try {
// standard db conneciton 
        $connection = new PDO($dsn, $username, $password, $options);
        
        //set id as a varible so we can easily refere to it later 
        $id = $_GET['id'];
        
        //select statement to get the right data
        $sql = "SELECT * FROM stories WHERE id = :id";
        
        //prepare the connection 
        $statement = $connection->prepare($sql);
        
        //bind the id to the PDO id
        $statement->bindValue(':id', $id);
        
        //now execute the statement
        $statement->execute();
        
        //attach the sql statement to the new work(story) varibale so we can access it in the form 
        $story = $statement->fetch(PDO::FETCH_ASSOC);
    
    } catch(PDOExcption $error) { //is that supposed to have another e in there? Exception?
        echo $sql . "<br>" . $error->getMessage();
    }
    
    //quickly show the id on the page 
    echo $_GET['id'];
    
}   else {
        // no id, show error
    echo "No id - something went wrong";
    //exit;
}
?>

<?php include "templates/header.php"; ?> 

<?php if (isset($_POST['submit']) && $statement) : ?>
<p>Work successfully updated.</p>
<?php endif; ?>

<h2>Edit a work</h2>

<form method="post">
    
    <label for="id">ID</label>
    <input type="text" name="id" id="id" value="<?php echo escape($story['id']); ?>" >
    
    <label for="storytitle">Story Title</label>
    <input type="text" name="storytitle" id="storytitle" value="<?php echo escape($story['storytitle']); ?>" > 
    
    <label for="storytype">Story Type</label>
    <input type="text" name="storytype" id="storytype" value="<?php echo escape($story['storytype']); ?>" > 
    
    <label for="storygenre">Story Genre</label>
    <input type="text" name="storygenre" id="storygenre" value="<?php echo escape($story['storygenre']); ?>" > 
    
    <label for="storybrief">Story Brief</label>
    <input type="text" name="storybrief" id="storybrief" value="<?php echo escape($story['storybrief']); ?>" > 
    
    <label for="datecreated">Date Created</label>
    <input type="text" name="datecreated" id="datecreated" value="<?php echo escape($story['datecreated']); ?>" >
    
    <label for="date">Date</label>
    <input type="text" name="date" id="date" value="<?php echo escape($story['date']); ?>" > 
    
    <input type="submit" name="submit" value="save"> 

<!-- i would love to do more complex stuff, check boxes, type and genre would be good drop down menues, but not yet in the draft. -->
    
</form>

<?php include "templates/footer.php"; ?> 