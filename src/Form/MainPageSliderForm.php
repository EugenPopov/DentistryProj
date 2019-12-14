<?php


namespace App\Form;


use App\Model\MainPageSliderModel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class MainPageSliderForm extends AbstractType
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
            ->add('boldTitle', TextType::class, [
                'label' => 'Название (жирный шрифт)',
                'required' => false
            ])
            ->add('title', TextType::class, [
                'label' => 'Название',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Описание',
            ])
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
            'data_class' => MainPageSliderModel::class,
        ]);
    }

}