<?php

namespace App\Controller;

use App\Entity\Library;
use App\Entity\Livres;
use App\Form\LivresType;
use App\Form\SortFormType;
use App\Repository\LivresRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\BorrowType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Entity\User;
// use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * @Route("/livres")
 */
class LivresController extends AbstractController
{
    /**
     * @Route("/", name="livres_index", methods={"GET", "POST"})
     */
    public function index(LivresRepository $livresRepository, Request $request): Response
    {

        $form = $this->createForm(SortFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
          $data = $form->getData();
          $livres = $livresRepository->findByCategories($data['categories']);
        }
        else {
          $livres = $livresRepository->findAll();
        }
        return $this->render('livres/index.html.twig', [
          'livres' => $livres,
          'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/new", name="livres_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $livre = new Livres();
        $form = $this->createForm(LivresType::class, $livre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($livre);
            $entityManager->flush();

            return $this->redirectToRoute('livres_index');
        }

        return $this->render('livres/new.html.twig', [
            'livre' => $livre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="livres_show")
     */
    public function show(Livres $livre, $id, Request $request): Response
    {
      $form = $this->createForm(BorrowType::class);
      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {
          $data = $form->getData();
          $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(["userKey" => $data["userKey"]]);
          if(!$user) {
            $this->addFlash("danger", "Ce code utilisateur n'est pas valide");
          }
          else {
            $livre->setEmprunteur($user);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($livre);
            $entityManager->flush();
            $this->addFlash("success", "Le livre a été emprunté");
          }
        }


        return $this->render('livres/show.html.twig', [
            'livre' => $livre,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/livres/back/{id}", name="librairian_book_back")
     */
    public function bookBack(Livres $livre)
    {
      if($livre->getStatus()) {
        $this->addFlash("danger", "Ce livre n'a jamais été emprunté");
      }
      else {
        $livre->setEmprunteur(null);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($livre);
        $entityManager->flush();
        $this->addFlash("success", "Le livre a été rendu");
      }
      return $this->redirectToRoute('livres_show', ["id" => $livre->getId()]);
    }

    /**
     * @Route("/{id}/edit", name="livres_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Livres $livre): Response
    {
        $form = $this->createForm(LivresType::class, $livre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('livres_index', [
                'id' => $livre->getId(),
            ]);
        }

        return $this->render('livres/edit.html.twig', [
            'livre' => $livre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="livres_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Livres $livre): Response
    {
        if ($this->isCsrfTokenValid('delete'.$livre->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($livre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('livres_index');
    }
}
