<?php
declare(strict_types=1);


namespace Xervice\YamlConfig;


use DataProvider\YamlConfigDataProvider;
use DataProvider\YamlConfigFileListDataProvider;
use Xervice\Core\Facade\AbstractFacade;

/**
 * @method \Xervice\YamlConfig\YamlConfigFactory getFactory()
 */
class YamlConfigFacade extends AbstractFacade
{
    /**
     * @param \DataProvider\YamlConfigFileListDataProvider $fileListDataProvider
     *
     * @return \DataProvider\YamlConfigDataProvider
     */
    public function getYamlConfig(YamlConfigFileListDataProvider $fileListDataProvider): YamlConfigDataProvider
    {
        return $this->getFactory()->createConfigLoader($fileListDataProvider)->getConfig();
    }
}