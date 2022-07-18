<?php

use Doctrine\DBAL\DriverManager;

return DriverManager::getConnection([
    'url' => 'sqlite:///db.sqlite',
]);
