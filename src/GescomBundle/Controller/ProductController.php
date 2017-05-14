<?php

namespace GescomBundle\Controller;

use GescomBundle\Entity\Product;
use GescomBundle\Entity\ProductSupplier;
use GescomBundle\Form\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends Controller
{
    /**
     * @Route("/listproduct", name="listproduct")
     */
    public function indexAction()
    {
        // Get data from product entity
        $products = $this->getDoctrine()->getRepository('GescomBundle:Product')->findAll();
        return $this->render('@Gescom/Product/listproduct.html.twig', ['products' => $products,]);
    }

    /**
     * @Route("/addproduct", name="addproduct")
     * @param Request $request
     * @return Response
     */
    public function addAction(Request $request)
    {
        // create a damned product from my ass
        $product = new Product();
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            // JE NE COMPRENDS PAS
            $suppliers = $product->getProductSuppliers()["name"];
            // suppliers are stored with a top level "name" unecessary
            // we must remove this "name" level with this custom method
            $product->resetProductSuppliers();

            foreach($suppliers as $supplier){
                //create a new link entity
                $productSuppliers = new ProductSupplier();
                $productSuppliers->setProduct($product);
                $productSuppliers->setSupplier($supplier);

                $em->persist($productSuppliers);
                // add supplier to product
                $product->addProductSupplier($productSuppliers);
            }
            $em->persist($product);
            $em->flush();
            return $this->redirectToRoute('listproduct');
        }
        return $this->render('@Gescom/Product/addproduct.html.twig', ['form' => $form->createView(),]);
    }
}
