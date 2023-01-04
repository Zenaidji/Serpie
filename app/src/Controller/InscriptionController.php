<?php

namespace App\Controller;


use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\Migrations\Exception\AbortMigration;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
class InscriptionController extends AbstractController
{
    private $entitymanager;
    public function __construct(EntityManagerInterface $entitymanger){
        $this->entitymanager = $entitymanger;
    }
    #[Route('/inscription', name: 'app_inscription')]
    public function index(Request $request,UserPasswordHasherInterface $hasher): Response

    {   
        $user=new User();
        $form=$this->createForm(RegisterType::class,$user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data=$form->getData();
            $password=$hasher->HashPassword ($data,$data->getPassword());
            $data->setPassword($password);
        
            $this->entitymanager->persist($data);
            $this->entitymanager->flush();

            
         


        }

        return $this->render('inscription/index.html.twig',["form"=>$form->createView()]);
    }
}
