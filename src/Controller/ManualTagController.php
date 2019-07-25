<?php

namespace App\Controller;

use App\Entity\Tag;
use App\Repository\TagRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ManualTagController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var TagRepository
     */
    private $repository;

    /**
     * ManualTagController constructor.
     * @param EntityManagerInterface $em
     * @param TagRepository $repository
     */
    public function __construct(EntityManagerInterface $em, TagRepository $repository)
    {
        $this->em = $em;
        $this->repository = $repository;
    }

    /**
     * @Route("/manual/tag", name="manual_tag")
     */
    public function index()
    {
        /** @var Tag[] $tags */
        $tags = $this->repository->findAll();
        dump($tags);

        return $this->render('manual_tag/index.html.twig', [
            'controller_name' => 'ManualTagController',
        ]);
    }

    /**
     * @Route("/manual/tag/new", name="new_manual_tag")
     */
    public function newManualTag(){
        $tag = new Tag();
        $tag->setName('Trail');

        $this->em->persist($tag);
        $this->em->flush();

        return $this->render('manual_tag/show.html.twig', [
            'tag' => $tag,
        ]);
    }
}
