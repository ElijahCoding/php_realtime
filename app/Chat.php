<?php

namespace App;

use Exception;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;

class Chat implements MessageComponentInterface
{
  protected $clients;
  
  function onOpen(ConnectionInterface $message)
  {

  }

  function OnMessage(ConnectionInterface $connection, $message)
  {

  }

  function onClose(ConnectionInterface $message)
  {

  }

  function onError(ConnectionInterface $message, Exception $e)
  {
    $connection->close();
  }

}
