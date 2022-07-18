<?php

namespace Hb\TodolistComposer\Controller;

class ShowController extends AbstractController
{
    public function __invoke(array $parameters): string
    {
        $id = $parameters['id'];


        $sql = "SELECT * FROM tasks WHERE id = ?";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(1, $id);
        $resultSet = $stmt->executeQuery();

        $results = iterator_to_array($resultSet->iterateAssociative());
        $task = $results[0];

        // Render Twig template in this controller.
        return $this->twig->render('show.html.twig', [
            'title' => $task['title'],
            'task' => $task,
        ]);
    }
}
