<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ProductController extends AbstractController
{


    #[Route('/product', name: 'app_product',methods:'POST')]
    public function createProduct(Request $request,ManagerRegistry $doctrine): Response
    {

        $data = json_decode($request->getContent(), true);

        $entityManager = $doctrine->getManager();
        $product = new Product();
        $product->setTitle('$data');
        $product->setPrice(1999);
        $product->setQuantity(1);

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($product);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new product with id '.$product->getId());
    }


}
