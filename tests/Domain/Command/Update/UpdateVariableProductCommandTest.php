<?php
/**
 * Copyright © Bold Brand Commerce Sp. z o.o. All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types = 1);

namespace Ergonode\Product\Tests\Domain\Command\Update;

use Ergonode\SharedKernel\Domain\Aggregate\CategoryId;
use Ergonode\SharedKernel\Domain\Aggregate\ProductId;
use PHPUnit\Framework\TestCase;
use Ergonode\SharedKernel\Domain\Aggregate\TemplateId;
use Ergonode\Product\Domain\Command\Update\UpdateVariableProductCommand;
use Ergonode\SharedKernel\Domain\Aggregate\AttributeId;
use Ergonode\Value\Domain\ValueObject\ValueInterface;

/**
 */
class UpdateVariableProductCommandTest extends TestCase
{
    /**
     * @param ProductId  $id
     * @param TemplateId $templateId
     * @param array      $categories
     * @param array      $bindings
     *
     * @dataProvider dataProvider
     */
    public function testCreateCommand(
        ProductId $id,
        TemplateId $templateId,
        array $categories,
        array $bindings
    ): void {
        $command = new UpdateVariableProductCommand($id, $templateId, $categories, $bindings);

        self::assertSame($id, $command->getId());
        self::assertSame($templateId, $command->getTemplateId());
        self::assertSame($categories, $command->getCategories());
        self::assertSame($bindings, $command->getBindings());
    }

    /**
     * @return array
     *
     * @throws \Exception
     */
    public function dataProvider(): array
    {
        return [
            [
                $this->createMock(ProductId::class),
                $this->createMock(TemplateId::class),
                [
                    $this->createMock(CategoryId::class),
                    $this->createMock(CategoryId::class),
                ],
                [
                    $this->createMock(AttributeId::class),
                ],
            ],
        ];
    }
}
