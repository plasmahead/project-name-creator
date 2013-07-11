# Project Name Generator 

A litle bit of code to generate interesting projet names. 

## Usage

```
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
```

## Output

```
veer-variable-variety
join-junior-junior
gummed-genuine-gum
lowe-low-lei
sniff-symbolic-snob
drag-dark-drizzle
honk-honest-honesty
tamp-temporary-tambour
thirsts-thirsty-torchiere
cart-crude-criticism
coft-capitalist-chapter
quit quiet quit
ClippedCleverClave
Chant Condemned Continent
```