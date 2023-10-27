<?php
namespace App\Factory;

use App\Entity\Product;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;

class ProductFactory
{
    #[Pure]
    #[ArrayShape(['name' => "null|string", 'quantity' => "int|null", 'priceNet' => "int|null", 'priceGross' => "int|null", 'vatRate' => "int|null"])]
    public function create(Product $product): array
    {
        return [
            'name' => $product->getName(),
            'quantity' => $product->getQuantity(),
            'priceNet' => $product->getPriceNet(),
            'priceGross' => $product->getPriceGross(),
            'vatRate' => $product->getVatRate()
        ];
    }
}
