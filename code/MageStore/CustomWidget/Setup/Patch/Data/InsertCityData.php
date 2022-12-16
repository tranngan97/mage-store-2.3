<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MageStore\CustomWidget\Setup\Patch\Data;

use Magento\Framework\App\ResourceConnection;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class InsertCityData implements DataPatchInterface
{
    /**
     * @var ResourceConnection
     */
    protected $resourceConnection;

    /**
     * @param ResourceConnection $resourceConnection
     */
    public function __construct(
        ResourceConnection $resourceConnection
    )
    {
        $this->resourceConnection = $resourceConnection;
    }

    /**
     * @inheritDoc
     *
     * @throws LocalizedException
     */
    public function apply()
    {
        $filePath = 'app/code/MageStore/CustomWidget/json/city.list.json';
        $data = json_decode(file_get_contents($filePath), true);
        $connection = $this->resourceConnection->getConnection();
        $connection->beginTransaction();
        $insertData = [];
        foreach ($data as $rowData) {
            $insertData[] = [
                'city_id' => $rowData['id'],
                'city_name' => $rowData['name'],
                'country_id' => $rowData['country'],
                'state' => $rowData['state'],
                'lat' => $rowData['coord']['lat'],
                'lon' => $rowData['coord']['lon']
            ];
        }
        $connection->insertMultiple(
            'open_weather_city_list',
            $insertData
        );
        $connection->commit();
    }

    /**
     * @inheritDoc
     */
    public function getAliases()
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    public static function getDependencies()
    {
        return [];
    }
}
