<?php

namespace SfDoctrineBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use SfDoctrineBundle\Entity\Genus;
use SfDoctrineBundle\Form\GenusFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/admin")
 */
class GenusAdminController extends Controller
{
    /**
     * @Route("/genus", name="admin_genus_list")
     */
    public function indexAction()
    {
        $em = $this->get('doctrine.orm.sfdoctrine_entity_manager');
        $genuses = $em
            ->getRepository('SfDoctrineBundle:Genus')
            ->findAll();

        return $this->render('admin/genus/list.html.twig', array(
            'genuses' => $genuses
        ));
    }

    /**
     * @Route("/genus/new", name="admin_genus_new")
     */
    public function newAction(Request $request)
    {
        $form = $this->createForm(GenusFormType::class);

        // only handles on POST, and PUT or DELETE ? to check
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //dump($form->getData()); die;
            $genus = $form->getData();

            $em =$this->getDoctrine()->getManager('sfdoctrine');
            $em->persist($genus);
            $em->flush();

            $this->addFlash('success', 'Genus Created, you are amazing');
            return $this->redirectToRoute('admin_genus_list');
        }

        return $this->render('admin/genus/new.html.twig', [
            'genusForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/genus/{id}/edit", name="admin_genus_edit")
     */
    public function editAction(Request $request, Genus $genus)
    {
        $form = $this->createForm(GenusFormType::class, $genus);

        // only handles on POST, and PUT or DELETE ? to check
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //dump($form->getData()); die;
            $genus = $form->getData();

            $em =$this->getDoctrine()->getManager('sfdoctrine');
            $em->persist($genus);
            $em->flush();

            $this->addFlash('success', 'Genus Updated, you are amazing');
            return $this->redirectToRoute('admin_genus_list');
        }

        return $this->render('admin/genus/edit.html.twig', [
            'genusForm' => $form->createView()
        ]);
    }
}