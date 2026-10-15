<?php
/**
 * Copyright © 2026 Roman Pasichnyk
 * SPDX-License-Identifier: OSL-3.0 OR AFL-3.0
 */

declare(strict_types=1);

namespace Zero\QuickOrder\ViewModel;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Zero\QuickOrder\Controller\Rows\Index as Rows;
use Zero\QuickOrder\Model\AddToCart;
use Zero\QuickOrder\Model\Config;

/**
 * The quick order page and its fragments (templates/).
 */
class QuickOrder implements ArgumentInterface
{
    public function __construct(
        private readonly Config $config,
        private readonly AddToCart $addToCart,
        private readonly UrlInterface $url
    ) {
    }

    /**
     * SKU rows the page starts with.
     */
    public function rows(): int
    {
        return $this->config->rows();
    }

    public function batch(): int
    {
        return Rows::BATCH;
    }

    public function addUrl(): string
    {
        return $this->url->getUrl('quickorder/cart/add');
    }

    public function lookupUrl(): string
    {
        return $this->url->getUrl('quickorder/product/lookup');
    }

    public function rowsUrl(): string
    {
        return $this->url->getUrl('quickorder/rows/index');
    }

    /**
     * @return array{name: string, price: string, salable: bool, url: string}|null
     */
    public function lookup(string $sku): ?array
    {
        return $sku === '' ? null : $this->addToCart->lookup($sku);
    }
}
