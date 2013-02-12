<?php
namespace Imact;

/**
 * This class reinvents and tests
 * @author Edward Halls <ehalls@gmail.com>
 *
 */
class Test extends Base
{
    private $classes;

    public function __construct($classes)
    {
        $this->classes = $classes;
        foreach ($this->classes as $class) {
            self::testClass($class);
        }
    }

    public function __destruct()
    {
        foreach ($this->classes as $class) {
        	$class = self::getCounterpart($class, true);
            echo "Test report for  $class : <br/>";
            $errors = (isset(self::$err[$class]) ? self::$err[$class] : null);
            if (!empty($errors)) {
                foreach ($errors as $key => $msg) {
                    echo ($key + 1) . ". " . $msg . "<br/>";
                }
            }
            echo "End Test report for  $class : <br/>";
        }
    }

    static public function getCounterpart($class, $nameOnly=false)
    {
        $components = explode("\\", $class);
        $testClass[] = array_shift($components);
        $testClass[] = "Test";
        $cTest = implode("\\", array_merge($testClass, $components));
        $cTest .= "Test";
        if($nameOnly) return $cTest;
        return new $cTest();
    }

    static public function testClass($class)
    {

        if (class_exists($class)) {
            $oTest = self::getCounterpart($class);
        } else {
            $this->assert(false, "Cannot find the '$class' class.");
        }
    }

}
