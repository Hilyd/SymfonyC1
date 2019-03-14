<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;


class DemoController extends AbstractController
{
    /*
     * @Route("/", name="homepage")
     */
    public function index()
    {
        return $this->render('demo/index.html.twig');
    }


    /**
     * @Route (
     *         methods={"GET"},
     *         requirements={"name"="^[A-Za-z]+$"},
     *         defaults = {"name" = "sophie"},
     *         localizedPaths={"en"="/hello/{name}", "fr"="/bonjour/{name}"}
     *         )
     */
    public function hello($name, Request $request): Response
    {

        $c = new Cookie('foo', 'bar');

        $response = new Response();
        $response->headers->setCookie($c);

        return $response;


        if($name === 'nobody') {
            throw new NotFoundHttpException('User nobody does not exist');
        }

        if ($name === 'foo') {
            return $this->redirectToRoute('homepage');
            return new RedirectResponse('/');
        }

        return $this->json(['name' => $name]);
        return new JsonResponse(['name' => $name]);
        return $this->render('demo/hello.html.twig', ['name' => $name]);
    }
}
