<?php

namespace App\Controller\Admin;

use App\Form\SettingsForm;
use App\Model\SettingsModel;
use App\Service\CommonSettings\CommonSettingsInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class SettingsController extends AbstractController
{
    /**
     * @var CommonSettingsInterface
     */
    private $commonSettings;

    /**
     * SettingsController constructor.
     * @param CommonSettingsInterface $commonSettings
     */
    public function __construct(CommonSettingsInterface $commonSettings)
    {
        $this->commonSettings = $commonSettings;
    }

    public function index()
    {
        return $this->render('admin/settings/index.html.twig', [
            'array' => $this->commonSettings->getAll(true)
        ]);
    }

    public function update(Request $request)
    {
        $array = $this->commonSettings->getAll(true);
        $form = $this->createForm(SettingsForm::class, new SettingsModel($array), ['array' => $array]);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $this->commonSettings->setAll($data->getAll());
            $this->commonSettings->flush();
            return $this->redirectToRoute('common_settings_index');
        }

        return $this->render('admin/form.html.twig', ['form' => $form->createView()]);
    }
}