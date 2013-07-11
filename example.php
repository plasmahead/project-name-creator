<?php

require "Creator.php";

use \PNC\Creator;

/**
 * Generate 10 examples 
 */
for($i = 0; $i < 10; $i++)
{
    echo Creator::generate('n1a2v2')->dashed();  
    echo "\n";      
}



/**
 * A few more examples
 */
echo Creator::generate('words', 10, 'numbers', true)->dashed();
echo "\n";
echo Creator::generate()->spaced();
echo "\n";
echo Creator::generate()->humped();
echo "\n";
echo Creator::generate()->spaced();

?>