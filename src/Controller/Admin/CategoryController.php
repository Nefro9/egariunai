<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Form\CategoryForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/category")
 */
class CategoryController extends Controller
{
    /**
     * @Route("/", name="category-list")
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function categoryList(Request $request)
    {
        $category = new Category();
        $form = $this->createForm(CategoryForm::class, $category);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            $this->addFlash('success', 'Category successful created');

            return $this->redirectToRoute('category-list');
        }

        $categories = $this->getDoctrine()->getRepository(Category::class)->findAllOrder();

        return $this->render('admin/category/category-list.html.twig', [
            'items' => $categories,
            'form'  => $form->createView()
        ]);
    }

    /**
     * @Route("/edit/{category}", name="category-edit")
     *
     * @param Request $request
     *
     * @param Category $category
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function categoryEdit(Request $request, Category $category)
    {
        $form = $this->createForm(CategoryForm::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            $this->addFlash('success', 'Category successful updated');

            return $this->redirectToRoute('category-edit', ['category' => $category->getId()]);
        }


        return $this->render('admin/category/category-edit.html.twig', [
            'form' => $form->createView(),
            'item' => $category
        ]);
    }

    /**
     * @Route("/delete/{category}", name="category-delete")
     * @param Category $category
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function categoryDelete(Category $category)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($category);
        $em->flush();

        $this->addFlash('success', 'Category successful deleted');

        return $this->redirectToRoute('category-list');
    }
}