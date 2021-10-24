<?php

namespace App\Controller;
use App\Entity\Mark;
use App\Entity\Image;
use App\Entity\Voiture;
use App\Form\NewCarType;
use App\Repository\VoitureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
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
  * formulaire d'insertion d'une nouvelle voiture
  * @Route("/carnew", name="newcar")
  * @param Request $request
  * @param EntityManagerInterface $manager
  * @return Response
  */
    public function createCar(Request $request, EntityManagerInterface $manager){
        
        $carNew = new Voiture();
// on met deux images pour voir si tout c'est bien passé quand et voir si ça m'affiche bien 
          $title = $request->request->get('addVoiture');
        dump($title);
        
        $image1 = new Image();
        $image1->setNameImg('http://placehold.it/400x200')
            ->setCaption('Titre 1');
        
        $carNew->addImage($image1);
        $image2 = new Image();
        $image2->setNameImg('http://placehold.it/400x200')
            ->setCaption('Titre 2');
        $carNew->addImage($image2);    
        

        $form = $this->createForm(NewCarType::class,$carNew);
        $form ->handleRequest($request);
        
        // quand je vais vérifier si le form est envoyé et si il est valide
        if($form -> isSubmitted() && $form -> isValid()){
            foreach($carNew->getImages() as $image){
                $image->setVoiture($carNew);
                $manager->persist($image);
            }

            $manager->flush();

            return $this->redirectToRoute('carshow',['id' => $carNew->getId()]);
       }
        return $this->render('show_room/newcar.html.twig',[
            'carForm' => $form->createView()
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
    


}


   