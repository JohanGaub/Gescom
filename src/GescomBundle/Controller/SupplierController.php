<?php

namespace GescomBundle\Controller;

use GescomBundle\Entity\Supplier;
use GescomBundle\Form\SupplierType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SupplierController extends Controller
{


    /**
     * @return Response
     * @Route("/listsupplier", name="listsupplier")
     */

    public function indexAction()
    {
        $suppliers = $this->getDoctrine()->getRepository('GescomBundle:Supplier')->findAll();

        return $this->render('@Gescom/Supplier/listsupplier.html.twig', [
            'suppliers' => $suppliers,
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Response
     * @Route("addsupplier", name="addsupplier")
     */


    public function addAction(Request $request)
    {
        $supplier       =   new Supplier();
        $em             =   $this->getDoctrine()->getManager();
        $form           =   $this->createForm(SupplierType::class, $supplier);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em->persist($supplier);
            $em->flush();
            return $this->redirectToRoute('listsupplier');
        }

        return $this->render('@Gescom/Supplier/addsupplier.html.twig', [
            'form'      =>  $form->createView(),
            ]);
    }
}
