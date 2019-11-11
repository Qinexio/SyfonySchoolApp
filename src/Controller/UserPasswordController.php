<?php

namespace App\Controller;

use App\Entity\UserPassword;
use App\Form\UserPasswordType;
use App\Repository\UserPasswordRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user/password")
 */
class UserPasswordController extends AbstractController
{
    /**
     * @Route("/", name="user_password_index", methods={"GET"})
     */
    public function index(UserPasswordRepository $userPasswordRepository): Response
    {
        return $this->render('user_password/index.html.twig', [
            'user_passwords' => $userPasswordRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="user_password_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $userPassword = new UserPassword();
        $form = $this->createForm(UserPasswordType::class, $userPassword);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($userPassword);
            $entityManager->flush();

            return $this->redirectToRoute('user_password_index');
        }

        return $this->render('user_password/new.html.twig', [
            'user_password' => $userPassword,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_password_show", methods={"GET"})
     */
    public function show(UserPassword $userPassword): Response
    {
        return $this->render('user_password/show.html.twig', [
            'user_password' => $userPassword,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_password_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, UserPassword $userPassword): Response
    {
        $form = $this->createForm(UserPasswordType::class, $userPassword);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_password_index');
        }

        return $this->render('user_password/edit.html.twig', [
            'user_password' => $userPassword,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_password_delete", methods={"DELETE"})
     */
    public function delete(Request $request, UserPassword $userPassword): Response
    {
        if ($this->isCsrfTokenValid('delete'.$userPassword->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($userPassword);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_password_index');
    }
}
