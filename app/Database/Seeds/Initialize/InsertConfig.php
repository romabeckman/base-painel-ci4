<?php

namespace App\Database\Seeds\Initialize;

use \CodeIgniter\Database\Seeder;
use \System\Models\ConfigurationModel;

class InsertConfig extends Seeder {

    public function run() {
        $model = new ConfigurationModel();

        if ($model->countAll() == 0) {
            $model->insert(['key' => 'EMAIL_FROM_NAME', 'value' => '']);
            $model->insert(['key' => 'EMAIL_FROM', 'value' => '']);
            $model->insert(['key' => 'RECAPTCHA_V3_MINIMUM_SCORE', 'value' => 0.5]);
        }
    }

}
