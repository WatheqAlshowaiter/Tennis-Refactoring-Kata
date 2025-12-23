<?php

declare(strict_types=1);

namespace TennisGame;

class TennisGame7 implements TennisGame
{
    public function __construct(
        private $player1Name,
        private $player2Name,
        private $player1Score = 0,
        private $player2Score = 0,
    ) {
    }

    public function wonPoint($playerName): void
    {
        if ($playerName === 'player1') {
            $this->player1Score++;
        } else {
            $this->player2Score++;
        }
    }

    public function getScore(): string
    {
        $result = 'Current score: ';

        if ($this->isTieScore()) {
            $result .= match ($this->player1Score) {
                0 => 'Love-All',
                1 => 'Fifteen-All',
                2 => 'Thirty-All',
                default => 'Deuce',
            };
        } else {
            if ($this->isRegularScore()) {
                $result .= match ($this->player1Score) {
                    0 => 'Love',
                    1 => 'Fifteen',
                    2 => 'Thirty',
                    default => 'Forty',
                };
                $result .= '-';
                $result .= match ($this->player2Score) {
                    0 => 'Love',
                    1 => 'Fifteen',
                    2 => 'Thirty',
                    default => 'Forty',
                };
            } else {
                $result = $this->endGameScore($result);
            }
        }

        return $result.', enjoy your game!';
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
    private function isRegularScore(): bool
    {
        return $this->player1Score < 4 && $this->player2Score < 4;
    }

    /**
     * @param  string  $result
     *
     * @return string
     */
    private function endGameScore(string $result): string
    {
        if ($this->player1Score - $this->player2Score === 1) {
            $result .= 'Advantage '.$this->player1Name;
        } elseif ($this->player1Score - $this->player2Score === -1) {
            $result .= 'Advantage '.$this->player2Name;
        } elseif ($this->player1Score - $this->player2Score >= 2) {
            $result .= 'Win for '.$this->player1Name;
        } else {
            $result .= 'Win for '.$this->player2Name;
        }
        return $result;
    }
}
