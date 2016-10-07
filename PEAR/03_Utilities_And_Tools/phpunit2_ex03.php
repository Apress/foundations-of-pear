<?php
/* Testing for nulls */

// Call ConfigTest::main() if this source file is executed directly.
if (!defined("PHPUnit2_MAIN_METHOD")) {
    define("PHPUnit2_MAIN_METHOD", "NullTest::main");
}

require_once "PHPUnit2/Framework/TestCase.php";
require_once "PHPUnit2/Framework/TestSuite.php";

class NullTest extends PHPUnit2_Framework_TestCase 
{

    public static function main() 
    {
        require_once "PHPUnit2/TextUI/TestRunner.php";

        $suite  = new PHPUnit2_Framework_TestSuite("NullTest");
        $result = PHPUnit2_TextUI_TestRunner::run($suite);
    }

    public function testNulls() 
    {    
        $myval = null;
        $this->assertNull($myval, 'Expected value to be null.');
        $myval = 'something';
        $this->assertNotNull($myval, 'Expected value to be not null.');
    }
}

if (PHPUnit2_MAIN_METHOD == "NullTest::main") {
    NullTest::main();
}
?>
