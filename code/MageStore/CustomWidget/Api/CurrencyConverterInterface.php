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
 * Get Currency Rate
 * @api
 * @since 100.0.2
 */
interface CurrencyConverterInterface
{
    /**
     * Create new gallery entry
     *
     * @return bool
     */
    public function getAllRate();
}
