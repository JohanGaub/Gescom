<?php

namespace GescomBundle\Controller;

use GescomBundle\Entity\Category;
use GescomBundle\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends Controller
{

    /**
     * @return Response
     * @internal param $name
     * @Route("/listcategory", name="listcategory")
     */
    public function indexAction()
    {
        $categories = $this->getDoctrine()->getRepository('GescomBundle:Category')->findAll();
        return $this->render('@Gescom/Category/listcategory.html.twig', ['categories' => $categories, ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Response
     * @Route("/addcategory", name="addcategory")
     */
    public function addAction(Request $request)
    {
        $category   =   new Category();
        $em         =   $this->getDoctrine()->getManager();
        $form       =   $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em->persist($category);
            $em->flush();
            return $this->redirectToRoute('listcategory');
        }

        return $this->render('@Gescom/Category/addcategory.html.twig', ['form' => $form->createView(),]);
    }
}
