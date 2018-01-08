<?php

namespace App;

use Exception;
use App\ChatEventsTrait;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;

class Chat implements MessageComponentInterface
{
  use ChatEventsTrait;


  protected $clients;

  protected $users;

  function onOpen(ConnectionInterface $connection)
  {
    // echo get_class($connection);
    // echo $connection->resourceId;
    $this->clients[$connection->resourceId] = $connection;

    // var_dump(count($this->clients)); check online clients (for future)
  }

  function OnMessage(ConnectionInterface $connection, $message)
  {
    // var_dump($message); debug with Timeout problem
    $payload = json_decode($message);

    if (method_exists($this, $method = 'handle' . ucfirst($payload->event))) {
      $this->{$method}($connection, $payload);
    }

  }

  function onClose(ConnectionInterface $connection)
  {
    foreach ($this->clients as $client) {
      $client->send(json_encode([
        'event' => 'left',
        'data' => [
          'user' => $this->users[$connection->resourceId]
        ]
      ]));
    }
    unset($this->clients[$connection->resourceId]);
  }

  function onError(ConnectionInterface $connection, Exception $e)
  {
    $connection->close();
  }

}
