<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\DataProviders\eJunkie\EjProductDataProvider;
use App\Enums\CompanyPositionEnum;
use App\Models\Creator;
use Illuminate\Contracts\View\View;
use App\Helpers\ImageHelper;

class TeamController extends Controller
{
  public function index()
  {
    $users = User::all()->where('brc_team_role',  '!=', null)->toArray();

    $founders = [];
    $partners = [];
    $team = [];

    foreach ($users as $user) {
      $user['img_string'] = ImageHelper::getPublicAssetPath($user['img_string']);

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

