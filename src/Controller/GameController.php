<?php

namespace App\Controller;

use App\Game\Game;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends AbstractController

    /**
     * @Route("/game/{_locale}", requirements={"_locale" = "fr|en|de"})
     */
{
    private $game;

    public function __construct(Game $game)
    {
    $this->game = $game;
    }

    /**
     * @Route("/show")
     */
    public function show(Request $r)
    {
        $letters = $this->game->getLetters();
        return $this->render('game/show.html.twig', ['game_letters' => $letters]);
    }

    /**
     * @Route("/restart")
     */
    public function restart(Request $r) {
        $this->game->clearLetters();
        return $this->redirectToRoute('app_game_show');
    }
    /**
     * @Route("/play/letter/{letter}", requirements={"letter"="[A-Z]"})
     */
    public function playLetter(string $letter, Request $r) {
     //   $letter = $r->attributes->get('letter');
        $this->game->addLetter($letter);
        return $this->redirectToRoute(('app_game_show'));
    }

    /**
     * @Route("/playword", methods={"POST"}, condition="request.request.get('word') matches '#^[a-zA-Z]+$#'")
     */
    public function playWord(Request $r) {

       $this->game->addWord($r->request->get('word'));
        return $this->redirectToRoute(('app_game_show'));
    }
}
