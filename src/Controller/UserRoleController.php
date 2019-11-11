<?php

namespace App\Controller;

use App\Entity\UserRole;
use App\Form\UserRoleType;
use App\Repository\UserRoleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user/role")
 */
class UserRoleController extends AbstractController
{
    /**
     * @Route("/", name="user_role_index", methods={"GET"})
     */
    public function index(UserRoleRepository $userRoleRepository): Response
    {
        return $this->render('user_role/index.html.twig', [
            'user_roles' => $userRoleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="user_role_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $userRole = new UserRole();
        $form = $this->createForm(UserRoleType::class, $userRole);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($userRole);
            $entityManager->flush();

            return $this->redirectToRoute('user_role_index');
        }

        return $this->render('user_role/new.html.twig', [
            'user_role' => $userRole,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_role_show", methods={"GET"})
     */
    public function show(UserRole $userRole): Response
    {
        return $this->render('user_role/show.html.twig', [
            'user_role' => $userRole,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_role_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, UserRole $userRole): Response
    {
        $form = $this->createForm(UserRoleType::class, $userRole);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_role_index');
        }

        return $this->render('user_role/edit.html.twig', [
            'user_role' => $userRole,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_role_delete", methods={"DELETE"})
     */
    public function delete(Request $request, UserRole $userRole): Response
    {
        if ($this->isCsrfTokenValid('delete'.$userRole->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($userRole);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_role_index');
    }
}
