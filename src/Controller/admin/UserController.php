<?php

namespace App\Controller\admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/tai-khoan", name="user-")
 */

class UserController extends AdminController
{

    /**
     * @Route("/", name="list")
     */
    public function index()
    {
        return $this->render('admin/user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    /**
     * @Route("/them-moi", name="add")
     */
    public function create()
    {
        return $this->render('admin/category/add.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }
}
