<?php

namespace SarahBundle\Controller;

use SarahBundle\Entity\Utilisateur;
use SarahBundle\Form\UtilisateurType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session;

class ClientController extends Controller
{
    public function indexAction()
    {
        $request = $this->get('request');

          
        if($this->get('security.context')->isGranted('ROLE_USER')){
            if(!$request->query->get('par1')){
                
                return $this->render('SarahBundle:client:client.html.twig');
            }else{

                    return $this->render('SarahBundle:client:client.html.twig',array('error'=>1));
            }
        }


            return $this->redirect($this->generateUrl('fos_user_security_login'));

    }

    // formulaire pour insertion dans la base de donnnées.
    public function formAction($error =0){
        $em = $this->getDoctrine()->getManager();

        $user = new Utilisateur();
        $user1 = new Utilisateur();
        $form = $this->createForm(new UtilisateurType(),$user);
        // pour pas charger les données dans
        $form1 =  $this->createForm(new UtilisateurType(),$user1);
        $request = $this->get('request');
        if($error)  return $this->render('SarahBundle:Default:form.html.twig',array('form'=>$form->createView(),'error'=>1));
        if($request->isMethod('POST')){
            $form->handleRequest($request);

            if($form->isValid()){
                $compteur = $form->getData()->getCompteur();
                if($em->getRepository('SarahBundle:Utilisateur')->findByCompteur($compteur)){

                    return $this->redirect($this->generateUrl('sarah_client',array('par1'=>1)));
                    // return $this->render('SarahBundle:Default:form.html.twig',array('form'=>$form->createView(),'error'=>1));
                }else{
                    $em->persist($user);
                    $em->flush();
                    //return $this->render('SarahBundle:Default:form.html.twig',array('form'=>$form->createView()));
                    return $this->redirect($this->generateUrl('sarah_client'));
                    // return $this->render('SarahBundle:Default:form.html.twig',array('form'=>$form1->createView()));
                }



            }
        }
        return $this->render('SarahBundle:Default:form.html.twig',array('form'=>$form->createView()));
    }

    // list des données
    public function listAction(){
        $em = $this->getDoctrine()->getManager();
        $utilisateurs = $em->getRepository('SarahBundle:Utilisateur')->findAll();

        
        return $this->render('SarahBundle:client:list.html.twig',array('users'=>$utilisateurs));
    }


}
