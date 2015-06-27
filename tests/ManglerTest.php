<?php
/**
 * @author Martin Tawse martin.tawse@gmail.com
 * Date: 27/06/2015
 */

require_once 'Mangler.php';

class ManglerTest extends PHPUnit_Framework_TestCase
{
    public function testOutputStringMatchesExpected1()
    {
        $input = "There are more things between heaven and earth, Horatio, than are dreamt of in your philosophy.";
        $expected_output = "Eehrt aer emor ghinst beeentw aeehnv adn aehrt, Ahioort, ahnt aer ademrt fo in oruy hhilooppsy.";
        $mangler = new Mangler($input);
        $mangler->run();

        $this->assertEquals($expected_output, $mangler->getString());

    }

    public function testOutputStringMatchesExpected2()
    {
        $input = "This challenge doesn't seem so hard.";
        $expected_output = "Hist aceeghlln denos't eems os adhr.";
        $mangler = new Mangler($input);
        $mangler->run();

        $this->assertEquals($expected_output, $mangler->getString());

    }
} 