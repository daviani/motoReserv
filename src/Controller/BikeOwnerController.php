<?php

namespace App\Controller;

use App\Entity\BikeOwner;
use App\Form\BikeOwnerType;
use App\Repository\BikeOwnerRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/bike-owner")
 * @IsGranted("ROLE_ADMIN")
 */
class BikeOwnerController extends AbstractController
{
    /**
     * @Route("/", name="bike_owner_index", methods={"GET"})
     */
    public function index(BikeOwnerRepository $bikeOwnerRepository): Response
    {
        return $this->render('bike_owner/index.html.twig', [
            'bike_owners' => $bikeOwnerRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="bike_owner_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $bikeOwner = new BikeOwner();
        $bikeOwner->setCreatedAt(new \DateTime);
        $form = $this->createForm(BikeOwnerType::class, $bikeOwner);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($bikeOwner);
            $entityManager->flush();

            return $this->redirectToRoute('bike_owner_index');
        }

        return $this->render('bike_owner/new.html.twig', [
            'bike_owner' => $bikeOwner,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="bike_owner_show", methods={"GET"})
     */
    public function show(BikeOwner $bikeOwner): Response
    {
        return $this->render('bike_owner/show.html.twig', [
            'bike_owner' => $bikeOwner,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="bike_owner_edit", methods={"GET","POST"})
     * @IsGranted("ROLE_SUPER_ADMIN")
     */
    public function edit(Request $request, BikeOwner $bikeOwner): Response
    {
        $form = $this->createForm(BikeOwnerType::class, $bikeOwner);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bike_owner_index');
        }

        return $this->render('bike_owner/edit.html.twig', [
            'bike_owner' => $bikeOwner,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="bike_owner_delete", methods={"DELETE"})
     * @IsGranted("ROLE_SUPER_ADMIN")
     */
    public function delete(Request $request, BikeOwner $bikeOwner): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bikeOwner->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($bikeOwner);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bike_owner_index');
    }
}
