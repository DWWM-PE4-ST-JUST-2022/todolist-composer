<?php

namespace Hb\TodolistComposer\Controller;

class ShowController extends AbstractController
{
    public function __invoke(array $parameters): string
    {
        $id = $parameters['id'];

        // Render Twig template in this controller.
        return $this->twig->render('show.html.twig', [
            'title' => 'Show ' . $id,
        ]);
    }
}
