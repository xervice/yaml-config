<?php
declare(strict_types=1);

namespace Xervice\YamlConfig\Business\Reader;

use DataProvider\YamlConfigFileDataProvider;

interface ReaderInterface
{
    /**
     * @param \DataProvider\YamlConfigFileDataProvider $dataProvider
     *
     * @return array
     */
    public function getArrayFromFile(YamlConfigFileDataProvider $dataProvider): array;
}