<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Contracts\Translation\TranslatorInterface;

class RestePasswordController extends AbstractController
{
    private UserPasswordHasherInterface $userPasswordHasher;
    private TranslatorInterface $translator;

    public function __construct(TranslatorInterface $translator,UserPasswordHasherInterface $userPasswordHasher){
        $this->translator = $translator;
        $this->userPasswordHasher = $userPasswordHasher;
    }

    #[Route('/reste/password', name: 'app_reste_password')]
    public function index(Security $security,Request $request,EntityManagerInterface $entityManager): Response
    {
        $form = $this->createFormBuilder()
            ->add('UserEmail', EmailType::class)
            ->add('Phone')
            ->add('plainPassword', RepeatedType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'type' => PasswordType::class,
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 8,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
                'first_options'  => ['label' => 'Password'],
                'second_options' => ['label' => 'Confirm Password'],
            ])
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $email = $form->get('UserEmail')->getData();
            $phone = $form->get('Phone')->getData();

            $check_user = $entityManager->getRepository(User::class)->findOneBy(['email'=>$email]);
            if (!empty($check_user)){
                if ($check_user->getPhone() === $phone){
                    $check_user->setPassword(
                        $this->userPasswordHasher->hashPassword(
                            $check_user,
                            $form->get('plainPassword')->getData()
                        )
                    );

                    $entityManager->persist($check_user);
                    $entityManager->flush();

                    $this->addFlash('success', $this->translator->trans('Update successful! Welcome, %email%', ['%email%' => $check_user->getEmail()]));

                    return $this->redirectToRoute('app_login');

                }else{
                    $this->addFlash('Error', $this->translator->trans('user phone not correct'));
                }
            }else{
                $this->addFlash('Error', $this->translator->trans('user not found'));
            }

        }


        return $this->render('reste_password/index.html.twig', [
            'controller_name' => 'RestePasswordController',
            'isGranted' => $security->isGranted('ROLE_USER'),
            'user' => $this->getUser(),
            'form' => $form->createView(),
        ]);
    }
}
