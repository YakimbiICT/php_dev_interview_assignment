<?php
namespace Imact\Model\Adaptor;

use Imact\Base as Core;

abstract class Base extends Core
{

    //Relative to the apdator
    protected $location;

    //Used to store connections to unique locations during the lifetime of a page load
    protected static $resource;

}
