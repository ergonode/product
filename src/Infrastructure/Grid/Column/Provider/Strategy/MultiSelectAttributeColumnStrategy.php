<?php

/**
 * Copyright © Bold Brand Commerce Sp. z o.o. All rights reserved.
 * See license.txt for license details.
 */

declare(strict_types = 1);

namespace Ergonode\Product\Infrastructure\Grid\Column\Provider\Strategy;

use Ergonode\Attribute\Domain\Entity\AbstractAttribute;
use Ergonode\Attribute\Domain\Entity\Attribute\AbstractOptionAttribute;
use Ergonode\Attribute\Domain\Entity\Attribute\MultiSelectAttribute;
use Ergonode\Attribute\Domain\ValueObject\OptionValue\MultilingualOption;
use Ergonode\Attribute\Domain\ValueObject\OptionValue\StringOption;
use Ergonode\Core\Domain\ValueObject\Language;
use Ergonode\Grid\Column\MultiSelectColumn;
use Ergonode\Grid\ColumnInterface;
use Ergonode\Grid\Filter\MultiSelectFilter;
use Ergonode\Grid\Request\FilterCollection;

/**
 */
class MultiSelectAttributeColumnStrategy implements AttributeColumnStrategyInterface
{
    /**
     * @param AbstractAttribute $attribute
     *
     * @return bool
     */
    public function isSupported(AbstractAttribute $attribute): bool
    {
        return $attribute->getType() ===  MultiSelectAttribute::TYPE;
    }

    /**
     * @param AbstractAttribute|AbstractOptionAttribute $attribute
     * @param Language                                  $language
     * @param FilterCollection                          $filter
     *
     * @return ColumnInterface
     *
     */
    public function create(AbstractAttribute $attribute, Language $language, FilterCollection $filter): ColumnInterface
    {
        $options = [];
        foreach ($attribute->getOptions() as $id => $option) {
            if ($option instanceof StringOption) {
                $options[$id] = $option->getValue();
            }
            if ($option instanceof MultilingualOption) {
                $options[$id] = $option->getValue()->get($language);
            }
        }

        $key = $attribute->getCode()->getValue();

        return new MultiSelectColumn($key, $attribute->getLabel()->get($language), new MultiSelectFilter($options, $filter->getArray($key)));
    }
}
