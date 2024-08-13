<?php

namespace App\GameOperations\Domain\Game;

enum GamePlatform: string
{
    case PS4 = 'PS4';
    case PS5 = 'PS5';
    case XBOX_ONE = 'XBOX_ONE';
    case XBOX_SERIES_X = 'XBOX_SERIES_X';
    case PC = 'PC';
    case SWITCH = 'SWITCH';
    case MOBILE = 'MOBILE';
    case VR = 'VR';
}
