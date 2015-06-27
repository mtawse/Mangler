<?php
/**
 * @author Martin Tawse martin.tawse@gmail.com
 * Date: 27/06/2015
 *
 * http://www.reddit.com/r/dailyprogrammer/comments/3aqvjn/20150622_challenge_220_easy_mangling_sentences/
 *
 * Input
 * The input will be a single line that is exactly one English sentence,
 * starting with a capital letter and ending with a period
 *
 * Output
 * The output will be the same sentence with all the letters in each word sorted.
 * Words that were capitalized in the input needs to be capitalized properly in the output,
 * and any punctuation should remain at the same place as it started.
 * So, for instance, "Dailyprogrammer" should become "Aadegilmmoprrry" (note the capital A),
 * and "doesn't" should become "denos't".
 */

class Mangler
{
    /**
     * @var
     */
    protected $string;

    /**
     * @var array
     */
    protected $words = array();

    function __construct($string)
    {
        $this->string = $string;
    }

    /**
     *
     */
    public function run()
    {
        $this->preFormatString();
        $this->splitString();

        foreach ($this->words as $index => $word) {
            // check if we have special characters
            $this->words[$index] = $this->formatWord($word);
        }

        $this->recreateSentence();
        $this->postFormatString();
        $this->output();
    }


    /**
     *
     */
    private function preFormatString()
    {
        // trim any space
        $this->string = trim($this->string);
        // strip the trailing full stop
        $this->string = rtrim($this->string, '.');
    }


    /**
     *
     */
    private function postFormatString()
    {
        // Add capital
        $this->string = ucfirst($this->string);
        // Add full stop
        $this->string .= '.';
    }


    /**
     * Split the sting into an array of words
     *
     * @return array
     */
    public function splitString()
    {
        $this->words = explode(' ', $this->string);
    }


    /**
     * Formats the word
     * Check for special characters and capitals
     * Sort the word by alphabet
     * Replace special characters and capitals
     *
     * @param string $word
     * @return string
     */
    private function formatWord($word)
    {
        // check for special characters
        // any commas between words are attached to the word and retained in this process
        preg_match('![^a-z0-9]!i', $word, $special_character_matches);

        // check for capitals
        preg_match('/[A-Z]/', $word, $capital_matches);

        if (count($special_character_matches)) {
            $char = $special_character_matches[0];
            $pos = strpos($word, $char);
            $word = str_replace($char, '', $word);
        }

        // need to lower case before we split and sort
        $word = strtolower($word);
        $parts = str_split($word);
        sort($parts);

        if (count($special_character_matches)) {
            // replace special character in its position
            array_splice($parts, $pos, 0, $char);
        }

        $word = implode('', $parts);


        if (count($capital_matches)) {
            // re-capitalise word
            $word = ucfirst($word);
        }

        return $word;
    }

    /**
     * Put the words back in a sentence
     */
    private function recreateSentence()
    {
        $this->string = implode(' ', $this->words);
    }


    /**
     *
     */
    private function output()
    {
        echo $this->string;
    }


//    private function containsSpecialCharacters($word)
//    {
//        preg_match('![^a-z0-9]!i', $word, $matches);
//    }


    /**
     * @param mixed $string
     */
    public function setString($string)
    {
        $this->string = $string;
    }

    /**
     * @return mixed
     */
    public function getString()
    {
        return $this->string;
    }

    /**
     * @param array $words
     */
    public function setWords($words)
    {
        $this->words = $words;
    }

    /**
     * @return array
     */
    public function getWords()
    {
        return $this->words;
    }


} 