<?php


namespace App\Form;


use App\Entity\Doctor;
use App\Model\BlogModel;
use App\Model\SertificateModel;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class BlogForm extends AbstractType
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
            ->add('title', TextType::class, [
                'label' => 'Название (Видно только администратору)'
            ])
            ->add('description', TextareaType::class,[
                'label' => 'Описание *Обязательно',
                'attr' => [
                    'class' => 'enable-ckeditor'
                ],
                'required' => false
            ])
            ->add('image', FileType::class,[
                'label' => 'Фото',
                'attr' => $attr,
                'required' => $options['is_create'] ? true : false,
                'constraints' => $options['is_create'] ? new NotBlank() : null
            ])
            ->add('seoTitle', TextType::class,[
                'label' => 'Сео тайтл',
                'required' => false
            ])
            ->add('seoDescription', TextType::class,[
                'label' => 'Сео описание',
                'required' => false
            ])
            ->add('save', SubmitType::class, ['label' => 'Сохранить'])
            ->getForm();
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'image' => null,
            'is_create' => true,
            'data_class' => BlogModel::class,
        ]);
    }
}