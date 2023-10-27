<?php

namespace App\Controller;

use App\Entity\Product;
use App\Factory\ProductFactory;
use App\Repository\ProductRepository;
use App\Service\NewProductValidator;
use App\Service\ProductService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/product', name: 'api_product')]
class ProductController extends AbstractController
{
    public function __construct(
        private ProductService $productService,
//        private NewProductValidator $validator,
    ){
    }
    /**
     * @throws \Exception
     */
    #[Route('/new', name: 'product_new', methods: ['POST'])]
    public function new(Request $request, NewProductValidator $validator): JsonResponse
    {
        $validator->validate($request->getPayload()->all());

        if ($validator->isValid()) {
            $data = json_decode($request->getContent(), true);
            $this->productService->create(
                $data['name'],
                $data['quantity'],
                $data['priceNet'],
                $data['priceGross'],
                $data['vatRate']
            );
        }
        return $this->json('Product created successfully');
    }

    #[Route('/update/{id}', name: 'product_update', methods: ['PUT','PATCH'])]
    public function update(Request $request, Product $product, $id): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $this->productService->update(
            $product,
            $data['name'] ?? null,
            $data['quantity'] ?? null,
            $data['priceNet'] ?? null,
            $data['priceGross'] ?? null,
            $data['vatRate'] ?? null
        );

        return $this->json('Product updated successfully');
    }

    #[Route('/list', name: 'products_list', methods: ['GET'])]
    public function list(ProductRepository $productRepository): Response
    {
        $products = $productRepository->findAll();

        return $this->render('products/list.html.twig', [
            'products' => $products,
        ]);
    }

    #[Route('/show/{id}', name: 'product_show', methods: ['GET'])]
    public function show(Product $product, ProductFactory $factory): Response
    {
        return $this->json($factory->create($product), 200);
    }

    #[Route('/delete/{id}', name: 'product_delete', methods: ['DELETE'])]
    public function delete(Product $product, int $id): JsonResponse
    {
        $this->productService->delete($product);

        return $this->json('Deleted a product successfully with id ' . $id);
    }
}
