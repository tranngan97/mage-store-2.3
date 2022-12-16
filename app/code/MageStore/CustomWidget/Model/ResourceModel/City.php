<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace MageStore\CustomWidget\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class City extends AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('open_weather_city_list', 'city_id');
    }
}
