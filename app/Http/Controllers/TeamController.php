<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\DataProviders\eJunkie\EjProductDataProvider;
use App\Enums\CompanyPositionEnum;
use App\Models\Creator;
use Illuminate\Contracts\View\View;

class TeamController extends Controller
{
    public function index()
    {
        $users = User::all()->where('brc_team_role',  '!=', null)->toArray();

        $founders = [];
        $creators= [];
        $partners = [];
        $team = [];

        foreach ($users as $user) {
            switch($user['brc_team_role']) {
                case 'Founder':
                    $founders[] = $user;
                    break;
                case 'Partner':
                    $partners[] = $user;
                    break;
                case 'Team':
                    $team[] = $user;
            }
        }

        $creators = Creator::all()->toArray();

        return view(
            'about-us',
            [
                'users' => $users,
                'team' => $team,
                'founders' => $founders,
                'creators' => $creators,
                'partners' => $partners,
            ]
        );
    }
}