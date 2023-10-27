<?php
namespace App\Service;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use InvalidArgumentException;

class ProductService
{
    public function __construct(
        private ProductRepository $products,
        private EntityManagerInterface $entityManager
    ){
    }

    /**
     * @throws Exception
     */
    public function create(
        string $name,
        int $quantity,
        int $priceNet,
        int $priceGross,
        int $vatRate,
    ): void
    {
        if($this->products->findProductByName($name)) {
            throw new InvalidArgumentException("A product with name $name already exists");
        }
        $product = new Product();
        $product->setName($name);
        $product->setQuantity($quantity);
        $product->setPriceNet($priceNet);
        $product->setPriceGross($priceGross);
        $product->setVatRate($vatRate);

        try {
            $this->entityManager->persist($product);
            $this->entityManager->flush();
        } catch (Exception $exception) {
            throw new Exception('Entity manager save product error');
        }
    }

    public function getAll(): array
    {
        return $this->products->findAll();
    }

    public function getByName(string $name): ?Product
    {
        return $this->products->findProductByName($name);
    }

    public function delete(Product $product)
    {
        $this->entityManager->remove($product);
        $this->entityManager->flush();
    }

    public function update(Product $product, ?string $name, ?int $quantity, ?int $priceNet, ?int $priceGross, ?int $vatRate)
    {
        if ($name) {
            $product->setName($name);
        }
        if ($quantity) {
            $product->setQuantity($quantity);
        }
        if ($priceNet) {
            $product->setPriceNet($priceNet);
        }
        if ($priceGross) {
            $product->setPriceGross($priceGross);
        }
        if ($vatRate) {
            $product->setVatRate($vatRate);
        }

        $this->entityManager->persist($product);
        $this->entityManager->flush();
    }
}
