<?php

namespace PNC;

class Creator
{

    private $glue = '-';
    private $words = array();
    private $humped = false;

    private $nouns = array();
    private $verbs = array();
    private $adjectives = array();

    private function _loadFiles()
    {
        $this->_loadFile('nounlist.txt', $this->nouns);
        $this->_loadFile('parts-of-speech-word-files/verbs/1syllableverbs.txt', $this->verbs);
        $this->_loadFile('adjectives.txt', $this->adjectives);

        //print_r($this->verbs);
    }


    private function _loadFile($path, &$store)
    {

        $store = array();
        $handle = fopen($path, "r");
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                // process the line read.
                $store[] = trim($line);
            }
        
            fclose($handle);
        } else {
            throw new \Exception('error opening the file.');
        } 

    }
    
    
    static $instance;

    // Singleton 
    static public function getInstance()
    {
        if(self::$instance === null)
        {
            self::$instance = new self(); 
        }
        return self::$instance;
    }



    // prevent object from being instanciated externally
    private function __construct()
    {
        $this->_loadFiles();
    }


    public function initWords()
    {
        $key1 = array_rand($this->nouns);
        $key2 = array_rand($this->adjectives);
        $key3 = array_rand($this->verbs);

        $soundex_map = array();
        foreach($this->nouns as $key => $noun)
        {
            $soundex_map['nouns'][soundex(substr($noun,0, 5))][] = $noun;
        }
        foreach($this->adjectives as $key => $adjective)
        {
            $soundex_map['adjectives'][soundex(substr($adjective,0, 5))][] = $adjective;
        }
        foreach($this->verbs as $key => $verbs)
        {
            $soundex_map['verbs'][soundex(substr($verbs,0, 5))][] = $verbs;
        }

        // find sound key that is common for all types of word
        $keys = array_intersect_key($soundex_map['nouns'], $soundex_map['adjectives'], $soundex_map['verbs']);

        // get a random sound key
        $sound_key = array_rand($keys);

        $key1 = array_rand($soundex_map['nouns'][$sound_key]);
        $key2 = array_rand($soundex_map['adjectives'][$sound_key]);
        $key3 = array_rand($soundex_map['verbs'][$sound_key]);        

        $this->words = array($soundex_map['verbs'][$sound_key][$key3], $soundex_map['adjectives'][$sound_key][$key2],$soundex_map['nouns'][$sound_key][$key1]);

        //$this->words = array($this->adjectives[$key2],$this->nouns[$key1], $this->verbs[$key3]);

    }    

    static public function generate()
    {
        /*
        $numargs = func_num_args();
        echo "Number of arguments: $numargs \n";
        if ($numargs >= 2) {
            echo "Second argument is: " . func_get_arg(1) . "\n";
        }
        $arg_list = func_get_args();
        for ($i = 0; $i < $numargs; $i++) {
            echo "Argument $i is: " . $arg_list[$i] . "\n";
        }
        */

        $a = self::getInstance();

        $a->initWords();

        return $a;
    }

    public function dashed()
    {
        $this->glue = '-';
        return $this;
    }

    public function spaced()
    {
        $this->glue = ' ';
        return $this;
    }    

    public function humped()
    {
        $this->glue = '';
        $this->humped = true;
        return $this;
    } 

    public function __toString()
    {
        $words = $this->words;

        if($this->humped)
        {
            $words = array_map('ucfirst', $words);
        }

        return implode($this->glue, $words);
    }
}


for($i = 0; $i < 9; $i++)
{
    echo Creator::generate('n1a2v2')->dashed();  
    echo "\n";      
}


exit;
echo Creator::generate('words', 10, 'numbers', true)->dashed();
echo "\n";
echo Creator::generate()->spaced();
echo "\n";
echo Creator::generate()->humped();
echo "\n";
echo Creator::generate()->spaced();

?>