<?php

namespace app\models;

class History
{
  private int $id;
  private int $projectId;

  public function getId()
  {
    return $this->id;
  }

  public function setId(int $id)
  {
    $this->id = $id;
  }

  public function getProjectId()
  {
    return $this->projectId;
  }

  public function setProjectId(int $projectId)
  {
    $this->projectId = $projectId;
  }
}
