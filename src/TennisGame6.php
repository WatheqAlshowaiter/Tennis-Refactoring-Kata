<?php

declare(strict_types=1);

namespace TennisGame;

class TennisGame6 implements TennisGame
{
    public function __construct(
        private $player1Name,
        private $player2Name,
        private $player1Score = 0,
        private $player2Score = 0,
    ) {
    }

    public function wonPoint($playerNameName): void
    {
        if ($playerNameName === 'player1') {
            $this->player1Score++;
        } else {
            $this->player2Score++;
        }
    }

    public function getScore(): string
    {
        $result = '';

        if ($this->isTieScore()) {
            $result = match ($this->player1Score) {
                0 => 'Love-All',
                1 => 'Fifteen-All',
                2 => 'Thirty-All',
                default => 'Deuce',
            };
        } elseif ($this->endGameScore()) {
            if ($this->player1Score - $this->player2Score === 1) {
                $result = 'Advantage '.$this->player1Name;
            } elseif ($this->player1Score - $this->player2Score === -1) {
                $result = 'Advantage '.$this->player2Name;
            } elseif ($this->player1Score - $this->player2Score >= 2) {
                $result = 'Win for '.$this->player1Name;
            } else {
                $result = 'Win for '.$this->player2Name;
            }
        } else {
            // regular score
            $score1 = match ($this->player1Score) {
                0 => 'Love',
                1 => 'Fifteen',
                2 => 'Thirty',
                default => 'Forty',
            };
            $score2 = match ($this->player2Score) {
                0 => 'Love',
                1 => 'Fifteen',
                2 => 'Thirty',
                default => 'Forty',
            };
            $result = $score1.'-'.$score2;
        }

        return $result;
    }

    /**
     * @return bool
     */
    private function isTieScore(): bool
    {
        return $this->player1Score === $this->player2Score;
    }

    /**
     * @return bool
     */
    private function endGameScore(): bool
    {
        return $this->player1Score >= 4 || $this->player2Score >= 4;
    }
}
