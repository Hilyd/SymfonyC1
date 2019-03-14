<?php

namespace App\Controller;

use App\Contact\ContactService;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact(Request $r, ContactService $service)
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($r);

        if ($form->isSubmitted() && $form->isValid()) {
            $service->sendEmailFromContact($form->getData());

            return $this->redirectToRoute('home');
        }
        return $this->render('default/contact.html.twig', ['contact' => $form->createView()]);

    }
}
