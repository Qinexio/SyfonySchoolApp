<?php

namespace App\Controller;

use App\Entity\TestQuestion;
use App\Form\TestQuestionType;
use App\Repository\TestQuestionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/test/question")
 */
class TestQuestionController extends AbstractController
{
    /**
     * @Route("/", name="test_question_index", methods={"GET"})
     */
    public function index(TestQuestionRepository $testQuestionRepository): Response
    {
        return $this->render('test_question/index.html.twig', [
            'test_questions' => $testQuestionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="test_question_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $testQuestion = new TestQuestion();
        $form = $this->createForm(TestQuestionType::class, $testQuestion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($testQuestion);
            $entityManager->flush();

            return $this->redirectToRoute('test_question_index');
        }

        return $this->render('test_question/new.html.twig', [
            'test_question' => $testQuestion,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="test_question_show", methods={"GET"})
     */
    public function show(TestQuestion $testQuestion): Response
    {
        return $this->render('test_question/show.html.twig', [
            'test_question' => $testQuestion,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="test_question_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TestQuestion $testQuestion): Response
    {
        $form = $this->createForm(TestQuestionType::class, $testQuestion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('test_question_index');
        }

        return $this->render('test_question/edit.html.twig', [
            'test_question' => $testQuestion,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="test_question_delete", methods={"DELETE"})
     */
    public function delete(Request $request, TestQuestion $testQuestion): Response
    {
        if ($this->isCsrfTokenValid('delete'.$testQuestion->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($testQuestion);
            $entityManager->flush();
        }

        return $this->redirectToRoute('test_question_index');
    }
}
