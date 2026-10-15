<?php
/**
 * Copyright © 2026 Roman Pasichnyk
 * SPDX-License-Identifier: OSL-3.0 OR AFL-3.0
 */

declare(strict_types=1);

namespace Zero\QuickOrder\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

/**
 * Stores > Configuration > Zero > Quick Order (defaults in etc/config.xml).
 */
class Config
{
    public const XML_PATH_ENABLED = 'zero_quick_order/general/enabled';
    public const XML_PATH_FOOTER_LINK = 'zero_quick_order/general/footer_link';
    private const XML_PATH_ROWS = 'zero_quick_order/general/rows';

    public function __construct(
        private readonly ScopeConfigInterface $scopeConfig
    ) {
    }

    public function isEnabled(?int $storeId = null): bool
    {
        return $this->scopeConfig->isSetFlag(self::XML_PATH_ENABLED, ScopeInterface::SCOPE_STORE, $storeId);
    }

    /**
     * SKU rows on the page to start with.
     */
    public function rows(?int $storeId = null): int
    {
        return max(1, min(50, (int) $this->scopeConfig->getValue(self::XML_PATH_ROWS, ScopeInterface::SCOPE_STORE, $storeId) ?: 5));
    }
}
