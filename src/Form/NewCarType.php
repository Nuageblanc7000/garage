<?php

namespace App\Form;
use App\Entity\Mark;
use App\Entity\Voiture;
use App\Form\ImageCarType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class NewCarType extends AbstractType
{
    /**
     * function de config pour mes champs
     *
     * @param string $label
     * @param string $placeholder
     * @param array $options
     * @return array
     */
    private function getConfiguration($label,$placeholder,$options=[]){
        return array_merge_recursive([
            'label' => $label,
                'attr' => [
                    'placeholder'=> $placeholder,
                    'class' => 'form-control mb-1'
                ]
                ],$options);
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('model', TextType::class,$this->getConfiguration('Model de la voiture:','bmw-z'))
            ->add('km', TextType::class, $this-> getConfiguration('Kilométrage de la voiture:','42000'))
            ->add('price',MoneyType::class, $this-> getConfiguration('Prix de la voiture:','5500'))
            ->add('numbersOwners',IntegerType::class,$this-> getConfiguration('Nombre de propriétaire:','0'))
            ->add('engineSize',IntegerType::class,$this-> getConfiguration('Cylindrée:','400'))
            ->add('powerEngine',IntegerType::class,$this-> getConfiguration('Puissance du moteur:','200'))
            ->add('fuel',TextType::class, $this-> getConfiguration('Carburant:','diesel/Essence'))
            ->add('yearOfEntry',DateType::class, $this->getConfiguration('Date de mise en circulation:',false))
            ->add('transmission',TextType::class, $this-> getConfiguration('Transmission:','Automatique/Manuelle'))
            ->add('description',TextType::class, $this-> getConfiguration('Description du véhicule:','description véhicule..'))
            ->add('options',TextType::class, $this-> getConfiguration('Options du véhicule:','Gps,cruise-control...'))
            ->add('coverImage',UrlType::class, $this-> getConfiguration('Ajouter une url d\'image:','https://picsum.photos/200/300'))

            ->add('mark',CollectionType::class, $this->getConfiguration('Choix de la marque:',false))
            ->add('images',CollectionType::class,[
                'entry_type' => ImageCarType::class,
                'allow_add' => true,
                'allow_delete' => true
                ])
                
                ;
            }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Voiture::class,
        ]);
    }
}
