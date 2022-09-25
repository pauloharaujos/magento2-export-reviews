<?php

/**
 * Export Reviews Extension by Paulo Henrique Araujo da Silva
 *
 * @category  PHAS
 * @package   PHAS_ExportReviews
 * @author    Paulo Henrique Araujo da Silva <pauloharaujos@gmail.com>
 * @copyright Copyright (c) 2022 Paulo Henrique Araujo da Silva (https://github.com/pauloharaujos)
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types=1);

namespace PHAS\ExportReviews\Model;

use Magento\Framework\Model\AbstractModel;
use PHAS\ExportReviews\Api\Data\ReviewInterface;

class Review extends AbstractModel implements ReviewInterface
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\PHAS\ExportReviews\Model\ResourceModel\Review::class);
    }

    /**
     * Load Reviews data from resource model
     *
     * @return array
     */
    public function getReviews() : array
    {
        $this->addData($this->getResource()->loadReviews());
        return $this->getData();
    }
}
