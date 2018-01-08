<?php

namespace App;

use Ratchet\ConnectionInterface;

trait ChatEventsTrait
{
  protected function handleJoined(ConnectionInterface $connection, $payload)
  {
    $this->users[$connection->resourceId] = $payload->data->user;

    foreach ($this->clients as $client) {
      $client->send(json_encode([
        'event' => 'joined',
        'data' => [
          'user' => $payload->data->user
        ]
      ]));
    }
  }
}
