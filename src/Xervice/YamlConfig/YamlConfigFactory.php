<?php
declare(strict_types=1);


namespace Xervice\YamlConfig;


use DataProvider\YamlConfigFileListDataProvider;
use Xervice\YamlConfig\Business\Hydrator\HydratorCollection;
use Xervice\YamlConfig\Business\Loader\ConfigLoader;
use Xervice\YamlConfig\Business\Loader\ConfigLoaderInterface;
use Xervice\YamlConfig\Business\Reader\ReaderInterface;
use Xervice\YamlConfig\Business\Reader\YamlReader;
use Xervice\Core\Factory\AbstractFactory;

class YamlConfigFactory extends AbstractFactory
{
    /**
     * @param \DataProvider\YamlConfigFileListDataProvider $fileListDataProvider
     *
     * @return \Xervice\YamlConfig\Business\Loader\ConfigLoader
     */
    public function createConfigLoader(YamlConfigFileListDataProvider $fileListDataProvider): ConfigLoaderInterface
    {
        return new ConfigLoader(
            $fileListDataProvider,
            $this->createReader(),
            $this->getHydratorCollection()
        );
    }

    /**
     * @return \Xervice\YamlConfig\Business\Reader\YamlReader
     */
    public function createReader(): ReaderInterface
    {
        return new YamlReader();
    }

    /**
     * @return \Xervice\YamlConfig\Business\Hydrator\HydratorCollection
     */
    public function getHydratorCollection(): HydratorCollection
    {
        return $this->getDependency(YamlConfigDependencyProvider::HYDRATOR_COLLECTION);
    }
}