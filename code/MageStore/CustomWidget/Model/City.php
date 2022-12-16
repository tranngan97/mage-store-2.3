<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace MageStore\CustomWidget\Model;

class City extends \Magento\Framework\Model\AbstractModel
{
    protected function _construct()
    {
        $this->_init(\MageStore\CustomWidget\Model\ResourceModel\City::class);
    }
}
