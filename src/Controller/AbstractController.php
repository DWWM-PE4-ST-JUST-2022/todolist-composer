<?php

/*
 * This file is part of the todolist-composer package.
 *
 * (c) Benjamin Georgeault
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hb\TodolistComposer\Controller;

use Twig\Environment;

/**
 * Class AbstractController
 *
 * @author Benjamin Georgeault
 */
abstract class AbstractController
{
    /**
     * @param Environment $twig The controller need Twig to be created. So specify it in construct.
     */
    public function __construct(
        protected Environment $twig,
    ) {}
}
