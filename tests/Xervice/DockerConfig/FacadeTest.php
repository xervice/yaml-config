<?php

namespace XerviceTest\YamlConfig;

use DataProvider\YamlConfigDataProvider;
use DataProvider\YamlConfigEnvironmentDataProvider;
use DataProvider\YamlConfigFileDataProvider;
use DataProvider\YamlConfigFileListDataProvider;
use Xervice\Core\Locator\Dynamic\DynamicLocator;

/**
 * @method \Xervice\YamlConfig\YamlConfigFacade getFacade()
 */
class FacadeTest extends \Codeception\Test\Unit
{
    use DynamicLocator;

    /**
     * @group Xervice
     * @group YamlConfig
     * @group Facade
     * @group Integration
     * @throws \Core\Locator\Dynamic\ServiceNotParseable
     */
    public function testGetConfig()
    {
        $this->assertEquals(
            $this->getExpectedConfigForFile(),
            $this->getFacade()->getYamlConfig($this->getExampleFileDTO())
        );
    }

    /**
     * @return \DataProvider\YamlConfigFileListDataProvider
     */
    private function getExampleFileDTO(): YamlConfigFileListDataProvider
    {
        $configFile = new YamlConfigFileDataProvider();
        $configFile->setPath(__DIR__ . '/data/example.yml');

        $fileList = new YamlConfigFileListDataProvider();
        $fileList->addFile($configFile);

        return $fileList;
    }

    /**
     * @return \DataProvider\YamlConfigDataProvider
     */
    private function getExpectedConfigForFile(): YamlConfigDataProvider
    {
        return new YamlConfigDataProvider();
    }
}