<?php 
// in order to save the data you need to escape the html first. the main aim here is to convert any special characters into a html entity.
function escape($html) {
    return htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
}
?> 