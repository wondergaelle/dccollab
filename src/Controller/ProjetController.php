<?php
namespace App\Controller;

use App\Entity\Projet;
use App\Form\ProjetType;
use App\Repository\ProjetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\FileUploader;
use Symfony\Component\HttpFoundation\File\UploadedFile;


/**
 * @Route("/projet")
 */
class ProjetController extends AbstractController
{
    /**
     * @Route("/", name="projet_index", methods={"GET"})
     */
    public function index(ProjetRepository $projetRepository): Response
    {
        return $this->render('projet/index.html.twig', [
            'projets' => $projetRepository->findAll(),
        ]);
    }
    // upload d'une image
    /**
     * @Route("/new", name="projet_new", methods={"GET","POST"})
     */
    public function new(Request $request, FileUploader $fileUploader): Response
    {
        // creation d'un projet
        $projet = new Projet();
        // creation du fomulaire en appelant la classe ProjetType généré par composer Form
        $form = $this->createForm(ProjetType::class, $projet);
        // pour traiter les données du formulaire => méthode handleRequest
        $form->handleRequest($request);
        // vérifie si le le formulaire a été soumis et si les données sont valides
        if ($form->isSubmitted() && $form->isValid()) {
            //utilisation du service
            /** @var UploadedFile $pictureFile */
            $pictureFile = $form['pictureFile']->getData();
            if($pictureFile){
                $pictureFilename = $fileUploader->upload($pictureFile);
                $projet->setImage($pictureFilename);
            }
            $entityManager = $this->getDoctrine()->getManager();
            //permet l'affichage du user en cours qui crée le projet
            $projet->setUser($this->getUser());
            // on hydrate l'instance $projet
            $entityManager->persist($projet);
            // enregistrement des données dans la base
            $entityManager->flush();
            // redirige l'utilisateur
            return $this->redirectToRoute('projet_index');
        }
        // si le projets existe les données sont envoyées dans la vue
        return $this->render('projet/new.html.twig', [
            'projet' => $projet,
            // resultat de la fonction createView renvoyée à twig pour l'affichage
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/{id}", name="projet_show", methods={"GET"})
     */
    public function show(Projet $projet): Response
    {
        return $this->render('projet/show.html.twig', [
            'projet' => $projet,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="projet_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Projet $projet): Response
    {
        if (!$this->isGranted("ROLE_ADMIN") && $this->getUser() !== $projet->getUser()){
            throw $this->createAccessDeniedException("Vous n'avez pas le droit de modifier ce projet");
        }
        $form = $this->createForm(ProjetType::class, $projet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('projet_index');
        }
        return $this->render('projet/edit.html.twig', [
            'projet' => $projet,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="projet_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Projet $projet): Response
    {
        if ($this->isCsrfTokenValid('delete'.$projet->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($projet);
            $entityManager->flush();
        }

        return $this->redirectToRoute('projet_index');
    }

    public function prePersist(){
        $this->setCreatedAt(new\ DateTime());
    }
}
