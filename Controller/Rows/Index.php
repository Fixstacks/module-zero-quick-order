<?php
/**
 * Copyright © 2026 Roman Pasichnyk
 * SPDX-License-Identifier: OSL-3.0 OR AFL-3.0
 */

declare(strict_types=1);

namespace Zero\QuickOrder\Controller\Rows;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Result\Layout;
use Magento\Framework\View\Result\LayoutFactory;

/**
 * HTMX: five more empty rows for the form, numbered from `from`
 * (templates/rows.phtml).
 */
class Index implements HttpGetActionInterface
{
    private const BLOCK_NAME = 'zero.quickorder.rows';
    public const BATCH = 5;

    public function __construct(
        private readonly LayoutFactory $resultLayoutFactory,
        private readonly RequestInterface $request
    ) {
    }

    /**
     * @return Layout
     */
    public function execute()
    {
        $result = $this->resultLayoutFactory->create();
        $result->addDefaultHandle();
        $result->getLayout()->getBlock(self::BLOCK_NAME)?->addData([
            'from' => max(0, min(500, (int) $this->request->getParam('from', 0))),
            'count' => self::BATCH,
        ]);
        $result->getLayout()->addOutputElement(self::BLOCK_NAME);

        return $result;
    }
}
