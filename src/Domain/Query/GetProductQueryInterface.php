<?php

/**
 * Copyright © Bold Brand Commerce Sp. z o.o. All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types = 1);

namespace Ergonode\Product\Domain\Query;

use Ergonode\Core\Domain\ValueObject\Language;
use Ergonode\Product\Domain\Entity\ProductId;

/**
 */
interface GetProductQueryInterface
{
    /**
     * @param ProductId $productId
     * @param Language  $language
     *
     * @return array
     */
    public function query(ProductId $productId, Language $language): array;
}
