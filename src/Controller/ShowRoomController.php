<?php

namespace App\Controller;

use App\Entity\Mark;
use App\Entity\Voiture;
use App\Form\NewCarType;
use App\Repository\VoitureRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ShowRoomController extends AbstractController
{
    /**
     * Permet d'afficher l'ensemble des voitures du showrooms
     * @Route("/shows", name="show")
     */
    public function index( VoitureRepository $repo): Response
    {
        $shows = $repo->findAll();

        return $this->render('show_room/index.html.twig', [
            'shows' => $shows
        ]);
    }

    

    /**
     * affiche les infos d'une voitures
     *@Route("/shows/{id}", name="carshow")
     * @param Voiture $voiture
     * @return Response
     */
    public function showCar(Voiture $car){
        
        return $this->render('show_room/carshow.html.twig',[
            'car' => $car
        ]);
    }
    /**
     * Undocumented function
     * @Route("/carnew", name="newcar")
     * @return Response
     */
    public function createCar(){
        
        $carNew = new Voiture();

        $form = $this->createForm(NewCarType::class,$carNew);

        return $this->render('show_room/newcar.html.twig',[
            'form' => $form->createView()
        ]);
    }


}


   