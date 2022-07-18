<?php

namespace Hb\TodolistComposer\Controller;

class HomeController extends AbstractController
{
    /**
     * For now, only echo a string.
     */
    public function __invoke(): string
    {
        $sql = "SELECT * FROM tasks";

        $stmt = $this->connection->prepare($sql);
        $resultSet = $stmt->executeQuery();

        // Render Twig template in this controller.
        return $this->twig->render('index.html.twig', [
            'title' => 'ctrl',
            'tasks' => $resultSet->iterateAssociative(),
        ]);
    }
}
