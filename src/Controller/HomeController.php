<?php

namespace Hb\TodolistComposer\Controller;

use Twig\Environment;

class HomeController
{
    /**
     * @param Environment $twig The controller need Twig to be created. So specify it in construct.
     */
    public function __construct(
        private Environment $twig,
    ) {}

    /**
     * For now, only echo a string.
     */
    public function __invoke(): string
    {
        // Render Twig template in this controller.
        return $this->twig->render('index.html.twig', [
            'title' => 'ctrl',
        ]);
    }
}
