<?php

namespace App\Http\Controllers;

use App\Helpers\AssetHelper;
use App\Models\User;

class TeamController extends Controller
{
    public function index()
    {
        $users = User::all()->where('brc_team_role', '!=', null)->toArray();

        $founders = [];
        $partners = [];
        $team = [];

        foreach ($users as $user) {
            if (!empty($user['img_string'])) {
                $user['img_string'] = AssetHelper::getPublicAssetPath($user['img_string'] ?? '');
                switch ($user['brc_team_role']) {
                    case 'Founder':
                        $founders[] = $user;
                        break;
                    case 'Partner':
                        $partners[] = $user;
                        break;
                    case 'Team':
                        $team[] = $user;
                        break;
                }
            }
        }

        return view(
            'about-us',
            [
                'team' => $team,
                'founders' => $founders,
                'partners' => $partners,
            ]
        );
    }
}
