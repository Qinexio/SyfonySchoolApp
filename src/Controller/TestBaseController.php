<?php

namespace App\Controller;

use App\Entity\TestBase;
use App\Form\TestBaseType;
use App\Repository\TestBaseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/test/base")
 */
class TestBaseController extends AbstractController
{
    /**
     * @Route("/", name="test_base_index", methods={"GET"})
     */
    public function index(TestBaseRepository $testBaseRepository): Response
    {
        return $this->render('test_base/index.html.twig', [
            'test_bases' => $testBaseRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="test_base_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $testBase = new TestBase();
        $form = $this->createForm(TestBaseType::class, $testBase);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($testBase);
            $entityManager->flush();

            return $this->redirectToRoute('test_base_index');
        }

        return $this->render('test_base/new.html.twig', [
            'test_base' => $testBase,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="test_base_show", methods={"GET"})
     */
    public function show(TestBase $testBase): Response
    {
        return $this->render('test_base/show.html.twig', [
            'test_base' => $testBase,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="test_base_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TestBase $testBase): Response
    {
        $form = $this->createForm(TestBaseType::class, $testBase);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('test_base_index');
        }

        return $this->render('test_base/edit.html.twig', [
            'test_base' => $testBase,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="test_base_delete", methods={"DELETE"})
     */
    public function delete(Request $request, TestBase $testBase): Response
    {
        if ($this->isCsrfTokenValid('delete'.$testBase->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($testBase);
            $entityManager->flush();
        }

        return $this->redirectToRoute('test_base_index');
    }
}
