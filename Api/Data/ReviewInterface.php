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

namespace PHAS\ExportReviews\Api\Data;

/**
 * Interface ReviewInterface
 * @api
 */
interface ReviewInterface
{
    /**
     * @return array
     */
    public function getReviews(): array;

    /**
     * @param string $sku
     * @return array
     */
    public function getReviewsBySku(string $sku): array;
}
