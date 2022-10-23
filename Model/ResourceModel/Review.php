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

        $approvedStatusId = 1;

        $select = $connection->select()->from(
            ['r' => $this->reviewTable],
            ['r.review_id', 'r.status_id', 'r.entity_pk_value', 'rd.title', 'rd.detail', 'res.rating_summary', 'cpe.sku']
        )->joinLeft(
            ['rd' => $this->getTable('review_detail')],
            'rd.review_id = r.review_id',
            []
        )->joinLeft(
            ['res' => $this->getTable('review_entity_summary')],
            'rd.review_id = res.primary_id',
            []
        )->joinLeft(
            ['cpe' => $this->getTable('catalog_product_entity')],
            'r.entity_pk_value = cpe.entity_id',
            []
        );

        $select->where('r.status_id = ?', $approvedStatusId);

        $selectString = $select->__toString();
        $result = $connection->fetchAll($select);
        return $result;
    }
}
