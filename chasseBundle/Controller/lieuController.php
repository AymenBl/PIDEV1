<?php

namespace chasseBundle\Controller;

use chasseBundle\Entity\annimal;
use chasseBundle\Entity\lieu;
use chasseBundle\Form\annimalupdateType;
use chasseBundle\Form\lieuType;
use chasseBundle\Form\updatelieuType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class lieuController extends Controller
{
    public function AddAction(Request $request)
    {
        $lieu = new lieu();

        $form = $this->createForm(lieuType::class, $lieu);

        $form = $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($lieu);
            $em->flush();
            return $this->redirectToRoute('listlieu');
        }
        return $this->render('@chasse/lieu/add.html.twig', array(
            'form' => $form->createView()
        ));
    }
    public function listlieuClientAction()
    {
        $lieu=$this->getDoctrine()->getRepository(lieu::class)->findAll();

        return $this->render('@chasse/lieu/listelieuClients.html.twig', array(
            'lieu'=>$lieu
        ));
    }


    public function listAction()
    {
        $lieu=$this->getDoctrine()->getRepository(lieu::class)->findAll();
        return $this->render('@chasse/lieu/liste.html.twig', array(
            'lieu'=>$lieu
        ));
    }
    public function supAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $lieu= $em->getRepository(lieu::class)->find($id);

        $em->remove($lieu);
        $em->flush();


        return $this->redirectToRoute("listlieu");
    }

    public function updateAction(Request $request,$id)
    {

        $lieu = $this->getDoctrine()->getManager()->getRepository(lieu::class)->find($id);
        $form =$this->createForm(updatelieuType::class,$lieu);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $this->getDoctrine()->getManager()->persist($lieu);
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('listlieu');
        } else {
            return $this->render('@chasse/lieu/update.html.twig', array('form' => $form->createView()));

        }

    }


}
