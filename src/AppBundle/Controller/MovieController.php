<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Movie;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class MovieController extends BaseController
{
    /**
     *
     * @Route("/movies/new", name="movies_new")
     */
    public function newAction(Request $request)
    {
        $movie = new Movie();
        $form = $this->createForm('AppBundle\Form\MovieType', $movie);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getEntityManager();
            $em->persist($movie);
            $em->flush();
            $message = 'sam would be prod';
            $this->addFlash('success', $message);
            return $this->redirectToRoute('movies_list', array());
        }

        return $this->render('movie/new.html.twig', [
            'quote' => $this->get('quote_generator')->getRandomQuote(),
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/movies", name="movies_list")
     */
    public function listAction()
    {
        $em = $this->getEntityManager();
        $movies = $em->getRepository('AppBundle:Movie')
            ->findAll();
        return $this->render('movie/list.html.twig', [
            'movies' => $movies
        ]);
    }


}
