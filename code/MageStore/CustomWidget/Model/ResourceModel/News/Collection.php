<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace MageStore\CustomWidget\Model\ResourceModel\News;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use MageStore\CustomWidget\Model\ResourceModel\News;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(\MageStore\CustomWidget\Model\News::class, News::class);
    }
}
