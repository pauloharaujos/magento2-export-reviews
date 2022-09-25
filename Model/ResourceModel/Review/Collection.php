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

namespace PHAS\ExportReviews\Model\ResourceModel\Review;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'review_id';
    protected $_eventPrefix = 'phas_export_reviews_collection';
    protected $_eventObject = 'review_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('PHAS\ExportReviews\Model\Review', 'PHAS\ExportReviews\Model\ResourceModel\Review');
    }
}
