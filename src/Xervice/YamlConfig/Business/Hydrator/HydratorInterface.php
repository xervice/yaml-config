<?php
declare(strict_types=1);


namespace Xervice\YamlConfig\Business\Hydrator;


use DataProvider\YamlConfigDataProvider;

interface HydratorInterface
{
    /**
     * @param array $data
     * @param \DataProvider\YamlConfigDataProvider $dataProvider
     *
     * @return \DataProvider\YamlConfigDataProvider
     * @throws \Xervice\YamlConfig\Business\Exception\ConfigException
     */
    public function hydrateConfig(array $data, YamlConfigDataProvider $dataProvider): YamlConfigDataProvider;
}