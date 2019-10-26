<?php

namespace App\Controller\admin;

use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/loai-sach", name="category-")
 */

class CategoryController extends AdminController
{

    /**
     * @Route("/", name="list")
     */
    public function index()
    {
        $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();
        return $this->render('admin/category/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/them-moi", name="add")
     */
    public function create()
    {
        return $this->render('admin/category/add.html.twig');
    }

    /**
     * @Route("/luu", name="store")
     */
    public function store(Request $request){
        $submittedToken = $request->request->get('token');
        if ($this->isCsrfTokenValid('insert-category', $submittedToken)) {
            $entityManager = $this->getDoctrine()->getManager();
            $category = new Category();
            $category->setCategoryName($request->request->get('category_name'));
            $category->setCreatedAt(new \DateTime());
            $entityManager->persist($category);
            $entityManager->flush();
        }
        return $this->redirectToRoute('category-list');
    }

    /**
     * @Route("/sua/{id}", name="edit")
     */
    public function edit($id)
    {
        $category = $this->getDoctrine()
            ->getRepository(Category::class)
            ->find($id);

        if (!$category) {
            throw $this->createNotFoundException(
                'Không có loại sách nào có mã '. $id
            );
        }

        return $this->render('admin/category/edit.html.twig', [
            'category' => $category,
        ]);
    }

    /**
     * @Route("/cap-nhat/{id}", name="update")
     */
    public function update(Request $request, $id){
        $submittedToken = $request->request->get('token');
        if ($this->isCsrfTokenValid('update-category', $submittedToken)) {
            $entityManager = $this->getDoctrine()->getManager();
            $category = $entityManager->getRepository(Category::class)->find($id);
            if (!$category) {
                throw $this->createNotFoundException(
                    'Không có loại sách nào có mã '. $id
                );
            }
            $category->setCategoryName($request->request->get('category_name'));
            $category->setUpdatedAt(new \DateTime());
            $entityManager->persist($category);
            $entityManager->flush();
            return $this->redirectToRoute('category-list');
        }
        return $this->redirectToRoute('category-list');
    }

    /**
     * @Route("/xoa/{id}", name="delete")
     */
    public function destroy(Request $request, $id)
    {
        $submittedToken = $request->request->get('token');
        if ($this->isCsrfTokenValid('delete-item', $submittedToken)) {
            $entityManager = $this->getDoctrine()->getManager();
            $category = $entityManager->getRepository(Category::class)->find($id);
            $entityManager->remove($category);
            $entityManager->flush();
        }
        return $this->redirectToRoute('category-list');
    }
}
