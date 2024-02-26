<?php

namespace app\interfaces;

use app\models\Project;

interface ProjectDaoInterface {
  public function get();
  public function getById(int $id);
  public function getByTitle(string $title);
  public function create(Project $project);
  public function update(Project $project);
  public function updateZip(Project $project);
  public function delete(int $id);
}

