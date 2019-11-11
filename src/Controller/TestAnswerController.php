<?php

namespace App\Controller;

use App\Entity\TestAnswer;
use App\Form\TestAnswerType;
use App\Repository\TestAnswerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/test/answer")
 */
class TestAnswerController extends AbstractController
{
    /**
     * @Route("/", name="test_answer_index", methods={"GET"})
     */
    public function index(TestAnswerRepository $testAnswerRepository): Response
    {
        return $this->render('test_answer/index.html.twig', [
            'test_answers' => $testAnswerRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="test_answer_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $testAnswer = new TestAnswer();
        $form = $this->createForm(TestAnswerType::class, $testAnswer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($testAnswer);
            $entityManager->flush();

            return $this->redirectToRoute('test_answer_index');
        }

        return $this->render('test_answer/new.html.twig', [
            'test_answer' => $testAnswer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="test_answer_show", methods={"GET"})
     */
    public function show(TestAnswer $testAnswer): Response
    {
        return $this->render('test_answer/show.html.twig', [
            'test_answer' => $testAnswer,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="test_answer_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TestAnswer $testAnswer): Response
    {
        $form = $this->createForm(TestAnswerType::class, $testAnswer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('test_answer_index');
        }

        return $this->render('test_answer/edit.html.twig', [
            'test_answer' => $testAnswer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="test_answer_delete", methods={"DELETE"})
     */
    public function delete(Request $request, TestAnswer $testAnswer): Response
    {
        if ($this->isCsrfTokenValid('delete'.$testAnswer->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($testAnswer);
            $entityManager->flush();
        }

        return $this->redirectToRoute('test_answer_index');
    }
}
