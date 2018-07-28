<?php
declare(strict_types=1);


namespace Xervice\YamlConfig\Business\Loader;


use DataProvider\YamlConfigDataProvider;
use DataProvider\YamlConfigFileListDataProvider;
use Xervice\YamlConfig\Business\Hydrator\HydratorCollection;
use Xervice\YamlConfig\Business\Reader\ReaderInterface;

class ConfigLoader implements ConfigLoaderInterface
{
    /**
     * @var YamlConfigFileListDataProvider
     */
    private $fileList;

    /**
     * @var \Xervice\YamlConfig\Business\Reader\ReaderInterface
     */
    private $fileReader;

    /**
     * @var \Xervice\YamlConfig\Business\Hydrator\HydratorCollection
     */
    private $hydratorCollection;

    /**
     * ConfigLoader constructor.
     *
     * @param YamlConfigFileListDataProvider $fileList
     * @param \Xervice\YamlConfig\Business\Reader\ReaderInterface $fileReader
     * @param \Xervice\YamlConfig\Business\Hydrator\HydratorCollection $hydratorCollection
     */
    public function __construct(
        YamlConfigFileListDataProvider $fileList,
        ReaderInterface $fileReader,
        HydratorCollection $hydratorCollection
    ) {
        $this->fileList = $fileList;
        $this->fileReader = $fileReader;
        $this->hydratorCollection = $hydratorCollection;
    }


    /**
     * @return \DataProvider\YamlConfigDataProvider
     * @throws \Xervice\YamlConfig\Business\Exception\ConfigException
     */
    public function getConfig(): YamlConfigDataProvider
    {
        $config = new YamlConfigDataProvider();

        foreach ($this->fileList->getFiles() as $file) {
            $configData = $this->fileReader->getArrayFromFile($file);
            $config = $this->hydrateConfigs($configData, $config);
        }

        return $config;
    }

    /**
     * @param $configData
     * @param $config
     *
     * @return \DataProvider\YamlConfigDataProvider
     * @throws \Xervice\YamlConfig\Business\Exception\ConfigException
     */
    private function hydrateConfigs($configData, $config): YamlConfigDataProvider
    {
        foreach ($this->hydratorCollection as $hydrator) {
            $config = $hydrator->hydrateConfig($configData, $config);
        }
        return $config;
    }

}