<?php

namespace App;

use Ratchet\ConnectionInterface;
use App\Events\UserJoined;

trait ChatEventsTrait
{
  protected function handleJoined(ConnectionInterface $connection, $payload)
  {
    $user = $payload->data->user;

    $this->users[$connection->resourceId] = $user;

    $this->broadcast(new UserJoined($user))->toAll();


    // foreach ($this->clients as $client) {
    //   $client->send(json_encode([
    //     'event' => 'joined',
    //     'data' => [
    //       'user' => $payload->data->user
    //     ]
    //   ]));
    // }
  }
}
