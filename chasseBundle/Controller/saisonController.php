<?php

namespace chasseBundle\Controller;

use chasseBundle\Entity\annimal;
use chasseBundle\Entity\lieu;
use chasseBundle\Entity\saison;
use chasseBundle\Form\annimalType;
use chasseBundle\Form\lieuType;
use chasseBundle\Form\saisonRechType;
use chasseBundle\Form\saisonType;
use chasseBundle\Form\updatelieuType;
use chasseBundle\Form\updatesaisonType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class saisonController extends Controller
{
    public function AddAction(Request $request)
    {
        $saison = new saison();

        $form = $this->createForm(saisonType::class, $saison);

        $form = $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($saison);
            $em->flush();
            return $this->redirectToRoute('listsaison');
        }
        return $this->render('@chasse/saison/add.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function listAction()
    {
        $saison=$this->getDoctrine()->getRepository(saison::class)->findAll();
        return $this->render('@chasse/saison/liste.html.twig', array(
            'saison'=>$saison
        ));
    }

    public function supAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $saison= $em->getRepository(saison::class)->find($id);
        $em->remove($saison);
        $em->flush();
        return $this->redirectToRoute("listsaison");
    }

    public function updateAction(Request $request,$id)
    {

        $saison = $this->getDoctrine()->getManager()->getRepository(saison::class)->find($id);
        $form = $this->createForm(updatesaisonType::class, $saison);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $this->getDoctrine()->getManager()->persist($saison);
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('listsaison');
        } else {
            return $this->render('@chasse/saison/update.html.twig', array('form' => $form->createView()));

        }
    }

    public function RecherechAction(Request $request)
    {
        $saison = new saison();

        $form = $this->createForm(saisonRechType::class, $saison);

        $form = $form->handleRequest($request);
        $em = $this->getDoctrine()->getRepository(saison::class);

        if ($form->isValid()) {
            $Listsaison=  $em->findBy(array("animal"=>$saison->getAnimal(),"lieu"=>$saison->getLieu()));
          //  var_dump($Listsaison);
            return $this->render('@chasse/saison/Recherch.html.twig', array(
                'form' => $form->createView(),'saison'=>$Listsaison
            ));
        }else{
            $Listsaison = $this->getDoctrine()->getRepository(saison::class)->findAll();
            return $this->render('@chasse/saison/Recherch.html.twig', array(
                'form' => $form->createView(),'saison'=>$Listsaison
            ));
        }

    }

}
