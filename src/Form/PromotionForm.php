<?php


namespace App\Form;


use App\Model\PromotionModel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class PromotionForm extends AbstractType
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

        $builder
            ->add('title', TextType::class, [
                'label' => 'Название'
            ])
            ->add('shortDescription', TextareaType::class, [
                'label' => 'Короткое описание'
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Описание *Обязательно',
                'attr' => [
                    'class' => 'enable-ckeditor'
                ],
                'required' => false
            ])
            ->add('isActive', CheckboxType::class, [
                'label' => 'Активировать',
                'required' => false
            ])
            ->add('isPublic', CheckboxType::class, [
                'label' => 'Акция для всех',
                'required' => false
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
            'is_create' => true,
            'data_class' => PromotionModel::class,
        ]);
    }
}