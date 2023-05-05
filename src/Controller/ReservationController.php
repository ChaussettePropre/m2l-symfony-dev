<?php

namespace App\Controller;

use App\Entity\Bureau;
use App\Entity\Categorie;
use App\Entity\Reservation;
use App\Entity\Salle;
use App\Form\ReservationSalleType;
use App\Form\ReservationType;
use App\Form\TarifType;
use App\Entity\Sallereservable;
use App\Repository\SalleReservableRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ReservationController extends AbstractController
{
    public function reservations(Request $request): Response
    {
        $reservations = $this->getDoctrine()->getRepository(Reservation::class)->findby(['personne'=>$this->getUser()]);
        return $this->render('reservations/reservations.html.twig', [
            'titre'=>'Vos réservations : ',
            'reservations'=>$reservations,
        ]);
    }

    public function reserverunesalle(Request $request): Response
    {
        $salles = $this->getDoctrine()->getRepository(Sallereservable::class)->findAll();
        $reservation = new Reservation();
        $formReservation = $this->createForm(ReservationType::class,$reservation, ['salles'=>$salles]);
        $formReservation->handleRequest($request);

        if ($formReservation->isSubmitted()) {
            $reservation->setPersonne($this->getUser());
            $reservation->setStatus('En cours de traitement');
            $entitymanager = $this->getDoctrine()->getManager();
            $entitymanager->persist($reservation);
            $entitymanager->flush();
            return $this->render('reservations/new/reservationsSucces.html.twig', [
                'titre' => 'Reservation enrengistré'
            ]);
        }

        return $this->render('reservations/new/reserverunesalle.html.twig', [
            'form'=>$formReservation->createView(),
            'titre' => 'Demande d\'une salle '
        ]);
    }

    public function reserverunbureau(Request $request): Response
    {
        $bureaux = $this->getDoctrine()->getRepository(Bureau::class)->findAll();
        $reservation = new Reservation();
        $formReservation = $this->createForm(ReservationType::class, $reservation, ['salles' => $bureaux]);
        $formReservation->handleRequest($request);

        if ($formReservation->isSubmitted()) {
            $reservation->setPersonne($this->getUser());
            $reservation->setStatus('En cours de traitement');
            $entitymanager = $this->getDoctrine()->getManager();
            $entitymanager->persist($reservation);
            $entitymanager->flush();
            return $this->render('reservations/new/reservationsSucces.html.twig', [
                'titre' => 'Reservation enrengistré'
            ]);
        }

        return $this->render('reservations/new/reserverunbureau.html.twig', [
            'form' => $formReservation->createView(),
            'titre' => 'Demande d\'un bureau '
        ]);
    }
}