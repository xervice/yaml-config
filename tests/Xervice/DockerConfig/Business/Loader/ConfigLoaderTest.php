<?php

namespace XerviceTest\YamlConfig\Business\Loader;

use DataProvider\YamlConfigDataProvider;
use DataProvider\YamlConfigFileDataProvider;
use DataProvider\YamlConfigFileListDataProvider;
use Xervice\YamlConfig\Business\Hydrator\HydratorCollection;
use Xervice\YamlConfig\Business\Hydrator\HydratorInterface;
use Xervice\YamlConfig\Business\Loader\ConfigLoader;
use Xervice\YamlConfig\Business\Reader\ReaderInterface;
use Xervice\Core\Locator\Dynamic\DynamicLocator;

/**
 * @method \Xervice\YamlConfig\YamlConfigFacade getFacade()
 */
class ConfigLoaderTest extends \Codeception\Test\Unit
{
    use DynamicLocator;

    /**
     * @group Xervice
     * @group YamlConfig
     * @group Business
     * @group Loader
     * @group ConfigLoader
     * @group Integration
     */
    public function testGetConfig()
    {
        $testFile = new YamlConfigFileDataProvider();
        $testFile->setPath('test/test');

        $testHydrator = $this->getTestHydrator();
        $testReader = $this->getTestFileReader($testFile);


        $fileList = new YamlConfigFileListDataProvider();
        $fileList->addFile($testFile);

        $collection = new HydratorCollection(
            [
                $testHydrator
            ]
        );

        $configLoader = new ConfigLoader(
            $fileList,
            $testReader,
            $collection
        );

        $this->assertInstanceOf(
            YamlConfigDataProvider::class,
            $configLoader->getConfig()
        );
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    private function getTestHydrator(): \PHPUnit\Framework\MockObject\MockObject
    {
        $testHydrator = $this->getMockBuilder(HydratorInterface::class)
                             ->setMethods(['hydrateConfig'])
                             ->getMock();

        $testHydrator->expects($this->once())
                     ->method('hydrateConfig')
                     ->with(
                         $this->equalTo(['test' => ['test']]),
                         $this->isInstanceOf(YamlConfigDataProvider::class)
                     )
                     ->willReturn(new YamlConfigDataProvider())
        ;
        return $testHydrator;
    }

    /**
     * @param $testFile
     *
     * @return \Xervice\YamlConfig\Business\Reader\ReaderInterface
     */
    private function getTestFileReader($testFile): ReaderInterface
    {
        $testFileReader = $this->getMockBuilder(ReaderInterface::class)
                               ->setMethods(['getArrayFromFile'])
                               ->getMock();

        $testFileReader->expects($this->once())
                       ->method('getArrayFromFile')
                       ->with($this->equalTo($testFile))
                       ->willReturn(['test' => ['test']]);

        return $testFileReader;
    }
}