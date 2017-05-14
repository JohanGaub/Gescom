<?php

namespace GescomBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;


class MainController extends Controller
{
    /**
     * @Route("/home", name="home")
     * @return Response
     */

    public function indexAction()
    {
        $totalProducts      =   $this->getDoctrine()
            ->getRepository('GescomBundle:Product')
            ->createQueryBuilder('p')
            ->select('COUNT(p)');
        $totalSuppliers     =   $this->getDoctrine()
            ->getRepository('GescomBundle:Supplier')
            ->createQueryBuilder('s')
            ->select('COUNT(s)');
        $totalCategories    =   $this->getDoctrine()
            ->getRepository('GescomBundle:Category')
            ->createQueryBuilder('c')
            ->select('COUNT(c)');

        return $this->render('@Gescom/Main/index.html.twig', [
            'totalProducts'     =>  $totalProducts->getQuery()->getSingleScalarResult(),
            'totalSuppliers'    =>  $totalSuppliers->getQuery()->getSingleScalarResult(),
            'totalCategories'   =>  $totalCategories->getQuery()->getSingleScalarResult(),
        ]);
    }

    /**
     * @Route("/admin")
     * @return Response
     */
    public function adminAction()
    {
        return new Response(
            ('<html><body>Admin page!</body></html>'));
    }
}
