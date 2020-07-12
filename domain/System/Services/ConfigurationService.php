<?php

namespace System\Services;

use \App\Singleton;
use \System\Models\ConfigurationModel;

/**
 * Description of getConfiguration
 *
 * @author Romário Beckman
 */
class ConfigurationService extends Singleton {

    public function getAll(): array {
        $configurations = (new ConfigurationModel())->findAll();
        return empty($configurations) ? [] : array_column($configurations, 'value', 'key');
    }

    public function get(string $key): ?string {
        $config = (new ConfigurationModel())
                ->selectDecrypted()
                ->find($key);

        if (empty($config)) {
            return null;
        }

        return $config['value'];
    }

}
