<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'match' => [
        'beatmap-deleted' => 'mapa eliminado',
        'failed' => 'FALLIDO',
        'header' => 'Partidas multijugador',
        'in-progress' => '(partida en progreso)',
        'in_progress_spinner_label' => 'partida en progreso',
        'loading-events' => 'Cargando eventos...',
        'winner' => ':team gana',
        'winner_by' => ':winner por :difference',

        'events' => [
            'player-left' => ':user abandonó la partida',
            'player-joined' => ':user se unió a la partida',
            'player-kicked' => ':user ha sido expulsado de la partida',
            'match-created' => ':user creó la partida',
            'match-disbanded' => 'la partida fue disuelta',
            'host-changed' => ':user se convirtió en el anfitrión',

            'player-left-no-user' => 'un jugador abandonó la partida',
            'player-joined-no-user' => 'un jugador se unió a la partida',
            'player-kicked-no-user' => 'un jugador fue expulsado de la partida',
            'match-created-no-user' => 'la partida fue creada',
            'match-disbanded-no-user' => 'la partida fue disuelta',
            'host-changed-no-user' => 'el anfitrión ha cambiado',
        ],

        'score' => [
            'stats' => [
                'accuracy' => 'Precisión',
                'combo' => 'Combo',
                'score' => 'Puntuación',
            ],
        ],

        'team-types' => [
            'head-to-head' => 'Todos contra todos',
            'tag-coop' => 'Cooperativo',
            'team-vs' => 'Por equipos',
            'tag-team-vs' => 'Cooperativo por equipos',
        ],

        'teams' => [
            'blue' => 'Equipo azul',
            'red' => 'Equipo rojo',
        ],
    ],
    'game' => [
        'scoring-type' => [
            'score' => 'Puntuación más alta',
            'accuracy' => 'Precisión más alta',
            'combo' => 'Combo más alto',
            'scorev2' => 'Score V2',
        ],
    ],
];
