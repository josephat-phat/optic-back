<?php

namespace App\Form;

use App\Entity\Produit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use App\Form\ImageType;

class ProduitType extends AbstractType
{
    private function getStyle($titre,$places){
        return [
            "label"=>$titre, "attr"=>[
                "placeholder"=>$places,
                "class"=>"form-control",
            ]
            ];
    }

    private function getStyle1($titre,$places){
        return [
            "label"=>$titre, "attr"=>[
                "placeholder"=>$places,
                "class"=>"form-control",
                "rows"=>"5"
            ]
            ];
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class,$this->getStyle("nom","Exemple: xml004"))
            ->add('marque', TextType::class,$this->getStyle("nom","Exemple: Guess"))
            ->add('description', TextareaType::class)
            ->add('categorie', ChoiceType::class,[
                'choices'=>[
                    "Lunette de soleil"=>0,
                    "Lunette de vue"=>1,
                    "Lentille"=>2
                ],
            ])
            ->add('prix', TextType::class,$this->getStyle("","Exemple: 5 "))
            ->add('statue', RadioType::class,$this->getStyle("","Exemple: 5 "))
            ->add('images', CollectionType::class,[
                "entry_type"=>ImageType::class,
                "allow_add" => true,
                "allow_delete" => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
