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

namespace PHAS\ExportReviews\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Review extends AbstractDb
{
    /**
     * Review table
     *
     * @var string
     */
    protected string $reviewTable;

    /**
     * Review Entity Summary table
     *
     * @var string
     */
    protected string $reviewEntitySummaryTable;

    /**
     * Review Detail table
     *
     * @var string
     */
    protected string $reviewDetailTable;

    /**
     * Initialize resource model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('review', 'review_id');
        $this->reviewTable = $this->getTable('review');
        $this->reviewEntitySummaryTable = $this->getTable('review_entity_summary');
        $this->reviewDetailTable = $this->getTable('review_detail');
    }
    /**
     * Load reviews from DB
     *
     * @return array
     */
    public function loadReviews(): array
    {
        $connection = $this->getConnection();
        $select = $connection->select()->from(
            $this->reviewTable,
            ['review_id', 'status_id', 'entity_pk_value']
        );
        return $connection->fetchCol($select);
    }
}
