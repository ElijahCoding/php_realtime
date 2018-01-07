<?php

namespace App;

use Ratchet\ConnectionInterface;

trait ChatEventsTrait
{
  protected function handleJoined(ConnectionInterface $connection, $payload)
  {
    $this->users[$connection->resourceId] = $payload->data->user;
  }
}
