<?php

namespace App\AdminBundle\Controller;

use App\AdminBundle\Entity111\ProductCategory;
use App\AdminBundle\Form\NewCategory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Tests\Fixtures\Validation\Category;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {
    public function indexAction() {
        return $this->render( 'admin/index.html.twig' );
    }

    public function listCategoriesAction( Request $request ) {

        $newCategory = new ProductCategory();

        $form        = $this->createForm( NewCategory::class, $newCategory);

//        $form        = $this->createForm( NewCategory::class, $newCategory, array(
//            'entity_manager' => $this->getDoctrine()->getManager(),
//        ) );

        $form->handleRequest( $request );

        if ( $form->isSubmitted() && $form->isValid() ) {

            $category = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist( $category );
            $em->flush();

            // Reset form after submit
            $newCategory = new ProductCategory();
            $form        = $this->createForm( NewCategory::class, $newCategory );
        }


        $categories = $this->getDoctrine()->getRepository( ProductCategory::class )->findBy( [ 'parent' => null ] );

        return $this->render( 'admin/categories/categories-list.html.twig', array(
            'categories' => $categories,
            'form'       => $form->createView()
        ) );
    }

    function removeCategoryAction(Request $request, $id)
    {
        $category = $this->getDoctrine()->getRepository(ProductCategory::class)->findOneBy(['id' => $id]);
        $backUrl = $request->headers->get('referer');

        if($category) {
            $em = $this->getDoctrine()->getManager();
            $em->remove( $category );
            $em->flush();
        }

        return $this->redirect($backUrl);
    }
}
