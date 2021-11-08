<?php

namespace App\DataFixtures;

use DateInterval;
use Faker\Factory;
use App\Entity\Mark;
use App\Entity\Image;
use App\Entity\Voiture;
use Faker\Provider\Fakecar;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = (new \Faker\Factory())::create();
        $faker->addProvider(new \Faker\Provider\Fakecar($faker));
        
    
   
        $markFaker = [
        1 => 'opel',
        2 => 'vw',
        3 => 'ford',
        4 => 'alfa-romeo',
        5 => 'bmw',
        6 => 'mercedes',
        7 => 'porsche',
        8 => 'jaguar',
        9 => 'renault',
        10 => 'peugeot'
    ];
    $modelFaker = [
        1 => 'insignia',
        2 => 'arteon',
        3 => 'gt-500',
        4 => 'giulia-super',
        5 => 'm-2-competition',
        6 => 'cls-200',
        7 => 'panamera',
        8 => 'xf-v8',
        9 => 'arkana',
        10 => '508'
    ];
    $coverFaker = [
        1 => 'http://www.wetterene-remy-dev.com/picture/cars/insignia.JPG',
        2 => 'http://www.wetterene-remy-dev.com/picture/cars/arteon.jpg',
        3 => 'http://www.wetterene-remy-dev.com/picture/cars/gt-500.jpg',
        4 => 'http://www.wetterene-remy-dev.com/picture/cars/giulia-super.jpg',
        5 => 'http://www.wetterene-remy-dev.com/picture/cars/m-2-competition.jpg',
        6 => 'http://www.wetterene-remy-dev.com/picture/cars/cls-200.jpg',
        7 => 'http://www.wetterene-remy-dev.com/picture/cars/panamera.jpg',
        8 => 'http://www.wetterene-remy-dev.com/picture/cars/xf-v8.jpg',
        9 => 'http://www.wetterene-remy-dev.com/picture/cars/arkana.jpg',
        10 => 'http://www.wetterene-remy-dev.com/picture/cars/508.jpg'
    ];
    $fuelFaker=[1 => 'essence',2 =>'diesel'];
        for($i=1;$i<= 10; $i++){
            
            $voiture = new Voiture();
            
            $carMark = $faker->vehicleBrand;
            $mark = new Mark();
            $mark->setNameMark($markFaker[$i]);
            $manager->persist($mark);
                $carOptions = "<span>GPS</span><span>cuir</span><span>airconditionné</span>";
                $carTransmi = $faker->vehicleGearBoxType;
                $description ='<p>'.join('</p><p>',$faker->paragraphs(3)).'</p>';
                $voiture ->setPrice(rand(1000,49000))
                         ->setKm(rand('0','100000'))
                         ->setNumbersOwners(rand(0,3))
                         ->setEngineSize(rand('900','3000'))
                         ->setModel($modelFaker[$i])
                         ->setFuel($fuelFaker[rand(1,2)])
                         ->setYearOfEntry(new \DateTime())
                         ->setTransmission($carTransmi)
                         ->setDescription($description)
                         ->setPowerEngine((string)rand('100','800'))
                         ->setOptions($carOptions)
                         ->setCoverImage($coverFaker[$i])
                         ->setMark($mark);
                
            $manager->persist($voiture);
            
                    for($m=1;$m<= 3; $m++){
            
                        $image = new Image();
                            $image -> setNameImg($coverFaker[$i])
                                    ->setCaption($modelFaker[$i])
                                    ->setVoiture($voiture);
                        
                        $manager->persist($image);
                    }
        }

        $manager->flush();
    }
}
