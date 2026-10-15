<?php
/**
 * Copyright © 2026 Roman Pasichnyk
 * SPDX-License-Identifier: OSL-3.0 OR AFL-3.0
 *
 * Zero_QuickOrder: a /quickorder page where a shopper who knows the SKUs
 * fills a cart in one go, from rows of SKU and quantity, a pasted list or
 * a CSV file.
 */

use Magento\Framework\Component\ComponentRegistrar;

ComponentRegistrar::register(ComponentRegistrar::MODULE, 'Zero_QuickOrder', __DIR__);
