<?php

// require_once 'core/App.php';
// require_once 'core/Controller.php';
// require_once 'core/Constanta.php';

require_once 'config/config.php';

spl_autoload_register(function ($class) {
    require_once 'core/' . $class .'.php';
});