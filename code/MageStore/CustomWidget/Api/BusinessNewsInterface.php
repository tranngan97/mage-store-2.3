<?php
/**
 * Product Media Attribute Write Service
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace MageStore\CustomWidget\Api;

use Magento\Framework\Exception\InputException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\StateException;

/**
 * Get Business news.
 * @api
 * @since 100.0.2
 */
interface BusinessNewsInterface
{
    /**
     * Create new gallery entry
     *
     * @return bool
     */
    public function getNewsList();
}
