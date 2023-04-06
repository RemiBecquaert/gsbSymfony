<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

use App\Repository\UtilisateurRepository;
use App\Repository\ContactRepository;
use App\Form\ContactType;
use App\Entity\Contact;

class BaseController extends AbstractController
{
    #[Route('/', name: 'app_base')]
    public function index(): Response
    {
        return $this->render('base/index.html.twig', []);
    }

    #[Route('/presentation', name: 'app_presentation')]
    public function presentation(): Response
    {
        return $this->render('base/presentation.html.twig', []);
    }

    #[Route('/gestion', name: 'app_gestion')]
    public function gestion(): Response
    {
        return $this->render('base/gestion.html.twig', []);
    }

    #[Route('/nos-equipements', name: 'app_equipements')]
    public function equipements(): Response
    {
        return $this->render('base/equipements.html.twig', []);
    }

    #[Route('/repartition', name: 'app_repartition')]
    public function repartition(): Response
    {
        return $this->render('base/repartition.html.twig', []);
    }

    #[Route('/segmentation', name: 'app_segmentation')]
    public function segmentation(): Response
    {
        return $this->render('base/segmentation.html.twig', []);
    }

    #[Route('/contact', name: 'app_contact')]
    public function contact(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $contact->setDateContact(new \Datetime());
            $entityManagerInterface->persist($contact);
            $entityManagerInterface->flush();
            $this->addFlash('notice', 'Prise de contact enregistrée !');
            return $this->redirectToRoute('app_base');
        }
        return $this->render('base/contact.html.twig', ['form'=>$form->createView()]);
    }

    #[Route('/controle-liste-contact', name: 'app_liste_contact')]
    public function listeContact(ContactRepository $repo): Response
    {
        return $this->render('base/liste-contacts.html.twig', ['contacts'=>$repo->findAll()]);
    }

    #[Route('/controle-liste-cadurciens', name: 'app_cadurciens')]
    public function cadurciens(UtilisateurRepository $repo): Response
    {
        return $this->render('base/cadurciens.html.twig', ['utilisateurs'=>$repo->getCadurciens()]);
    }

    #[Route('/controle-liste-utilisateurs', name: 'app_utilisateurs')]
    public function utilisateurs(UtilisateurRepository $repo): Response
    {
        return $this->render('base/utilisateurs.html.twig', ['utilisateurs'=>$repo->findAll()]);
    }

    
    #[Route('/controle-liste-frais', name: 'app_frais')]
    public function ayantDesFrais(UtilisateurRepository $repo): Response
    {
        return $this->render('base/liste-avec-frais.html.twig', ['utilisateurs'=>$repo->getAvecFrais()]);
    }

    
    #[Route('/controle-liste-sans-frais', name: 'app_pas_de_frais')]
    public function pasDeFrais(UtilisateurRepository $repo): Response
    {
        return $this->render('base/liste-sans-frais.html.twig', ['utilisateurs'=>$repo->getSansFrais()]);
    }

    
    #[Route('/controle-liste-nombre-de-frais', name: 'app_nombre_de_frais')]
    public function nombreDeFrais(UtilisateurRepository $repo): Response
    {
        return $this->render('base/nombre-de-frais.html.twig', ['utilisateurs'=>$repo->getNbFrais()]);
    }
}
