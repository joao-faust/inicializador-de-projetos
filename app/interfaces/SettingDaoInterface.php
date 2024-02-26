<?php

namespace app\interfaces;

use app\models\Setting;

interface SettingDaoInterface
{
  public function get();
  public function update(Setting $setting);
}
