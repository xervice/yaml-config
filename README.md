YamlConfig
=====================

[![Build Status](https://travis-ci.org/xervice/yaml-config.svg?branch=master)](https://travis-ci.org/xervice/yaml-config)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/xervice/yaml-config/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/xervice/yaml-config/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/xervice/yaml-config/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/xervice/yaml-config/?branch=master)

Parse Yaml files to Config-DataProvider.


Installation
-----------------
```
composer require xervice/yaml-config
```


Configuration
-----------------
To parse the config file, you have to define Hydrator-Classes implements \Xervice\YamlConfig\Business\Hydrator\HydratorInterface.

```
<?php

namespace App\MyModule\Business\Hydrator;

use DataProvider\DockerConfigDataProvider;
use Xervice\YamlConfig\Business\Hydrator\HydratorInterface;
use Xervice\Core\Locator\AbstractWithLocator;

/**
 * @method \App\MyModule\MyModuleFactory getFactory()
 */
class MyHydrator extends AbstractWithLocator implememts HydratorInterface
{
    /**
     * @param array $data
     * @param \DataProvider\YamlConfigDataProvider $dataProvider
     *
     * @return \DataProvider\YamlConfigDataProvider
     * @throws \Xervice\YamlConfig\Business\Exception\ConfigException
     */
    public function hydrateConfig(array $data, DockerConfigDataProvider $dataProvider): DockerConfigDataProvider
        {
            if (isset($data[MyModuleConfig::CONFIG_NAME])) {
                $dataProvider = $this->getFactory()->createMyModuleHydrator(
                    $data[MyModuleConfig::CONFIG_NAME],
                    $dataProvider
                )->hydrate();
            }

            return $dataProvider;
        }
}
```


Using
-----------------

```php
$configFile = new YamlConfigFileDataProvider();
$configFile->setPath(__DIR__ . '/data/my_config.yml');

$fileList = new YamlConfigFileListDataProvider();
$fileList->addFile($configFile);

$config = $yamlConfigFacade->getYamlConfig($fileList); // YamlConfigDataProvider
```