<?php

namespace App;

use Exception;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;

class Chat implements MessageComponentInterface
{
  protected $clients;

  function onOpen(ConnectionInterface $connection)
  {
    // echo get_class($connection);
    // echo $connection->resourceId;
    $this->clients[$connection->resourceId] = $connection;

    // var_dump(count($this->clients)); check online clients (for future) 
  }

  function OnMessage(ConnectionInterface $connection, $message)
  {

  }

  function onClose(ConnectionInterface $connection)
  {
    unset($this->clients[$connection->resourceId]);
  }

  function onError(ConnectionInterface $connection, Exception $e)
  {
    $connection->close();
  }

}
