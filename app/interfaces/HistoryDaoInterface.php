<?php

namespace app\interfaces;

use app\models\History;

interface HistoryDaoInterface
{
  public function create(History $history);
  public function get();
}
