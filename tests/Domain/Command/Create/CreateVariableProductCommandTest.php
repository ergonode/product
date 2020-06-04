<?php
/**
 * Copyright © Bold Brand Commerce Sp. z o.o. All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types = 1);

namespace Ergonode\Product\Tests\Domain\Command\Create;

use Ergonode\SharedKernel\Domain\Aggregate\CategoryId;
use Ergonode\SharedKernel\Domain\Aggregate\ProductId;
use Ergonode\Product\Domain\ValueObject\Sku;
use Ergonode\Value\Domain\ValueObject\ValueInterface;
use PHPUnit\Framework\TestCase;
use Ergonode\Product\Domain\Command\Create\CreateVariableProductCommand;
use Ergonode\SharedKernel\Domain\Aggregate\TemplateId;
use Ergonode\SharedKernel\Domain\Aggregate\AttributeId;

/**
 */
class CreateVariableProductCommandTest extends TestCase
{
    /**
     * @param ProductId  $id
     * @param Sku        $sku
     * @param TemplateId $templateId
     * @param array      $categories
     * @param array      $bindings
     * @param array      $attributes
     *
     * @dataProvider dataProvider
     */
    public function testCreateCommand(
        ProductId $id,
        Sku $sku,
        TemplateId $templateId,
        array $categories,
        array $bindings,
        array $attributes
    ): void {
        $command = new CreateVariableProductCommand($id, $sku, $templateId, $categories, $bindings, $attributes);

        $this->assertSame($id, $command->getId());
        $this->assertSame($sku, $command->getSku());
        $this->assertSame($categories, $command->getCategories());
        $this->assertSame($attributes, $command->getAttributes());
        $this->assertSame($bindings, $command->getBindings());
        $this->assertSame($templateId, $command->getTemplateId());
        $this->assertNotNull($command->getId());
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
                $this->createMock(Sku::class),
                $this->createMock(TemplateId::class),
                [
                    $this->createMock(CategoryId::class),
                    $this->createMock(CategoryId::class),
                ],
                [
                    $this->createMock(AttributeId::class),
                ],
                [
                    'code1' => $this->createMock(ValueInterface::class),
                    'code2' => $this->createMock(ValueInterface::class),
                ],
            ],
        ];
    }
}
