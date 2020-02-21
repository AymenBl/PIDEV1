<?php

namespace chasseBundle\Controller;

use chasseBundle\Entity\annimal;
use chasseBundle\Entity\lieu;
use chasseBundle\Form\annimalType;
use chasseBundle\Form\annimalupdateType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Mgilet\NotificationBundle\NotifiableInterface;

class annimalController extends Controller
{
    public function AddAction(Request $request)
    {
        $annimal = new annimal();

        $form = $this->createForm(annimalType::class, $annimal);

        $form = $form->handleRequest($request);
        $directory="photo/";
        if ($form->isValid()) {


            //$newfilename="$annimal->nomAnnimal";
              $file=$request->files->get("chassebundle_annimal")['image'];
              $uplods_directory = $this->getParameter('uplods_directory');
              $fileName=md5(uniqid()) . '.' . $file->guessExtension();

              $file->move(
                  $uplods_directory,
                  $fileName
              );
            $annimal->setImage("photo/".$fileName);

            $em = $this->getDoctrine()->getManager();
            $em->persist($annimal);
            $em->flush();
            return $this->redirectToRoute('listanimal');
        }
        return $this->render('@chasse/animal/add.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function listAction()
    {
        $annimal=$this->getDoctrine()->getRepository(annimal::class)->findAll();
        return $this->render('@chasse/animal/liste.html.twig', array(
            'annimal'=>$annimal
        ));}

        public function listanimalClientAction()
    {
        $annimal=$this->getDoctrine()->getRepository(annimal::class)->findAll();

        return $this->render('@chasse/animal/listeAnnimalClient.html.twig', array(
            'annimal'=>$annimal
        ));
    }


    public function supAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $annimal= $em->getRepository(annimal::class)->find($id);
        $em->remove($annimal);
        $em->flush();
        return $this->redirectToRoute("listanimal");
    }




    public function updateAction(Request $request,$id)
    {

        $annimal = $this->getDoctrine()->getManager()->getRepository(annimal::class)->find($id);
        $form =$this->createForm(annimalupdateType::class,$annimal);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $this->getDoctrine()->getManager()->persist($annimal);
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('listanimal');
        } else {
            return $this->render('@chasse/animal/update.html.twig', array('form' => $form->createView()));

        }

    }

    public function sendNotificationAction(Request $request)
    {
        $manager = $this->get('mgilet.notification');
        $notif = $manager->createNotification('Hello world !');
        $notif->setMessage('This a notification.');
        $notif->setLink('http://symfony.com/');
        // or the one-line method :
        // $manager->createNotification('Notification subject','Some random text','http://google.fr');

        // you can add a notification to a list of entities
        // the third parameter ``$flush`` allows you to directly flush the entities
        $manager->addNotification(array($this->getUser()), $notif, true);

        return $this->redirectToRoute('homepage');
    }


}
