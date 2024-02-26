<?php

namespace app\models;

class Setting
{
  private int $id;
  private string $projectDestination;

  public function getId()
  {
    return $this->id;
  }

  public function setId(int $id)
  {
    $this->id = $id;
  }

  public function getProjectDestination()
  {
    return $this->projectDestination;
  }

  public function setProjectDestination(string $destination)
  {
    $this->projectDestination = $destination;
  }
}
