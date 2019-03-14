<?php
namespace App\Game;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Game
{
    private $session;
    private CONST SESSION_INDEX = 'game_letters';

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function getLetters() : array
    {
        return $this->readLetters();
    }

    public function addLetter(string ... $letter) :void
    {
        $sessionLetters = $this->readLetters();
        $sessionLetters = array_merge($sessionLetters, $letter);
        $this->writeLetters($sessionLetters);
    }

    public function addWord (string $word) :void
    {

        $this->addLetter(... str_split($word));
    }

    public function clearLetters () :void
    {
        $this->session->remove(self::SESSION_INDEX);
    }

    private function readLetters() :array
    {
        return $this->session->get(self::SESSION_INDEX, [ ]);
    }

    private function writeLetters(array $letters): void
    {
        $this->session->set(self::SESSION_INDEX, $letters);
    }
}