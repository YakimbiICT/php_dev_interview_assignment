<?php
namespace Imact\Test;

use Imact\Base as Core ;

/**
 * Performs unit testing of Imact classes as configured
 * @author Edward Halls <ehalls@gmail.com
 *
 */
abstract class Base extends Core
{

    protected $counterpart, $param, $class, $call;

    public function __construct()
    {
        $this->class = get_class($this);
        $this->test();
    }

    /**
     * Take the current class and get its corresponding object to be tested
     */
    protected function getCounterpart()
    {
        $components = explode('\\', $this->class);
        $testClass[] = array_shift($components); // Extract encapsulating folder bit
        array_shift($components); // Remove Test
        $clean = str_replace("Test", "",end($components)); // Remove Test
        $components[key($components)] = $clean;
        $cTest = implode("\\", array_merge($testClass, $components));
        return new $cTest();
    }

    /**
     * Carry out all tests for this class
     */
    protected function test()
    {
        $this->counterpart = $this->getCounterpart();

        $class = new \ReflectionClass($this->class);
        $methods = $class->getMethods(\ReflectionMethod::IS_PUBLIC);

        foreach ($methods as $method) {
        	if($method->isConstructor()) continue;
            $param_arr = array();
            $this->call = $method->name;
            if (isset($this->param[$this->call])
                    && !empty($this->param[$this->call])) {
                $param_arr = $this->param[$this->call];
            }

            call_user_func_array(array($this, $this->call), $param_arr);
        }
    }

    protected function record($msg)
    {
        self::$err[$this->class][] = $msg;
    }

    protected function assert($pass, $msg = "")
    {

        $status = ($pass ? "PASS: " : "FAIL: ");
        $status .= "Function called on class " . $this->class . " is "
                . $this->call . " : ";
        $status .= $msg;

        self::record($status);

    }

    protected function equals($output, $subject)
    {

        if ($output == $subject) {
            $this->assert(true, "The data is of the expected equivalence");
        } else {
            $this->assert(false,
                          "The data '$output' is not equivalent to '$subject' ");
        }
    }

    protected function format($output, $type)
    {

        if ($output instanceof $type) {
            $this->assert(true, "The data is of the expected format");
        } else {
            $this->assert(false, "The data is not of the expected format");
        }
    }

    protected function exists($output)
    {

        if (!empty($output)) {
            $this->assert(true, "The data is present");
        } else {
            $this->assert(false, "The data is not present");
        }
    }
}
