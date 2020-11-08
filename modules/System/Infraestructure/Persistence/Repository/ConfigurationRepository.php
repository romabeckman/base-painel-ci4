<?php

namespace System\Infraestructure\Persistence\Repository;

use \Shared\Persistence\Abstracts\RepositoryBase;
use \System\Infraestructure\Persistence\Models\ConfigurationModel;

/**
 * Description of GroupRepository
 *
 * @author Romário Beckman <romabeckman@yahoo.com.br>
 */
class ConfigurationRepository extends RepositoryBase {

    protected string $modelClass = ConfigurationModel::class;

    public function getAllConfiguration(): array {
        $configurations = $this->getModel()->findAll();
        return empty($configurations) ? [] : array_column($configurations, 'value', 'key');
    }

    public function getConfiguration(string $key): ?string {
        $config = $this->getModel()->find($key);

        if (empty($config)) {
            return null;
        }

        return $config['value'];
    }

    public function saveConfiguration(array $post): void {
        if (!isset($post['config'])) {
            return;
        }

        $save = [];

        foreach ($post['config'] as $key => $value) {
            $save[] = ['key' => $key, 'value' => $value];
        }

        $this->getModel()->updateBatch($save, 'key');
    }

}
