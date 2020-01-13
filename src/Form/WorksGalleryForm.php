<?php


namespace App\Form;


use App\Model\WorksGalleryModel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class WorksGalleryForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $attr = [];
        if($options['image']){
            $attr = [
                'class' => 'has_image',
                'data-image' => $options['image']
            ];
        }

        $builder
            ->add('image', FileType::class,[
                'label' => 'Фото',
                'attr' => $attr,
                'required' => $options['is_create'] ? true : false,
                'constraints' => $options['is_create'] ? new NotBlank() : null
            ])
            ->add('save', SubmitType::class, ['label' => 'Сохранить'])
            ->getForm();
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'image' => null,
            'is_create' => true,
            'data_class' => WorksGalleryModel::class,
        ]);
    }
}