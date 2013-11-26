<?php
include FRAMEWORK_ROOT . '/lib/simpletest/autorun.php';
include FRAMEWORK_ROOT . '/lib/simpletest/extensions/pear_test_case.php';
class CustomReporter extends HtmlReporter 
{
    public function paintHeader($name)
    {

    }
    public function paintFooter($name)
    {
        
    }
    function paintPass($message) {
        //parent::paintPass($message);
        print "Pass: ";
        $breadcrumb = $this->getTestList();
        array_shift($breadcrumb);
        print implode("->", $breadcrumb);
        print "->$message<br />\n";
    }
    function paintFail($message) {
       // parent::paintFail($message);
        print "Fail: ";
        $breadcrumb = $this->getTestList();
        array_shift($breadcrumb);
        print implode("->", $breadcrumb);
        print "->$message<br />\n";
    }
}
SimpleTest::prefer(new CustomReporter());
?>