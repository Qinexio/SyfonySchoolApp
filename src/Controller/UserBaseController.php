<?php

namespace App\Controller;

use App\Entity\UserBase;
use App\Form\UserBaseType;
use App\Repository\UserBaseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user/base")
 */
class UserBaseController extends AbstractController
{
    /**
     * @Route("/", name="user_base_index", methods={"GET"})
     */
    public function index(UserBaseRepository $userBaseRepository): Response
    {
        return $this->render('user_base/index.html.twig', [
            'user_bases' => $userBaseRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="user_base_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $userBase = new UserBase();
        $form = $this->createForm(UserBaseType::class, $userBase);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($userBase);
            $entityManager->flush();

            return $this->redirectToRoute('user_base_index');
        }

        return $this->render('user_base/new.html.twig', [
            'user_base' => $userBase,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_base_show", methods={"GET"})
     */
    public function show(UserBase $userBase): Response
    {
        return $this->render('user_base/show.html.twig', [
            'user_base' => $userBase,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_base_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, UserBase $userBase): Response
    {
        $form = $this->createForm(UserBaseType::class, $userBase);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_base_index');
        }

        return $this->render('user_base/edit.html.twig', [
            'user_base' => $userBase,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_base_delete", methods={"DELETE"})
     */
    public function delete(Request $request, UserBase $userBase): Response
    {
        if ($this->isCsrfTokenValid('delete'.$userBase->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($userBase);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_base_index');
    }
}
