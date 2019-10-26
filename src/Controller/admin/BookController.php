<?php

namespace App\Controller\admin;

use App\Entity\Book;
use App\Entity\Category;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/admin/sach", name="book-")
 */

class BookController extends AdminController
{

    /**
     * @Route("/", name="list")
     */
    public function index()
    {
        $books = $this->getDoctrine()
            ->getRepository(Book::class)
            ->findAll();

        return $this->render('admin/book/index.html.twig', [
            'books' => $books,
        ]);
    }

    /**
     * @Route("/them-moi", name="add")
     */
    public function create()
    {
        $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();
        return $this->render('admin/book/add.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/luu", name="store")
     */
    public function store(Request $request, ValidatorInterface $validator)
    {
        $submittedToken = $request->request->get('token');
        if ($this->isCsrfTokenValid('insert_book', $submittedToken)) {
            $category = $this->getDoctrine()->getRepository(Category::class)->find($request->request->get('category'));
            $book = new Book();
            $book->setBookName($request->request->get('book_name'));
            $book->setCategory($category);
            $book->setDescription($request->request->get('description'));
            $book->setImage($request->request->get('image'));
            $book->setPrice($request->request->get('price'));
            $book->setCreatedAt(new \DateTime());
            $errors = $validator->validate($book);
            if (count($errors) > 0){
                $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();
                return $this->render('admin/book/error.html.twig',[
                    'errors' => $errors,
                    'book_name' => $request->request->get('book_name'),
                    'category_id' => $request->request->get('category'),
                    'categories' => $categories,
                    'image' => $request->request->get('image'),
                    'description' => $request->request->get('description'),
                    'price' => $request->request->get('price'),
                ]);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($book);
            $entityManager->flush();
        }
        return $this->redirectToRoute('book-list');
    }

    /**
     * @Route("/sua/{id}", name="edit")
     */
    public function edit($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $book = $entityManager->getRepository(Book::class)->find($id);
        if (!$book) {
            throw $this->createNotFoundException(
                'Không có sách nào có mã '. $id
            );
        }

        $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();

        return $this->render('admin/book/edit.html.twig',[
            'categories' => $categories,
            'book' => $book
        ]);

    }

    /**
     * @Route("/cap-nhat/{id}", name="update")
     */
    public function update(Request $request, $id, ValidatorInterface $validator)
    {
        $submittedToken = $request->request->get('token');
        if ($this->isCsrfTokenValid('update_book', $submittedToken)) {
            $entityManager = $this->getDoctrine()->getManager();
            $book = $entityManager->getRepository(Book::class)->find($id);
            if (!$book) {
                throw $this->createNotFoundException(
                    'Không có sách nào có mã '. $id
                );
            }
            $category = $this->getDoctrine()->getRepository(Category::class)->find($request->request->get('category'));
            $book->setBookName($request->request->get('book_name'));
            $book->setCategory($category);
            $book->setDescription($request->request->get('description'));
            $book->setImage($request->request->get('image'));
            $book->setPrice($request->request->get('price'));
            $book->setUpdatedAt(new \DateTime());
            $errors = $validator->validate($book);
            if (count($errors) > 0){
                $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();
                return $this->render('admin/book/error.html.twig',[
                    'errors' => $errors,
                    'book_name' => $request->request->get('book_name'),
                    'category_id' => $request->request->get('category'),
                    'categories' => $categories,
                    'image' => $request->request->get('image'),
                    'description' => $request->request->get('description'),
                    'price' => $request->request->get('price'),
                ]);
            }
            $entityManager->persist($book);
            $entityManager->flush();
        }
        return $this->redirectToRoute('book-list');
    }

    /**
     * @Route("/xoa/{id}", name="destroy")
     */
    public function destroy(Request $request, $id)
    {
        $submittedToken = $request->request->get('token');
        if ($this->isCsrfTokenValid('delete-item', $submittedToken)) {
            $entityManager = $this->getDoctrine()->getManager();
            $category = $entityManager->getRepository(Book::class)->find($id);
            $entityManager->remove($category);
            $entityManager->flush();
        }
        return $this->redirectToRoute('book-list');
    }
}
