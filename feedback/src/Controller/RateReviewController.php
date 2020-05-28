<?php

namespace App\Controller;

use App\Entity\RateReview;
use App\Form\RateReviewType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/rate/review")
 */
class RateReviewController extends AbstractController
{
    /**
     * @Route("/", name="rate_review_index", methods={"GET"})
     */
    public function index(): Response
    {
        $rateReviews = $this->getDoctrine()
            ->getRepository(RateReview::class)
            ->findAll();

        return $this->render('rate_review/index.html.twig', [
            'rate_reviews' => $rateReviews,
        ]);
    }

    /**
     * @Route("/new", name="rate_review_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $rateReview = new RateReview();
        $form = $this->createForm(RateReviewType::class, $rateReview);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($rateReview);
            $entityManager->flush();

            return $this->redirectToRoute('rate_review_index');
        }

        return $this->render('rate_review/new.html.twig', [
            'rate_review' => $rateReview,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="rate_review_show", methods={"GET"})
     */
    public function show(RateReview $rateReview): Response
    {
        return $this->render('rate_review/show.html.twig', [
            'rate_review' => $rateReview,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="rate_review_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, RateReview $rateReview): Response
    {
        $form = $this->createForm(RateReviewType::class, $rateReview);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('rate_review_index');
        }

        return $this->render('rate_review/edit.html.twig', [
            'rate_review' => $rateReview,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="rate_review_delete", methods={"DELETE"})
     */
    public function delete(Request $request, RateReview $rateReview): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rateReview->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($rateReview);
            $entityManager->flush();
        }

        return $this->redirectToRoute('rate_review_index');
    }
}
