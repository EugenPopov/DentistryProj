<?php


namespace App\Form;


use App\Model\MainPageSliderModel;
use App\Model\ServiceModel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class ServiceForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $attr_image = [];
        if($options['image']){
            $attr_image = [
                'class' => 'has_image',
                'data-image' => $options['image']
            ];
        }

        $attr_icon = [];
        if($options['icon']){
            $attr_icon = [
                'class' => 'has_image',
                'data-image' => $options['icon']
            ];
        }

        $builder
            ->add('title', TextType::class, [
                'label' => 'Название'
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Описание'
            ])
            ->add('additionalInfo', TextType::class, [
                'label' => 'Дополнительная информация',
                'required' => false
            ])
            ->add('icon', FileType::class,[
                'label' => 'Иконка',
                'attr' => $attr_icon,
                'required' => $options['is_create'] ? true : false,
                'constraints' => $options['is_create'] ? new NotBlank() : null
            ])
            ->add('image', FileType::class,[
                'label' => 'Фото',
                'attr' => $attr_image,
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
            'icon' => null,
            'is_create' => true,
            'data_class' => ServiceModel::class,
        ]);
    }

}