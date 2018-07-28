<?php
declare(strict_types=1);

namespace Xervice\YamlConfig\Business\Loader;

use DataProvider\YamlConfigDataProvider;

interface ConfigLoaderInterface
{
    /**
     * @return \DataProvider\YamlConfigDataProvider
     * @throws \Xervice\YamlConfig\Business\Exception\ConfigException
     */
    public function getConfig(): YamlConfigDataProvider;
}