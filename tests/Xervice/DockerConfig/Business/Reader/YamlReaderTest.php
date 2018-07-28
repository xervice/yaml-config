<?php
namespace XerviceTest\YamlConfig\Business\Reader;

use DataProvider\YamlConfigFileDataProvider;
use Xervice\YamlConfig\Business\Reader\YamlReader;

class YamlReaderTest extends \Codeception\Test\Unit
{
    /**
     * @group Xervice
     * @group YamlConfig
     * @group Business
     * @group Reader
     * @group YamlReader
     * @group Integration
     */
    public function testGetArrayFromYaml()
    {
        $file = new YamlConfigFileDataProvider();
        $file->setPath(
            dirname(dirname(__DIR__)) . '/data/example.yml'
        );

        $yamlReader = new YamlReader();

        $this->assertEquals(
            [
                'example_not_existing_conf' => [
                    'php71' => [
                        'type' => 'PHP',
                        'version' => '7.1',
                        'extensions' => [
                            'intl',
                            'curl'
                        ],
                        'pecl' => [
                            'redis'
                        ]
                    ]
                ]
            ],
            $yamlReader->getArrayFromFile($file)
        );
    }
}