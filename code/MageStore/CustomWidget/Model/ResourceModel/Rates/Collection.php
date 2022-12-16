<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace MageStore\CustomWidget\Model\ResourceModel\Rates;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init(\MageStore\CustomWidget\Model\Rates::class, \MageStore\CustomWidget\Model\ResourceModel\Rates::class);
    }
}
