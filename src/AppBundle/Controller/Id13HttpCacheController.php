<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

class Id13HttpCacheController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        $response = $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);

        // cache for 3600 seconds
        $response->setSharedMaxAge(3600);

        // (optional) set a custom Cache-Control directive
        $response->headers->addCacheControlDirective('must-revalidate', true);

        return $response;
    }
/*
**•	Cache HTTP**
•	Types de cache (clients, proxies et reverse proxies)
•	Expiration (Expires, Cache-Control)
•	Validation (ETag, Last-Modified)
•	Cache côté client
•	Cache côté serveur
•	Edge Side Includes
*/
    /**
     * @Route("/cachedContent/{var}", name="cachepage")
     */
    public function expirationAction(Request $request)
    {
        /*$var = $request->get('var');
        $response = $this->render('cachepage.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
            'var' => $var.rand(1, 999)
        ]);*/
    }

    public function validationAction(Request $request)
    {
        //
    }

    /**
     * Test scenario:
     * - 1: set cache content
     * - 2: retrieve cache content
     * - 3: invalidate cache content
     */

    /**
     * @Route("/cachedContent/{var}", name="cachepage")
     */
    public function cacheAction(Request $request)
    {
        $var = $request->get('var');

        /*$cache = new FilesystemAdapter();
        $review = $cache->getItem('reviews-3');
        $review->set('reviews id 3 ...'.$var);
        $review->tag(['reviews', 'products']);
        $cache->save($review);*/

        // replace this example code with whatever you need
        /*$response = $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);*/

        $response = $this->render('cachepage.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
            'var' => $var.rand(1, 999)
        ]);

        // cache for 3600 seconds
        $response->setSharedMaxAge(3600);

        // (optional) set a custom Cache-Control directive
        $response->headers->addCacheControlDirective('must-revalidate', true);

        return $response;
    }
}
