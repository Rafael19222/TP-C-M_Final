<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;

final class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact', methods: ['GET', 'POST'])]
    public function index(Request $request, EntityManagerInterface $entityManager, MailerInterface $mailer): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($contact);
            $entityManager->flush();

            // Envoi email
            $email = (new Email())
                ->from($contact->getEmail())
                ->to('contact@gameshop.com') // chang ton email
                ->subject('Nouveau message de contact : ' . $contact->getUsername())
                ->html(
                    '<h2>Nouveau message de contact</h2>' .
                    '<p><strong>Nom :</strong> ' . $contact->getUsername() . '</p>' .
                    '<p><strong>Email :</strong> ' . $contact->getEmail() . '</p>' .
                    '<p><strong>Message :</strong></p>' .
                    '<p>' . nl2br($contact->getMessage()) . '</p>'
                );

            $mailer->send($email);

            $this->addFlash('success', 'Merci ! Votre message a été envoyé avec succès.');
            return $this->redirectToRoute('app_contact');
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form,
        ]);
    }
}
