<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace MageStore\CustomWidget\Model;

use Magento\Framework\Model\AbstractModel;

class News extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(ResourceModel\News::class);
    }
}
