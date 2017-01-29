<?php

namespace SarahBundle\Controller;

use SarahBundle\Entity\Utilisateur;
use SarahBundle\Form\UtilisateurType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
class AdminController extends Controller
{
    public function indexAction()
    {
        $request = $this->get('request');
        // id de l'utilisateur
        $id = $request->query->get('form');




        // On teste que l'utilisateur dispose bien du rôle ROLE_AUTEUR
        /*if ($this->get('security.context')->isGranted('ROLE_ADMIN')) {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
            // Sinon on déclenche une exception « Accès interdit »
            //throw new AccessDeniedHttpException('Accès limité aux Clients');
        }*/

        if($this->get('security.context')->isGranted('ROLE_ADMIN')){
            
                if(!$request->query->get('par1')){
                    if(isset($id)){
                        return $this->render('SarahBundle:admin:admin.html.twig',array('id'=>$id));
                    }
                    return $this->render('SarahBundle:admin:admin.html.twig');
                }else{
                    if(isset($id)){
                        return $this->render('SarahBundle:admin:admin.html.twig',array('error'=>1,'id'=>$id));
                    }
                    return $this->render('SarahBundle:admin:admin.html.twig',array('error'=>1));
                }

        }

        return $this->redirect($this->generateUrl('fos_user_security_login'));
    }

    // formulaire pour insertion dans la base de donnnées.
    public function formAdminAction($error =0,$id = null){

        $em = $this->getDoctrine()->getManager();
        if(isset($id)){

            $user = $em->getRepository('SarahBundle:Utilisateur')->find($id);
        }else{

            $user = new Utilisateur();
        }


        $form = $this->createForm(new UtilisateurType(),$user);
        // pour pas charger les données dans
       // $form1 =  $this->createForm(new UtilisateurType(),$user1);
        $request = $this->get('request');
        if($error){
           if(isset($id))  
               return $this->render('SarahBundle:admin:form.html.twig',array('form'=>$form->createView(),'error'=>1,'id'=>$id));
            
            return $this->render('SarahBundle:admin:form.html.twig',array('form'=>$form->createView(),'error'=>1));
        } 
        if($request->isMethod('POST')){
            $form->handleRequest($request);

            if($form->isValid()){
                $compteur = $form->getData()->getCompteur();
                /*
                if($em->getRepository('SarahBundle:Utilisateur')->findByCompteur($compteur)){

                    return $this->redirect($this->generateUrl('sarah_admin',array('par1'=>1)));
                   
                }else{
                    */
                    $em->persist($user);
                    $em->flush();
                    return $this->redirect($this->generateUrl('sarah_admin'));
                    
               // }



            }
        }
        return $this->render('SarahBundle:admin:form.html.twig',array('form'=>$form->createView()));
    }

    // list des données
    public function listAction(){
        $em = $this->getDoctrine()->getManager();
        $utilisateurs = $em->getRepository('SarahBundle:Utilisateur')->findAll();


        return $this->render('SarahBundle:admin:list.html.twig',array('users'=>$utilisateurs));
    }
    
    /*
    public function editAction($id){
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('SarahBundle:Utilisateur')->find($id);

        $form = $this->createForm(new UtilisateurType(),$user);

        $request = $this->get('request');
       // if($error)  return $this->render('SarahBundle:Default:form.html.twig',array('form'=>$form->createView(),'error'=>1));
        if($request->isMethod('POST')){
            $form->handleRequest($request);

            if($form->isValid()){
                $compteur = $form->getData()->getCompteur();
                if($em->getRepository('SarahBundle:Utilisateur')->findByCompteur($compteur)){

                    return $this->redirect($this->generateUrl('sarah_admin',array('par1'=>1)));

                }else{
                    // c'est inutile  de faire un persiste puisque les données provients de la base
                  //  $em->persist($user);
                    $em->flush();
                    return $this->redirect($this->generateUrl('sarah_admin'));

                }



            }
        }
        return $this->redirect($this->generateUrl('sarah_admin',array('par1'=>0,'form'=>$id)));
        //return $this->render('SarahBundle:admin:admin.html.twig',array('form'=>$form->createView()));

    }*/
    public function removeAction($compteur){
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('SarahBundle:Utilisateur')->findByCompteur($compteur);
      //  var_dump($user);die;
        if(empty($user)) throw $this->createNotFoundException('le compteur suivant '.$compteur.' n\'existe pas');
        $em->remove($user['0']);
        $em->flush();

        return $this->redirect($this->generateUrl('sarah_admin'));

    }
}
