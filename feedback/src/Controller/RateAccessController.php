<?php

namespace App\Controller;

use App\Entity\RateAccess;
use App\Form\RateAccessType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/rate/access")
 */
class RateAccessController extends AbstractController
{
    /**
     * @Route("/", name="rate_access_index", methods={"GET"})
     */
    public function index(): Response
    {
        $rateAccesses = $this->getDoctrine()
            ->getRepository(RateAccess::class)
            ->findAll();

        return $this->render('rate_access/index.html.twig', [
            'rate_accesses' => $rateAccesses,
        ]);
    }

    /**
     * @Route("/new", name="rate_access_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $rateAccess = new RateAccess();
        $form = $this->createForm(RateAccessType::class, $rateAccess);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($rateAccess);
            $entityManager->flush();

            return $this->redirectToRoute('rate_access_index');
        }

        return $this->render('rate_access/new.html.twig', [
            'rate_access' => $rateAccess,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="rate_access_show", methods={"GET"})
     */
    public function show(RateAccess $rateAccess): Response
    {
        return $this->render('rate_access/show.html.twig', [
            'rate_access' => $rateAccess,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="rate_access_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, RateAccess $rateAccess): Response
    {
        $form = $this->createForm(RateAccessType::class, $rateAccess);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('rate_access_index');
        }

        return $this->render('rate_access/edit.html.twig', [
            'rate_access' => $rateAccess,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="rate_access_delete", methods={"DELETE"})
     */
    public function delete(Request $request, RateAccess $rateAccess): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rateAccess->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($rateAccess);
            $entityManager->flush();
        }

        return $this->redirectToRoute('rate_access_index');
    }
}
