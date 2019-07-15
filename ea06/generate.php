<?php

    require_once 'inc/init.php';
    echo Doctrine_Core::getPath();

    Doctrine_Core::generateModelsFromDb('models',array('blogconn'),
            array('generateTableClasses'=>true));

?>
