<?php

namespace App\Controller;

use App\Entity\PartnerRequest;
use App\Form\PartnerRequestType;
use App\Repository\PartnerRequestRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/partner/request")
 */
class PartnerRequestController extends Controller
{
    /**
     * @Route("/", name="partner_request_index", methods="GET")
     */
    public function index(PartnerRequestRepository $partnerRequestRepository): Response
    {
        return $this->render('partner_request/index.html.twig', ['partner_requests' => $partnerRequestRepository->findAll()]);
    }

    /**
     * @Route("/new", name="partner_request_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $partnerRequest = new PartnerRequest();
        $form = $this->createForm(PartnerRequestType::class, $partnerRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($partnerRequest);
            $em->flush();

            return $this->redirectToRoute('partner_request_index');
        }

        return $this->render('partner_request/new.html.twig', [
            'partner_request' => $partnerRequest,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="partner_request_show", methods="GET")
     */
    public function show(PartnerRequest $partnerRequest): Response
    {
        return $this->render('partner_request/show.html.twig', ['partner_request' => $partnerRequest]);
    }

    /**
     * @Route("/{id}/edit", name="partner_request_edit", methods="GET|POST")
     */
    public function edit(Request $request, PartnerRequest $partnerRequest): Response
    {
        $form = $this->createForm(PartnerRequestType::class, $partnerRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'The partner request has been updated.');

            return $this->redirectToRoute('partner_request_show', ['id' => $partnerRequest->getId()]);
        }

        return $this->render('partner_request/edit.html.twig', [
            'partner_request' => $partnerRequest,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="partner_request_delete", methods="DELETE")
     */
    public function delete(Request $request, PartnerRequest $partnerRequest): Response
    {
        if ($this->isCsrfTokenValid('delete'.$partnerRequest->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($partnerRequest);
            $em->flush();
        }

        return $this->redirectToRoute('partner_request_index');
    }
}
