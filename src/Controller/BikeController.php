<?php

namespace App\Controller;

use App\Entity\Bike;
use App\Form\BikeType;
use App\Repository\BikeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/bike")
 */
class BikeController extends AbstractController
{
    /**
     * @Route("/", name="bike_index", methods={"GET"})
     */
    public function index(BikeRepository $bikeRepository): Response
    {
        return $this->render('bike/index.html.twig', [
            'bikes' => $bikeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="bike_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $bike = new Bike();
        $bike->setCreateAt(new \DateTime());
        $form = $this->createForm(BikeType::class, $bike);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($bike);
            $entityManager->flush();

            return $this->redirectToRoute('bike_index');
        }

        return $this->render('bike/new.html.twig', [
            'bike' => $bike,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="bike_show", methods={"GET"})
     */
    public function show(Bike $bike): Response
    {
        return $this->render('bike/show.html.twig', [
            'bike' => $bike,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="bike_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Bike $bike): Response
    {
        $form = $this->createForm(BikeType::class, $bike);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bike_index');
        }

        return $this->render('bike/edit.html.twig', [
            'bike' => $bike,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="bike_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Bike $bike): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bike->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($bike);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bike_index');
    }

    /**
     * @Route("/status/{status_number}", name="bike_list_status", methods={"GET"})
     */
    public function listByStatus(BikeRepository $bikeRepository, int $status_number): Response
    {


        return $this->render('bike/index.html.twig', [
            'bikes' => $bikeRepository->findBy(['status'=> $status_number]),
        ]);
    }
}
