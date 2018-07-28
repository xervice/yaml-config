<?php
declare(strict_types=1);


namespace Xervice\YamlConfig\Business\Reader;


use DataProvider\YamlConfigFileDataProvider;
use Symfony\Component\Yaml\Yaml;

class YamlReader implements ReaderInterface
{
    /**
     * @param \DataProvider\YamlConfigFileDataProvider $dataProvider
     *
     * @return array
     * @throws \Symfony\Component\Yaml\Exception\ParseException
     */
    public function getArrayFromFile(YamlConfigFileDataProvider $dataProvider): array
    {
        return (array) Yaml::parse(
            file_get_contents(
                $dataProvider->getPath()
            )
        );
    }
}