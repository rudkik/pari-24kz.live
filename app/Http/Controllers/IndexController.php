<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Visit;
use App\Models\Sports;
use App\Models\League;
use App\Models\Stavka;
use App\Models\Game;
use App\Models\RejectionReason;

use App\Models\Dogovor;
use App\Models\Outcome;
use App\Models\WithdrawalRequest;
use App\Models\Banner;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use TCG\Voyager\Models\Role;
use App\Models\DepositHistory;
use TCG\Voyager\Facades\Voyager;
use App\Models\VerificationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use App\Models\MatchLimit;
use Illuminate\Support\Facades\Cache;
use DateTime;


class IndexController extends Controller
{

    public function dogmatch(Request $request)
    {

        $arr_y = [];
        $events_list = [];
        $tour = Dogovor::all();


        $arr_res_sport = [];
        $sports = Sports::all();
        $sps = $this->getSports();
        $g = 0;
        foreach ($sports as $sport) {

            foreach ($sps as $sp) {
                if ($sp['id_sport'] == $sport->id_api) {
                    if ($sp['counter'] != 0) {
                        $arr_res_sport[$g]['counter'] = $sp['counter'];
                        $arr_res_sport[$g]['name'] = $sport->title;
                        $arr_res_sport[$g]['id_sport'] = $sport->id_api;
                        $arr_res_sport[$g]['img'] = $sport->img;
                    }
                }
            }
            $g++;
        }

        return view('dogmatch', ['arr_res_sport' => $arr_res_sport, 'request' => $request, 'tour' => $tour]);
    }

    public function match1(Request $request)
    {
        $arr_res_sport = [];
        $sports = Sports::all();
        $sps = $this->getSports();
        $g = 0;
        foreach ($sports as $sport) {

            foreach ($sps as $sp) {
                if ($sp['id_sport'] == $sport->id_api) {
                    if ($sp['counter'] != 0) {
                        $arr_res_sport[$g]['counter'] = $sp['counter'];
                        $arr_res_sport[$g]['name'] = $sport->title;
                        $arr_res_sport[$g]['id_sport'] = $sport->id_api;
                        $arr_res_sport[$g]['img'] = $sport->img;
                    }
                }
            }
            $g++;
        }
        $arr_new = $this->getTours(0);
        return view('match1', ['request' => $request, 'arr_res_sport' => $arr_res_sport, 'data_leages' => $arr_new]);
    }

    public function live(Request $request)
    {
        $limit = MatchLimit::where('name', 'live')->first()->limit;

        $arr_y = [];
        $events = $this->getEvents(0, 0, 'live');
        $sports = Sports::all();
        $all_events = [];

        foreach ($sports as $sport) {
            foreach ($events as $ev) {
                foreach ($ev->events_list as $event) {
                    if ($event->sport_id == $sport->id_api) {
                        $current_time = new \DateTime("now", new \DateTimeZone('Europe/Moscow'));

                        $current_time->modify('-3 hours');
                        $random_minutes = rand(10, 40);

                        $current_time->modify("-{$random_minutes} minutes");


                        $current_timestamp = $current_time->getTimestamp();

                        $rounded_timestamp = $current_timestamp - ($current_timestamp % 300);

                        $event_data = [
                            'title' => $event->title,
                            'game_start' => $rounded_timestamp,
                            'tournament_id' => $event->tournament_id,
                            'game_id' => $event->game_id,
                            'opp_1_name_ru' => $event->opp_1_name_ru,
                            'opp_2_name_ru' => isset($event->opp_2_name_ru) ? $event->opp_2_name_ru : "",
                            '1x2' => [],
                            'two' => [],
                            'total' => [],
                            'b' => [],
                            'm' => [],
                            'sport_id' => $event->sport_id
                        ];

                        foreach ($event->game_oc_list as $list) {
                            if ($list->oc_group_name == "1x2") {
                                $event_data['1x2'][] = [
                                    'oc_rate' => $list->oc_rate,
                                    'oc_name' => $list->oc_name
                                ];
                            }
                            if ($list->oc_group_name == "Двойной шанс") {
                                $event_data['two'][] = [
                                    'oc_rate' => $list->oc_rate,
                                    'oc_name' => $list->oc_name
                                ];
                            }
                            if ($list->oc_group_name == "Тотал") {
                                $event_data['total'][] = [
                                    'oc_rate' => $list->oc_rate,
                                    'oc_name' => $list->oc_name
                                ];
                            }
                            if (strpos($list->oc_name, "Больше") !== false) {
                                $event_data['b'][] = [
                                    'oc_rate' => $list->oc_rate,
                                    'oc_name' => $list->oc_name
                                ];
                            }
                            if (strpos($list->oc_name, "Меньше") !== false) {
                                $event_data['m'][] = [
                                    'oc_rate' => $list->oc_rate,
                                    'oc_name' => $list->oc_name
                                ];
                            }
                        }

                        $all_events[] = [
                            'sport_title' => $sport->title,
                            'sport_img' => $sport->img,
                            'event_data' => $event_data
                        ];
                    }
                }
            }
        }

        shuffle($all_events);

        $selected_events = array_slice($all_events, 0, $limit);

        foreach ($selected_events as $event_info) {
            $sport_title = $event_info['sport_title'];
            $sport_img = $event_info['sport_img'];
            $event_data = $event_info['event_data'];

            $found = false;
            foreach ($arr_y as &$sport_event) {
                if ($sport_event['sport_title'] === $sport_title) {
                    $sport_event['events'][] = $event_data;
                    $found = true;
                    break;
                }
            }

            if (!$found) {
                $arr_y[] = [
                    'sport_title' => $sport_title,
                    'sport_img' => $sport_img,
                    'events' => [$event_data]
                ];
            }
        }

        $arr_res_sport = [];
        $sps = $this->getSports('live');

        foreach ($sports as $sport) {
            foreach ($sps as $sp) {
                if ($sp['id_sport'] == $sport->id_api && $sp['counter'] != 0) {
                    $arr_res_sport[] = [
                        'counter' => $sp['counter'],
                        'name' => $sport->title,
                        'id_sport' => $sport->id_api,
                        'img' => $sport->img
                    ];
                }
            }
        }

        $arr_new = $this->getTours(0);
        $banner = 'bn1.jpg';

        return view('live', [
            'arry' => $arr_y,
            'arr_res_sport' => $arr_res_sport,
            'request' => $request,
            'data_leages' => $arr_new
        ]);
    }
    public function live1(Request $request)
    {
        $limit = 9;

        $arr_y = [];
        $events = $this->getEvents(0, 0, 'live');
        $sports = Sports::all();
        $all_events = [];

        foreach ($sports as $sport) {
            foreach ($events as $ev) {
                foreach ($ev->events_list as $event) {
                    if ($event->sport_id == $sport->id_api) {
                        $current_time = new \DateTime("now", new \DateTimeZone('Europe/Moscow'));

                        $current_time->modify('-3 hours');
                        $random_minutes = rand(10, 40);

                        $current_time->modify("-{$random_minutes} minutes");


                        $current_timestamp = $current_time->getTimestamp();

                        $rounded_timestamp = $current_timestamp - ($current_timestamp % 300);

                        $event_data = [
                            'title' => $event->title,
                            'game_start' => $rounded_timestamp,
                            'tournament_id' => $event->tournament_id,
                            'game_id' => $event->game_id,
                            'opp_1_name_ru' => $event->opp_1_name_ru,
                            'opp_2_name_ru' => isset($event->opp_2_name_ru) ? $event->opp_2_name_ru : "",
                            '1x2' => [],
                            'two' => [],
                            'total' => [],
                            'b' => [],
                            'm' => [],
                            'sport_id' => $event->sport_id
                        ];

                        foreach ($event->game_oc_list as $list) {
                            if ($list->oc_group_name == "1x2") {
                                $event_data['1x2'][] = [
                                    'oc_rate' => $list->oc_rate,
                                    'oc_name' => $list->oc_name
                                ];
                            }
                            if ($list->oc_group_name == "Двойной шанс") {
                                $event_data['two'][] = [
                                    'oc_rate' => $list->oc_rate,
                                    'oc_name' => $list->oc_name
                                ];
                            }
                            if ($list->oc_group_name == "Тотал") {
                                $event_data['total'][] = [
                                    'oc_rate' => $list->oc_rate,
                                    'oc_name' => $list->oc_name
                                ];
                            }
                            if (strpos($list->oc_name, "Больше") !== false) {
                                $event_data['b'][] = [
                                    'oc_rate' => $list->oc_rate,
                                    'oc_name' => $list->oc_name
                                ];
                            }
                            if (strpos($list->oc_name, "Меньше") !== false) {
                                $event_data['m'][] = [
                                    'oc_rate' => $list->oc_rate,
                                    'oc_name' => $list->oc_name
                                ];
                            }
                        }

                        $all_events[] = [
                            'sport_title' => $sport->title,
                            'sport_img' => $sport->img,
                            'event_data' => $event_data
                        ];
                    }
                }
            }
        }

        shuffle($all_events);

        $selected_events = array_slice($all_events, 0, $limit);

        foreach ($selected_events as $event_info) {
            $sport_title = $event_info['sport_title'];
            $sport_img = $event_info['sport_img'];
            $event_data = $event_info['event_data'];

            $found = false;
            foreach ($arr_y as &$sport_event) {
                if ($sport_event['sport_title'] === $sport_title) {
                    $sport_event['events'][] = $event_data;
                    $found = true;
                    break;
                }
            }

            if (!$found) {
                $arr_y[] = [
                    'sport_title' => $sport_title,
                    'sport_img' => $sport_img,
                    'events' => [$event_data]
                ];
            }
        }

        $arr_res_sport = [];
        $sps = $this->getSports('live');

        foreach ($sports as $sport) {
            foreach ($sps as $sp) {
                if ($sp['id_sport'] == $sport->id_api && $sp['counter'] != 0) {
                    $arr_res_sport[] = [
                        'counter' => $sp['counter'],
                        'name' => $sport->title,
                        'id_sport' => $sport->id_api,
                        'img' => $sport->img
                    ];
                }
            }
        }

        $arr_new = $this->getTours(0);
        $banner = 'bn1.jpg';

        return view('live1', [
            'arry' => $arr_y,
            'arr_res_sport' => $arr_res_sport,
            'request' => $request,
            'data_leages' => $arr_new
        ]);
    }
    public function sportres(Request $request)
    {
        $arr_res_sport = [];
        $sports = Sports::all();
        $sps = $this->getSports();
        $g = 0;
        foreach ($sports as $sport) {

            foreach ($sps as $sp) {
                if ($sp['id_sport'] == $sport->id_api) {
                    if ($sp['counter'] != 0) {
                        $arr_res_sport[$g]['counter'] = $sp['counter'];
                        $arr_res_sport[$g]['name'] = $sport->title;
                        $arr_res_sport[$g]['id_sport'] = $sport->id_api;
                        $arr_res_sport[$g]['img'] = $sport->img;
                    }
                }
            }
            $g++;
        }

        $arr_new = $this->getTours(0);
        return view('res', ['request' => $request, 'arr_res_sport' => $arr_res_sport, 'data_leages' => $arr_new]);
    }


    public function sport(Request $request)
    {
        $limit = cache()->remember('match_limit_sport', 600, function () {
            return MatchLimit::where('name', 'sport')->value('limit');
        });

        $arr_y = [];
        $sports = Sports::all();
        $events = $this->getEvents(0, 0, 'line');
        $all_events = [];

        foreach ($sports as $sport) {
            foreach ($events as $ev) {
                foreach ($ev->events_list as $event) {
                    if ($event->sport_id == $sport->id_api) {
                        $currentTime = time();
                        $eventTime = strtotime($event->game_start);

                        if ($eventTime <= $currentTime) {
                            $game = cache()->remember("game_{$event->game_id}", 600, function () use ($event) {
                                return Game::find($event->game_id);
                            });

                            if ($game) {
                                $roundedDate = $this->roundMinutesAndRandomizeHour(new DateTime($game->game_start));
                                $event->game_start = $roundedDate->format('H:i d:m');
                            }
                        }

                        $event_data = $this->formatEventData($event);

                        $all_events[] = [
                            'sport_title' => $sport->title,
                            'sport_img' => $sport->img,
                            'event_data' => $event_data
                        ];
                    }
                }
            }
        }

        shuffle($all_events);

        $selected_events = array_slice($all_events, 0, $limit);

        $arr_y = $this->groupEventsBySport($selected_events);

        $arr_res_sport = $this->getSportsSidebarData($sports);

        $arr_new = cache()->remember('tours_data', 600, function() {
            return $this->getTours(0);
        });

        return view('sport', [
            'arry' => $arr_y,
            'arr_res_sport' => $arr_res_sport,
            'request' => $request,
            'data_leages' => $arr_new
        ]);
    }

    private function formatEventData($event)
    {
        $event_data = [
            'game_start' => $event->game_start,
            'title' => $event->title,
            'tournament_id' => $event->tournament_id,
            'game_id' => $event->game_id,
            'opp_1_name_ru' => $event->opp_1_name_ru,
            'opp_2_name_ru' => $event->opp_2_name_ru ?? "",
            '1x2' => [],
            'two' => [],
            'total' => [],
            'b' => [],
            'm' => [],
            'sport_id' => $event->sport_id
        ];

        foreach ($event->game_oc_list as $list) {
            switch ($list->oc_group_name) {
                case "1x2":
                    $event_data['1x2'][] = ['oc_rate' => $list->oc_rate, 'oc_name' => $list->oc_name];
                    break;
                case "Двойной шанс":
                    $event_data['two'][] = ['oc_rate' => $list->oc_rate, 'oc_name' => $list->oc_name];
                    break;
                case "Тотал":
                    $event_data['total'][] = ['oc_rate' => $list->oc_rate, 'oc_name' => $list->oc_name];
                    break;
            }
            if (strpos($list->oc_name, "Больше") !== false) {
                $event_data['b'][] = ['oc_rate' => $list->oc_rate, 'oc_name' => $list->oc_name];
            }
            if (strpos($list->oc_name, "Меньше") !== false) {
                $event_data['m'][] = ['oc_rate' => $list->oc_rate, 'oc_name' => $list->oc_name];
            }
        }

        return $event_data;
    }

    private function groupEventsBySport($selected_events)
    {
        $grouped_events = [];

        foreach ($selected_events as $event_info) {
            $sport_title = $event_info['sport_title'];
            $sport_img = $event_info['sport_img'];
            $event_data = $event_info['event_data'];

            if (!isset($grouped_events[$sport_title])) {
                $grouped_events[$sport_title] = [
                    'sport_title' => $sport_title,
                    'sport_img' => $sport_img,
                    'events' => []
                ];
            }

            $grouped_events[$sport_title]['events'][] = $event_data;
        }

        return array_values($grouped_events);
    }

    private function getSportsSidebarData($sports)
    {
        $sps = $this->getSports('line');
        $arr_res_sport = [];

        foreach ($sports as $sport) {
            foreach ($sps as $sp) {
                if ($sp['id_sport'] == $sport->id_api && $sp['counter'] != 0) {
                    $arr_res_sport[] = [
                        'counter' => $sp['counter'],
                        'name' => $sport->title,
                        'id_sport' => $sport->id_api,
                        'img' => $sport->img
                    ];
                }
            }
        }

        return $arr_res_sport;
    }

    public function searchtxt(Request $request)
    {
        $arr_new_1 = $this->getTours(0);

        $res = '';
        foreach ($arr_new_1 as $data_leage) {
            if (stripos(mb_strtolower($data_leage['name']), mb_strtolower($request->word)) !== false) {
                $res .= '<li>
									<a class="list-leag__itm" href="/bets/' . $data_leage["sport_id"] . '/' . $data_leage["id_tourn"] . '"> <span class="list-leag__ico">
										<picture>
											<img class="p-img-c" src="/img/ico/l' . $data_leage["icon"] . '.png" loading="lazy" width="100" height="100" alt="иконка">
										</picture>
										</span><span>' . $data_leage["name"] . '</span>
									</a>
								</li>';
            }
        }

        return $res;
    }

    public function match(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/');
        }

        $arr_res_sport = [];
        $sports = Sports::all();
        $sps = $this->getSports();
        $g = 0;

        foreach ($sports as $sport) {
            foreach ($sps as $sp) {
                if ($sp['id_sport'] == $sport->id_api) {
                    if ($sp['counter'] != 0) {
                        $arr_res_sport[$g]['counter'] = $sp['counter'];
                        $arr_res_sport[$g]['sport_name'] = $sport->title;
                        $arr_res_sport[$g]['name'] = $sport->title;
                        $arr_res_sport[$g]['id_sport'] = $sport->id_api;
                        $arr_res_sport[$g]['img'] = $sport->img;
                    }
                }
            }
            $g++;
        }

        $stavki = Stavka::where('user', auth()->user()->id)->orderBy('created_at', 'desc')->get();

        $data_leagues = League::all();

        return view('match', [
            'request' => $request,
            'stavki' => $stavki,
            'arr_res_sport' => $arr_res_sport,
            'data_leagues' => $data_leagues
        ]);
    }
    
    public function draw(Request $request)
    {


        return view('draw', [
        ]);
    }
    public function adminuserliststavki(Request $request)
    {
        $sts = Stavka::where('user', $request->user_id)->get();

        $res = '<table class="table-ipr table_res">
                <thead class="table-ipr__top">
                  <tr>
                    <th>ID</th>
                    <th>Описание</th>
                    <th>Тип</th>
                    <th>Сумма</th>
                    <th>Cтатус</th>
                    <th>Дата</th>
                  </tr>
                </thead>';
        foreach ($sts as $st) {
            $res .= '<tr class="table-ipr__line">
                    <td>' . $st->id . '</td>
                    <td class="table-ipr__grid"><span>' . $st->v . '</span><span class="table-ipr__small">' . $st->game_id . '</span><span class="table-ipr__small"></span></td>
                    <td class="table-ipr__inc">ставка</td>
                    <td>' . $st->summa . '</td>
                    <td class="status">' . $st->status . '</td>
                    <td class="table-ipr__td-clm"> <span>' . date('d.m.Y', strtotime($st->created_at)) . '</span><span> ' . date('H:i', strtotime($st->created_at)) . '</span></td>';

            if ($st->status == 'Не определен') {
                $res .= '<td><button class="wdr-pay vivod-pay" data-id="' . $st->id . '">Выдать</button></td>';
            }

            $res .= '</tr>';
        }
        return $res . '</table>';

    }

    public function privateadminid($id, Request $request)
    {
        if (auth()->user()->role->id != 1) {
            return redirect('/');
        }
        $user = User::where('id', $id)->first();
        $verificationRequests = VerificationRequest::where('user_id', $id)->get();

        if ($verificationRequests) {
            foreach ($verificationRequests as $verify) {
                $verify->image_links = explode(',', $verify->image_links);
            }
        }

        $reasons = RejectionReason::all();

        return view('private', [
            'request' => $request,
            'user' => $user,
            'verificationRequests' => $verificationRequests,
            'reasons' => $reasons
        ]);
    }


    public function index(Request $request)
    {
        $sports = Sports::all();
        $data_leagues = League::all();

        $data_leagues = $data_leagues->map(function ($league) {
            $sport = Sports::find($league->sport_id);
            $league->sport_name = $sport ? $sport->title : 'Unknown';
            return $league;
        });

        $arr_y = [];
        $tour = Arr::random($data_leagues->toArray(), 2);

        $j = 0;

        foreach ($tour as $t) {
            if ($j == 2) break;

            $events = $this->getEvents($t['sport_id'], $t['id'], null);

            $events_list = [];
            $i = 0;

            foreach ($events as $event) {
                foreach ($event->events_list as $event_detail) {

                    $events_list[$i]['game_start'] = $event_detail->game_start;
                    $events_list[$i]['tournament_id'] = $event_detail->tournament_id;
                    $events_list[$i]['game_id'] = $event_detail->game_id;
                    $events_list[$i]['opp_1_name_ru'] = $event_detail->opp_1_name_ru;
                    $events_list[$i]['opp_2_name_ru'] = isset($event_detail->opp_2_name_ru) ? $event_detail->opp_2_name_ru : "";
                    $events_list[$i]['1x2'] = $event_detail->game_oc_list[0]->oc_rate;
                    $events_list[$i]['two'] = $event_detail->game_oc_list[1]->oc_rate;
                    $events_list[$i]['total'] = [];
                    $events_list[$i]['b'] = [];
                    $events_list[$i]['m'] = [];
                    $events_list[$i]['sport_id'] = $event_detail->sport_id;
                    $events_list[$i]['sport_name'] = $event_detail->sport_name;

                    $i++;
                }
            }

            if (!empty($events_list)) {
                $arr_y[$j]['name'] = $t['name'];
                $arr_y[$j]['events'] = $events_list;
            }
            $j++;
        }

        $events = [];

        foreach ($arr_y as $arr) {
            foreach ($arr['events'] as $event) {
                $events[] = $event;
            }
        }

        $events = array_slice($events, 0, 14);

        $banners = Banner::where('active', true)->get();

        return view('index', [
            'request' => $request,
            'sports' => $sports,
            'data_leagues' => $data_leagues,
            'events' => $events,
            'banners' => $banners,
        ]);
    }


    public function privateadmin(Request $request)
    {
        if (auth()->user()->role->id != 1) {
            return redirect('/');
        }
        $users = User::orderBy('created_at', 'desc')->get();
        return view('private_users', ['request' => $request, 'users' => $users]);
    }

    public function reg(Request $request)
    {

        if (User::where('email', $request->email)->exists()) {
            return response()->json([
                'errors' => 'Такой Email уже существует'
            ]);
        }

        $data = $request->all();
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->phone = $data['phone'];
        $user->password = Hash::make($data['password']);
        $user->cur = $data['cur'];
        $user->ip = $this->getRealIpAddress($request);
        $user->money = 0;
        $user->bonus = 0;
        $user->role_id = 2;
        $user->dummy_id = rand(100000, 10000000);
        $user->no_vivod = 1;
        $user->save();

        Auth::login($user);
        
        $request->session()->put('user_ip', $this->getRealIpAddress($request));

        return 1;

    }

    public function t(Request $request)
    {


    }

    public function private(Request $request)
    {
        return view('private-lobby', ['request' => $request]);
    }

    public function privatestat(Request $request)
    {
        $todayStart = now()->startOfDay();
        $now = now();

        $deposits = DepositHistory::whereBetween('created_at', [$todayStart, $now])->get();
        $countAllDeposits = $deposits->count();
        $sumAllDeposits = $deposits->sum('sum');

        $manuallyDeposits = DepositHistory::whereBetween('created_at', [$todayStart, $now])
            ->where('payment_gateway', 'Вручную')
            ->get();
        $countManuallyDeposits = $manuallyDeposits->count();
        $sumManuallyDeposits = $manuallyDeposits->sum('sum');

        $standardDeposits = DepositHistory::whereBetween('created_at', [$todayStart, $now])
            ->where('payment_gateway', '!=', 'Вручную')
            ->get();
        $countStandardDeposits = $standardDeposits->count();
        $sumStandardDeposits = $standardDeposits->sum('sum');

        $usersCount = User::whereBetween('created_at', [$todayStart, $now])->count();
        $visitsCount = Visit::whereBetween('created_at', [$todayStart, $now])->count();

        return view('private-stat', [
            'request' => $request,
            'usersCount' => $usersCount,
            'sumAllDeposits' => $sumAllDeposits,
            'countAllDeposits' => $countAllDeposits,
            'sumManuallyDeposits' => $sumManuallyDeposits,
            'countManuallyDeposits' => $countManuallyDeposits,
            'sumStandardDeposits' => $sumStandardDeposits,
            'countStandardDeposits' => $countStandardDeposits,
            'visitsCount' => $visitsCount,
        ]);
    }

    public function privatecontract(Request $request)
    {
        $sports = Sports::all();

        return view('private-contract', ['request' => $request, 'sports' => $sports]);
    }

    public function privatecontractcreate(Request $request)
    {
        $validatedData = $request->validate([
            'tour_name' => 'required|string',
            'team_name_1' => 'required|string',
            'team_name_2' => 'required|string',
            'tour_sport' => 'required',
            'tour_game_start' => 'required',
            'tour_game_end' => 'required',
            'outcomes' => 'required|array',
            'outcomes.*.name' => 'required|string',
            'outcomes.*.odds' => 'required|numeric',
            'p' => 'required|numeric',
            'p_1' => 'required|numeric',
            'p_2' => 'required|numeric',
            'd_1' => 'required|numeric',
            'd_2' => 'required|numeric',
            'd_12' => 'required|numeric',
        ]);

        $dogovor = Dogovor::create([
            'name' => $validatedData['tour_name'],
            'name_1' => $validatedData['team_name_1'],
            'name_2' => $validatedData['team_name_2'],
            'tour_sport' => $validatedData['tour_sport'],
            'game_start' => $validatedData['tour_game_start'],
            'game_end' => $validatedData['tour_game_end'],
            'p' => $validatedData['p'],
            'p_1' => $validatedData['p_1'],
            'p_2' => $validatedData['p_2'],
            'd_1' => $validatedData['d_1'],
            'd_2' => $validatedData['d_2'],
            'd_12' => $validatedData['d_12'],
        ]);

        foreach ($validatedData['outcomes'] as $outcome) {
            Outcome::create([
                'dogovor_id' => $dogovor->id,
                'name' => $outcome['name'],
                'odds' => $outcome['odds'],
            ]);
        }

        return back()->with('message', 'Договорной матч успешно создан');
    }

    public function viewDogovorMatches(Request $request)
    {
        $matches = Dogovor::orderBy('created_at', 'desc')->get();


        return view('private-matches', ['matches' => $matches]);
    }


    public function viewDogovorMatchDetails($id)
    {
        $match = Dogovor::with('outcomes')->findOrFail($id);
        return view('private-match-details', ['match' => $match]);
    }

    public function updateDogovorMatch(Request $request, $id)
{
    $dogovor = Dogovor::findOrFail($id);
    
    $updatableFields = [
        'name', 'name_1', 'name_2', 'game_start', 'game_end',
        'p', 'p_1', 'p_2', 'd_1', 'd_2', 'd_12'
    ];
    
    $updateData = [];
    foreach ($updatableFields as $field) {
        if ($request->has($field)) {
            $updateData[$field] = $request->input($field);
        }
    }
    
    if (!empty($updateData)) {
        $dogovor->update($updateData);
    }
    
    if ($request->has('outcomes') && is_array($request->input('outcomes'))) {
        foreach ($request->input('outcomes') as $outcomeData) {
            if (isset($outcomeData['id']) && $outcomeData['id']) {
                $outcome = Outcome::find($outcomeData['id']);
                if ($outcome) {
                    $outcomeDataToUpdate = [];
                    if (isset($outcomeData['name'])) {
                        $outcomeDataToUpdate['name'] = $outcomeData['name'];
                    }
                    if (isset($outcomeData['odds'])) {
                        $outcomeDataToUpdate['odds'] = $outcomeData['odds'];
                    }
                    if (!empty($outcomeDataToUpdate)) {
                        $outcome->update($outcomeDataToUpdate);
                    }
                }
            }
            elseif (isset($outcomeData['name']) && isset($outcomeData['odds'])) {
                Outcome::create([
                    'dogovor_id' => $dogovor->id,
                    'name' => $outcomeData['name'],
                    'odds' => $outcomeData['odds'],
                ]);
            }
        }
    }
    
    return redirect()->route('private.match.details', ['id' => $id])
        ->with('message', 'Матч обновлен успешно');
}

    public function deleteDogovorMatch($id)
    {
        try {
            $match = Dogovor::findOrFail($id);

            $match->delete();

            return response()->json(['status' => 'success', 'message' => 'Матч успешно удален.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Ошибка при удалении матча.']);
        }
    }

    public function privateverify(Request $request)
    {
        $verifies = VerificationRequest::orderBy('created_at', 'desc')->get();

        $statusResp = [
            0 => 'Ожидание',
            1 => 'Верифицирован',
            2 => 'Отклонен',
        ];

        if ($verifies) {
            foreach ($verifies as $verify) {
                $verify->image_links = explode(',', $verify->image_links);

                $verify->status = $statusResp[$verify->is_verified];
            }
        }

        return view('private-verify', ['request' => $request, 'verifies' => $verifies]);
    }

    public function editprofile(Request $request)
    {
        if (!empty($request->password_old) && !empty($request->password_new) && !empty($request->password_new_rep)) {
            if (Hash::check($request->password_old, $request->user()->password) && $request->password_new == $request->password_new_rep) {
                User::where('id', auth()->user()->id)->update([
                    'password' => Hash::make($request->password_new)
                ]);
            } else {
                $request->session()->put('error', '1');
            }
        }

        if ($request->hasFile('avatar')) {
            $user = auth()->user();
            $avatar = $request->file('avatar');
            $avatarPath = 'users/';
            $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
            $destinationPath = 'img/users/';

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $avatar->move($destinationPath, $avatarName);
            $user->avatar = $avatarPath . $avatarName;
            $user->save();
        }

        $cur = 'KZT';
        if (isset($request->currency) && $request->currency == 'KZT') {
            $cur = 'KZT';
        }

        User::where('id', auth()->user()->id)->update([
            'name' => $request->name_edit,
            'email' => $request->email_edit,
            'phone' => $request->phone_edit,
            'cur' => $cur
        ]);

        if (!$request->session()->exists('error')) {
            $request->session()->put('suc', '1');
        }

        return redirect('/#ppUser');
    }


    public function adminuseredit(Request $request)
    {
        $user = User::find($request->user_id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        \Log::info('Request data: ', $request->all());

        if (!empty($request->password_1) && !empty($request->password_2)) {
            if ($request->password_1 == $request->password_2) {
                $user->update([
                    'password' => Hash::make($request->password_1)
                ]);
            } else {
                return 'erp';
            }
        }

        $id_role = Role::where('name', $request->role)->first();

        $originalMoney = $user->money;
        $originalBonus = $user->bonus;

        $user->update([
            'name' => $request->name,
            'login' => $request->login,
            'country' => $request->country,
            'email' => $request->email,
            'label_admin' => $request->adminlabel,
            'role_id' => $id_role->id,
            'socument_suc' => $request->docum,
            'ban' => $request->ban,
            'no_money' => $request->nomo,
            'no_vivod' => $request->vivod,
            'no_transfer' => $request->transfer,
            'cur' => $request->cur,
            'money' => $request->balance,
            'bonus' => $request->bonus,
        ]);

        $user->phone = $request->phone;
        $user->save();

        if ($originalMoney != $user->money) {
            $diff = $user->money - $originalMoney;
            if ($diff > 0) {
                $gateway = 'Admin Deposit';

                DepositHistory::create([
                    'user_id' => $user->id,
                    'sum' => abs($diff),
                    'payment_gateway' => $gateway,
                ]);
            }
        }

        if ($originalBonus != $user->bonus) {
            $diff = $user->bonus - $originalBonus;
            if ($diff > 0) {
                $gateway = 'Admin Bonus Addition';

                DepositHistory::create([
                    'user_id' => $user->id,
                    'sum' => abs($diff),
                    'payment_gateway' => $gateway,
                ]);
            }
        }

        return $request->user_id;
    }

    public function adminuserbalanceedit(Request $request)
    {
        $user = User::find($request->user_id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $originalMoney = $user->money;
        $originalBonus = $user->bonus;

        $newBalance = $request->balance;
        $newBonus = $request->bonus;

        $user->update([
            'money' => $newBalance,
            'bonus' => $newBonus,
        ]);

        if ($originalMoney != $user->money) {
            $diff = $user->money - $originalMoney;
            if ($diff > 0) {
                $gateway = 'Admin Deposit';

                DepositHistory::create([
                    'user_id' => $user->id,
                    'sum' => abs($diff),
                    'payment_gateway' => $gateway,
                ]);
            }
        }

        if ($originalBonus != $user->bonus) {
            $diff = $user->bonus - $originalBonus;
            if ($diff > 0) {
                $gateway = 'Admin Bonus Addition';

                DepositHistory::create([
                    'user_id' => $user->id,
                    'sum' => abs($diff),
                    'payment_gateway' => $gateway,
                ]);
            }
        }

        return $request->user_id;
    }


    public function adminuserdelete(Request $request)
    {
        try {

            $user = User::find($request->user_id);

            if (!$user) {
                return response()->json(['status' => 'error', 'message' => 'Пользователь не найден.'], 404);
            }

            $user->withdrawalRequests()->delete();

            $user->delete();

            return response()->json(['status' => 'success', 'message' => 'Пользователь успешно удален.'], 200);

        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Ошибка при удалении пользователя: ' . $e->getMessage()], 500);
        }
    }



    public function casinoGame(Request $request)
    {
        return view('casino-game', compact('request'));
    }

    public function privatewithdrawals(Request $request)
    {
        $query = WithdrawalRequest::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        if ($request->filled('user_account')) {
            $userId = str_replace('2240', '', $request->user_account);
            $query->where('user_id', $userId);
        }

        $withdrawalRequests = $query->orderBy('created_at', 'desc')->get();
        $reasons = RejectionReason::all();

        return view('private-withdrawal-requests', [
            'request' => $request,
            'withdrawalRequests' => $withdrawalRequests,
            'reasons' => $reasons,
        ]);
    }

    public function reject(Request $request, $id)
    {
        $withdrawal = WithdrawalRequest::find($id);

        if (!$withdrawal) {
            return response()->json(['error' => 'Withdrawal request not found'], 404);
        }

        $withdrawal->update([
            'status' => 'Отказ',
            'reason_for_rejection' => $request->reason,
        ]);

        return response()->json(['success' => true, 'message' => 'Withdrawal request rejected']);
    }

    public function pay(Request $request, $id)
    {
        $withdrawal = WithdrawalRequest::find($id);

        if (!$withdrawal) {
            return response()->json(['error' => 'Withdrawal request not found'], 404);
        }

        $withdrawal->update([
            'status' => 'Принято',
        ]);

        return response()->json(['success' => true, 'message' => 'Withdrawal request accepted']);
    }

    public function update(Request $request, $id)
    {
        $withdrawal = WithdrawalRequest::find($id);

        if (!$withdrawal) {
            return response()->json(['error' => 'Withdrawal request not found'], 404);
        }

        $payment_gateway = $request->payment_gateway ?? $withdrawal->payment_gateway;

        $withdrawal->update([
            'details' => $request->details,
            'sum' => $request->sum,
            'payment_gateway' => $payment_gateway,
        ]);

        return response()->json(['success' => true, 'message' => 'Withdrawal request updated']);
    }


    public function auth(Request $request)
    {

        $data = $request->all();

        $credentials = [
            'email' => $data['email_login'],
            'password' => $data['password_login'],
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->put('user_ip', $this->getRealIpAddress($request));

            return 1;
        } else {
            return 0;
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }

    public function license(Request $request)
    {
        return view('license', ['request' => $request]);
    }

    public function defreturn(Request $request)
    {
        return view('defreturn', ['request' => $request]);
    }

    public function rules(Request $request)
    {
        return view('rules', ['request' => $request]);
    }

    public function accountRestricted(Request $request)
    {
        return view('account-restricted', ['request' => $request]);
    }

    public function risk(Request $request)
    {
        return view('risk', ['request' => $request]);
    }
    private function getTours()
    {
        $data_leagues = League::all();

        $arr_new = [];
        $j = 1;
        foreach ($data_leagues as $i => $ar) {
            $arr_new[$i]['id_tourn'] = $ar->id;
            $arr_new[$i]['name'] = $ar->name;
            $arr_new[$i]['sport_id'] = $ar->sport_id;
            $arr_new[$i]['icon'] = $ar->image;
            if ($j == 9) {
                $j = 1;
            }
            $j++;
        }

        return $arr_new;
    }



    private function getGameId($idgame)
    {
        $game = Game::with('sport')->find($idgame);

        if (!$game) {
            abort(404, 'Game not found');
        }

        return (object)[
            'id' => $game->id,
            'game_id' => $game->id,
            'opp_1_name' => $game->team1,
            'opp_2_name' => $game->team2,
            'sport_id' => $game->sport_id,
            'sport_name' => $game->sport->title,
            'game_start' => strtotime($game->game_start),
            'game_oc_list' => [
                (object)[
                    'oc_group_name' => '1x2',
                    'oc_name' => 'Team 1',
                    'oc_rate' => $game->coefficient1
                ]
            ],
            'body' => 'Sample body content'
        ];
    }

    private function generateRandomGameStart($game)
    {
        $gameStart = Carbon::parse($game->game_start);
        $currentTime = Carbon::now();

        if ($gameStart->isPast()) {
            $gameStart = $currentTime->addDays(2);
            $game->game_start = $gameStart;
            $game->save();
        }

        return $gameStart->format('H:i d.m');
    }

    private function roundMinutesAndRandomizeHour($dateTime)
    {
        $minutes = (int) $dateTime->format('i');

        if ($minutes < 15) {
            $minutes = 0;
        } elseif ($minutes < 30) {
            $minutes = 15;
        } else {
            $minutes = 30;
        }

        $hours = rand(0, 23);

        $dateTime->setTime($hours, $minutes, 0);
        return $dateTime;
    }

    private function getEvents($idsport, $idtourn, $type)
    {
        $query = Game::query();

        if ($idsport) {
            $query->where('sport_id', $idsport);
        }

        if ($idtourn) {
            $query->where('league_id', $idtourn);
        }

        if ($type) {
            $query->where('type', $type);
        }

        $games = $query->get();
        $events = [];

        foreach ($games as $game) {
            $events[] = (object)[
                'events_list' => [
                    (object)[
                        'game_start' => $this->generateRandomGameStart($game),
                        'tournament_id' => $game->league_id,
                        'title' => $game->title,
                        'game_id' => $game->id,
                        'opp_1_name_ru' => $game->team1,
                        'opp_2_name_ru' => isset($game->team2) ? $game->team2 : "",
                        'sport_id' => $game->sport_id ? $game->sport_id : 1,
                        'sport_name' => $game->title ? $game->title : 'Sport',
                        'game_oc_list' => [
                            (object)[
                                'oc_group_name' => '1x2',
                                'oc_name' => $game->team1,
                                'oc_rate' => $this->formatCoefficient($game->coefficient1)
                            ],
                            (object)[
                                'oc_group_name' => '1x2',
                                'oc_name' => $game->team2,
                                'oc_rate' => $this->formatCoefficient($game->coefficient2)
                            ],
                            (object)[
                                'oc_group_name' => 'Двойной шанс',
                                'oc_name' => '1X',
                                'oc_rate' => $this->formatCoefficient($this->generateRandomCoefficient())
                            ],
                            (object)[
                                'oc_group_name' => 'Двойной шанс',
                                'oc_name' => 'X2',
                                'oc_rate' => $this->formatCoefficient($this->generateRandomCoefficient())
                            ],
                            (object)[
                                'oc_group_name' => 'Двойной шанс',
                                'oc_name' => '12',
                                'oc_rate' => $this->formatCoefficient($this->generateRandomCoefficient())
                            ],
                            (object)[
                                'oc_group_name' => 'Тотал',
                                'oc_name' => 'Больше 2.5',
                                'oc_rate' => $this->formatCoefficient($this->generateRandomCoefficient())
                            ],
                            (object)[
                                'oc_group_name' => 'Тотал',
                                'oc_name' => 'Меньше 2.5',
                                'oc_rate' => $this->formatCoefficient($this->generateRandomCoefficient())
                            ]
                        ]
                    ]
                ],
                'body' => 'Sample body content'
            ];
        }

        return $events;
    }

    private function generateRandomCoefficient()
    {
        return mt_rand(100, 300) / 100;
    }

    private function formatCoefficient($coefficient)
    {
        return number_format($coefficient, 2, '.', '');
    }



    private function getOneSport($idsport)
    {
        $sports = [
            (object)[
                'id' => 101,
                'name' => 'Sport 1'
            ],
            (object)[
                'id' => 102,
                'name' => 'Sport 2'
            ]
        ];

        $title = '';
        foreach ($sports as $sport) {
            if ($sport->id == $idsport) {
                $title = $sport->name;
            }
        }
        return $title;
    }

    private function getSports($type = null)
    {
        $sports = Sports::all();

        $ar_sport = [];
        $i = 0;

        foreach ($sports as $sport) {
            $query = Game::where('sport_id', $sport->id_api);

            if ($type !== null) {
                $query->where('type', $type);
            }

            $counter = $query->count();

            $ar_sport[$i]['id_sport'] = $sport->id_api;
            $ar_sport[$i]['counter'] = $counter;
            $ar_sport[$i]['name'] = $sport->title;
            $i++;
        }

        return $ar_sport;
    }


    public function bets($id, Request $request)
    {
        $category = $request->query('category', null);

        $type = null;
        if ($category === 'line') {
            $type = 'line';
        } elseif ($category === 'live') {
            $type = 'live';
        }

        $events = $this->getEvents($id, 0, $type);

        $events_list = [];
        $i = 0;

        if (empty($events)) {
            abort(404, 'No events found');
        }

        function getCachedMinutes($gameId)
        {
            $possibleMinutes = [0, 15, 30, 45, 50];

            $cacheKey = 'random_minute_' . $gameId . '_' . floor(time() / 600);

            return Cache::remember($cacheKey, 600, function () use ($possibleMinutes) {
                return $possibleMinutes[array_rand($possibleMinutes)];
            });
        }

        foreach ($events as $event_group) {
            foreach ($event_group->events_list as $event) {
                if ($type === 'live') {
                    $random_minutes = rand(10, 40);
                    $current_time = new \DateTime("now", new \DateTimeZone('Europe/Moscow'));
                    $current_time->modify('-1 hours');
                    $current_time->modify("-{$random_minutes} minutes");

                    $current_timestamp = $current_time->getTimestamp();
                    $rounded_timestamp = $current_timestamp - ($current_timestamp % 300);

                    $gameStart = (new \DateTime())->setTimestamp($rounded_timestamp);
                } else {
                    $gameStart = \DateTime::createFromFormat('H:i d.m', $event->game_start);

                    if (!$gameStart) {
                        $gameStart = new \DateTime();
                    }

                    $minutes = getCachedMinutes($event->game_id);
                    $gameStart->setTime($gameStart->format('H'), $minutes);
                }

                $events_list[$i]['game_start'] = $gameStart->format('H:i d.m');
                $events_list[$i]['tournament_id'] = $event->tournament_id;
                $events_list[$i]['title'] = $event->title;
                $events_list[$i]['game_id'] = $event->game_id;
                $events_list[$i]['opp_1_name_ru'] = $event->opp_1_name_ru;
                $events_list[$i]['opp_2_name_ru'] = isset($event->opp_2_name_ru) ? $event->opp_2_name_ru : "";
                $events_list[$i]['1x2'] = [];
                $events_list[$i]['two'] = [];
                $events_list[$i]['total'] = [];
                $events_list[$i]['b'] = [];
                $events_list[$i]['m'] = [];
                $events_list[$i]['sport_id'] = $id;
                $a1 = 0;
                $a2 = 0;
                $a3 = 0;
                $a4 = 0;
                $a5 = 0;

                foreach ($event->game_oc_list as $list) {
                    if ($list->oc_group_name == "1x2") {
                        $events_list[$i]['1x2'][$a1]['oc_rate'] = $list->oc_rate;
                        $events_list[$i]['1x2'][$a1]['oc_name'] = $list->oc_name;
                        $a1++;
                    }
                    if ($list->oc_group_name == "Двойной шанс") {
                        $events_list[$i]['two'][$a2]['oc_rate'] = $list->oc_rate;
                        $events_list[$i]['two'][$a2]['oc_name'] = $list->oc_name;
                        $a2++;
                    }
                    if ($list->oc_group_name == "Тотал") {
                        $events_list[$i]['total'][$a3]['oc_rate'] = $list->oc_rate;
                        $events_list[$i]['total'][$a3]['oc_name'] = $list->oc_name;
                        $a3++;
                    }
                    if (strpos($list->oc_name, "Больше") !== false) {
                        $events_list[$i]['b'][$a4]['oc_rate'] = $list->oc_rate;
                        $events_list[$i]['b'][$a4]['oc_name'] = $list->oc_name;
                        $a4++;
                    }
                    if (strpos($list->oc_name, "Меньше") !== false) {
                        $events_list[$i]['m'][$a5]['oc_rate'] = $list->oc_rate;
                        $events_list[$i]['m'][$a5]['oc_name'] = $list->oc_name;
                        $a5++;
                    }
                }
                $i++;
            }
        }

        $arr_res_sport = [];
        $sports = Sports::all();
        $sps = $this->getSports($category);
        $g = 0;

        foreach ($sports as $sport) {
            foreach ($sps as $sp) {
                if ($sp['id_sport'] == $sport->id_api) {
                    if ($sp['counter'] != 0) {
                        $arr_res_sport[$g]['counter'] = $sp['counter'];
                        $arr_res_sport[$g]['name'] = $sport->title;
                        $arr_res_sport[$g]['id_sport'] = $sport->id_api;
                        $arr_res_sport[$g]['img'] = $sport->img;
                    }
                }
            }
            $g++;
        }

        $title_name = $this->getOneSport($id);

        $banner = 'bn1.jpg';
        switch ($id) {
            case 1:
                $banner = 'bn1.jpg';
                break;
            case 2:
                $banner = 'bn3.png';
                break;
            case 4:
                $banner = 'bn4.png';
                break;
            case 6:
                $banner = 'bn2.png';
                break;
            case 3:
                $banner = 'bn5.png';
                break;
            default:
                $banner = 'bn1.jpg';
                break;
        }

        $data_leages = League::all();
        $sport = Sports::findOrFail($id);
        $title_sport = $sport->title;
        $image_sport = $sport->img;

        return view('bets', [
            'events_list' => $events_list,
            'arr_res_sport' => $arr_res_sport,
            'title' => $title_sport,
            'sport_img' => $image_sport,
            'request' => $request,
            'title_name' => $title_name,
            'banner' => $banner,
            'data_leages' => $data_leages
        ]);
    }

    public function betsid($idsport, $idtourn, Request $request)
    {
        $category = $request->query('category', null);

        $type = null;
        if ($category === 'line') {
            $type = 'line';
        } elseif ($category === 'live') {
            $type = 'live';
        }

        $limit = MatchLimit::where('name', 'top-liga')->first()->limit;

        $arr_res_sport = [];
        $sports = Sports::all();
        $sps = $this->getSports();
        $g = 0;

        foreach ($sports as $sport) {
            foreach ($sps as $sp) {
                if ($sp['id_sport'] == $sport->id_api) {
                    if ($sp['counter'] != 0) {
                        $arr_res_sport[$g]['counter'] = $sp['counter'];
                        $arr_res_sport[$g]['name'] = $sport->title;
                        $arr_res_sport[$g]['id_sport'] = $sport->id_api;
                        $arr_res_sport[$g]['img'] = $sport->img;
                    }
                }
            }
            $g++;
        }

        $title_name = $this->getOneSport($idsport);
        $arr_new = League::all();
        $events = $this->getEvents($idsport, $idtourn, null);

        if (empty($events)) {
            abort(404);
        }

        $events_list = [];
        $i = 0;

        function getCachedMinutes($gameId)
        {
            $possibleMinutes = [0, 15, 30, 45, 50];

            $cacheKey = 'random_minute_' . $gameId . '_' . floor(time() / 600);

            return Cache::remember($cacheKey, 600, function () use ($possibleMinutes) {
                return $possibleMinutes[array_rand($possibleMinutes)];
            });
        }

        foreach ($events as $event_group) {
            foreach ($event_group->events_list as $event) {
                $gameStart = \DateTime::createFromFormat('H:i d.m', $event->game_start);

                if (!$gameStart) {
                    $gameStart = new \DateTime();
                }

                $minutes = getCachedMinutes($event->game_id);
                $gameStart->setTime($gameStart->format('H'), $minutes);

                $event_data = [
                    'game_start' => $gameStart->format('H:i d.m'),
                    'tournament_id' => $event->tournament_id,
                    'title' => $event->title,
                    'game_id' => $event->game_id,
                    'opp_1_name_ru' => $event->opp_1_name_ru,
                    'opp_2_name_ru' => isset($event->opp_2_name_ru) ? $event->opp_2_name_ru : "",
                    '1x2' => [],
                    'two' => [],
                    'total' => [],
                    'b' => [],
                    'm' => [],
                    'sport_id' => $event->sport_id
                ];

                $a1 = 0;
                $a2 = 0;
                $a3 = 0;
                $a4 = 0;
                $a5 = 0;

                foreach ($event->game_oc_list as $list) {
                    if ($list->oc_group_name == "1x2") {
                        $event_data['1x2'][$a1]['oc_rate'] = $list->oc_rate;
                        $event_data['1x2'][$a1]['oc_name'] = $list->oc_name;
                        $a1++;
                    }
                    if ($list->oc_group_name == "Двойной шанс") {
                        $event_data['two'][$a2]['oc_rate'] = $list->oc_rate;
                        $event_data['two'][$a2]['oc_name'] = $list->oc_name;
                        $a2++;
                    }
                    if ($list->oc_group_name == "Тотал") {
                        $event_data['total'][$a3]['oc_rate'] = $list->oc_rate;
                        $event_data['total'][$a3]['oc_name'] = $list->oc_name;
                        $a3++;
                    }
                    if (strpos($list->oc_name, "Больше") !== false) {
                        $event_data['b'][$a4]['oc_rate'] = $list->oc_rate;
                        $event_data['b'][$a4]['oc_name'] = $list->oc_name;
                        $a4++;
                    }
                    if (strpos($list->oc_name, "Меньше") !== false) {
                        $event_data['m'][$a5]['oc_rate'] = $list->oc_rate;
                        $event_data['m'][$a5]['oc_name'] = $list->oc_name;
                        $a5++;
                    }
                }

                if (empty($event_data['two'])) {
                    $event_data['two'][] = [
                        'oc_rate' => rand(1, 5),
                        'oc_name' => 'Двойной шанс'
                    ];
                }
                if (empty($event_data['total'])) {
                    $event_data['total'][] = [
                        'oc_rate' => rand(1, 5),
                        'oc_name' => 'Тотал'
                    ];
                }
                if (empty($event_data['b'])) {
                    $event_data['b'][] = [
                        'oc_rate' => rand(1, 5),
                        'oc_name' => 'Больше'
                    ];
                }
                if (empty($event_data['m'])) {
                    $event_data['m'][] = [
                        'oc_rate' => rand(1, 5),
                        'oc_name' => 'Меньше'
                    ];
                }

                $events_list[] = $event_data;
            }
        }

        shuffle($events_list);
        $events_list = array_slice($events_list, 0, $limit);

        $banner = 'bn1.jpg';
        switch ($idsport) {
            case 1:
                $banner = 'bn1.jpg';
                break;
            case 2:
                $banner = 'bn3.png';
                break;
            case 4:
                $banner = 'bn4.png';
                break;
            case 6:
                $banner = 'bn6.png';
                break;
            case 3:
                $banner = 'bn5.png';
                break;
            default:
                $banner = 'bn1.jpg';
                break;
        }

        $league_params = League::findOrFail($idtourn);
        $title_league = $league_params->name;
        $image_league = $league_params->image;

        return view('bets', [
            'arr_res_sport' => $arr_res_sport,
            'request' => $request,
            'data_leages' => $arr_new,
            'title' => $title_league,
            'sport_img' => $image_league,
            'events_list' => $events_list,
            'title_name' => $title_name,
            'banner' => $banner
        ]);
    }
    public function betsgameid($idsport, $idtourn, $idgame, Request $request)
    {
        $gameone = Game::with(['league', 'sport'])->findOrFail($idgame);

        if (!is_numeric($gameone->game_start)) {
            $gameone->game_start = strtotime($gameone->game_start);
        }

        if ($gameone->type == 'live') {
            $gameone->game_start = time();
        }

        $arr_res_sport = [];
        $sports = Sports::all();
        $sps = $this->getSports();
        $g = 0;

        foreach ($sports as $sport) {
            foreach ($sps as $sp) {
                if ($sp['id_sport'] == $sport->id_api) {
                    if ($sp['counter'] != 0) {
                        $arr_res_sport[$g]['counter'] = $sp['counter'];
                        $arr_res_sport[$g]['sport_name'] = $sport->title;
                        $arr_res_sport[$g]['name'] = $sport->title;
                        $arr_res_sport[$g]['id_sport'] = $sport->id_api;
                        $arr_res_sport[$g]['img'] = $sport->img;
                    }
                }
            }
            $g++;
        }

        $title_name = Sports::where('id_api', $idsport)->first()->title ?? 'Матч';

        $arr_new = $this->getTours($idsport);
        $events = $this->getEvents($idsport, $idtourn, null);

        if (empty($events)) {
            abort(404);
        }

        $events_list = [];
        $i = 0;

        foreach ($events as $event_group) {
            foreach ($event_group->events_list as $event) {
                $events_list[$i]['game_start'] = $event->game_start;
                $events_list[$i]['game_id'] = $event->game_id;
                $events_list[$i]['opp_1_name_ru'] = $event->opp_1_name_ru;
                $events_list[$i]['opp_2_name_ru'] = isset($event->opp_2_name_ru) ? $event->opp_2_name_ru : "";
                $events_list[$i]['1x2'] = [];
                $events_list[$i]['two'] = [];
                $events_list[$i]['total'] = [];
                $events_list[$i]['b'] = [];
                $events_list[$i]['m'] = [];
                $events_list[$i]['sport_id'] = $event->sport_id;

                $a1 = 0;
                $a2 = 0;
                $a3 = 0;
                $a4 = 0;
                $a5 = 0;

                foreach ($event->game_oc_list as $list) {
                    if ($list->oc_group_name == "1x2") {
                        $events_list[$i]['1x2'][$a1]['oc_rate'] = $list->oc_rate;
                        $events_list[$i]['1x2'][$a1]['oc_name'] = $list->oc_name;
                        $a1++;
                    }
                    if ($list->oc_group_name == "Двойной шанс") {
                        $events_list[$i]['two'][$a2]['oc_rate'] = $list->oc_rate;
                        $events_list[$i]['two'][$a2]['oc_name'] = $list->oc_name;
                        $a2++;
                    }
                    if ($list->oc_group_name == "Тотал") {
                        $events_list[$i]['total'][$a3]['oc_rate'] = $list->oc_rate;
                        $events_list[$i]['total'][$a3]['oc_name'] = $list->oc_name;
                        $a3++;
                    }
                    if (strpos($list->oc_name, "Больше") !== false) {
                        $events_list[$i]['b'][$a4]['oc_rate'] = $list->oc_rate;
                        $events_list[$i]['b'][$a4]['oc_name'] = $list->oc_name;
                        $a4++;
                    }
                    if (strpos($list->oc_name, "Меньше") !== false) {
                        $events_list[$i]['m'][$a5]['oc_rate'] = $list->oc_rate;
                        $events_list[$i]['m'][$a5]['oc_name'] = $list->oc_name;
                        $a5++;
                    }
                }

                if (empty($events_list[$i]['two'])) {
                    $events_list[$i]['two'][] = [
                        'oc_rate' => rand(1, 5),
                        'oc_name' => 'Двойной шанс'
                    ];
                }
                if (empty($events_list[$i]['total'])) {
                    $events_list[$i]['total'][] = [
                        'oc_rate' => rand(1, 5),
                        'oc_name' => 'Тотал'
                    ];
                }
                if (empty($events_list[$i]['b'])) {
                    $events_list[$i]['b'][] = [
                        'oc_rate' => rand(1, 5),
                        'oc_name' => 'Больше'
                    ];
                }
                if (empty($events_list[$i]['m'])) {
                    $events_list[$i]['m'][] = [
                        'oc_rate' => rand(1, 5),
                        'oc_name' => 'Меньше'
                    ];
                }

                $i++;
            }
        }

        $banner = 'bn1.jpg';
        switch ($idsport) {
            case 1:
                $banner = 'bn1.jpg';
                break;
            case 2:
                $banner = 'bn3.png';
                break;
            case 4:
                $banner = 'bn4.png';
                break;
            case 6:
                $banner = 'bn6.png';
                break;
            case 3:
                $banner = 'bn5.png';
                break;
            default:
                $banner = 'bn1.jpg';
                break;
        }

        return view('game', [
            'gameone' => $gameone,
            'arr_res_sport' => $arr_res_sport,
            'request' => $request,
            'data_leages' => $arr_new,
            'title' => $title_name,
            'events_list' => $events_list,
            'title_name' => $title_name,
            'banner' => $banner
        ]);
    }


    public function dogmatchgame(string $id, Request $request)
    {
        $dogmatch = Dogovor::find($id);

        $title = $dogmatch->name;
        $sport = Sports::find($dogmatch->tour_sport);
        $title_name = $sport->title;
        $idsport = $sport->id;
        $events_list = [];

        $leagues = League::all();

        $sports = Sports::all();

        $additional_outcomes = Outcome::where('dogovor_id', $dogmatch->id)->get();

        $game_oc_list = [
            [
                "oc_group_name" => "1x2",
                "oc_name" => $dogmatch->name_1,
                "oc_rate" => $dogmatch->p,
            ],
            [
                "oc_group_name" => "1x2",
                "oc_name" => "Ничья",
                "oc_rate" => $dogmatch->p_1,
            ],
            [
                "oc_group_name" => "1x2",
                "oc_name" => $dogmatch->name_2,
                "oc_rate" => $dogmatch->p_2,
            ],
            [
                "oc_group_name" => "Двойной шанс",
                "oc_name" => $dogmatch->name_1,
                "oc_rate" => $dogmatch->d_1,
            ],
            [
                "oc_group_name" => "Двойной шанс",
                "oc_name" => "Ничья",
                "oc_rate" => $dogmatch->d_12,
            ],
            [
                "oc_group_name" => "Двойной шанс",
                "oc_name" => $dogmatch->name_2,
                "oc_rate" => $dogmatch->d_2,
            ],
        ];

        $new_game_oc_list = [];

        foreach ($game_oc_list as $game) {
            $new_game_oc_list[] = (object)$game;
        }

        $gameone = [
            'game_id' => $dogmatch->id,
            'tournament_name' => $dogmatch->name,
            'tournament_name_ru' => $dogmatch->name,
            'opp_1_name' => $dogmatch->name_1,
            'opp_2_name' => $dogmatch->name_2,
            'opp_1_name_ru' => $dogmatch->name_1,
            'opp_2_name_ru' => $dogmatch->name_2,
            'sport_name' => $title_name,
            'sport_name_ru' => $title_name,
            'game_start' => strtotime($dogmatch->game_start),
            'game_end' => strtotime($dogmatch->game_end),
            'stat_list' => [],
            'sub_games' => [],
            'game_oc_list' => $new_game_oc_list,
            'game_desk' => 'Игра завершена'
        ];

        $gameone = (object)$gameone;

        $banner = 'bn1.jpg';
        switch ($idsport) {
            case 1:
                $banner = 'bn1.jpg';
                break;
            case 2:
                $banner = 'bn3.png';
                break;
            case 4:
                $banner = 'bn4.png';
                break;
            case 6:
                $banner = 'bn6.png';
                break;
            case 3:
                $banner = 'bn5.png';
                break;
            default:
                $banner = 'bn1.jpg';
                break;
        }

        return view('dogmatchgame', [
            'request' => $request,
            'title' => $title,
            'arr_res_sport' => $sports,
            'data_leages' => $leagues,
            'banner' => $banner,
            'title_name' => $title_name,
            'events_list' => $events_list,
            'gameone' => $gameone,
            'additional_outcomes' => $additional_outcomes,
        ]);
    }


    public function ajaxstavka(Request $request)
    {
        $leng = count($request->arr_res_k);
        $price_total = $leng * $request->price;

        if (!Auth::check()) {
            return response()->json(['status' => 0]);
        }

        if ($price_total > auth()->user()->money) {
            return response()->json(['status' => 1]);
        }

        $dogovorStavka = Stavka::where('user', auth()->user()->id)
            ->whereIn('game_id', function($query) {
                $query->select('game_id')->from('dogovor');
            })
            ->exists();

        if ($dogovorStavka) {
            return response()->json(['status' => 'dogovor']);
        }

        $i = 0;
        while ($i < count($request->arr_res_k)) {
            Stavka::create([
                'v' => $request->arr_team[$i],
                'k' => $request->arr_res_k[$i],
                'user' => auth()->user()->id,
                'game_id' => $request->arr_res_game_id[$i],
                'summa' => $request->price,
                'dummy_id' => rand(10000000, 99999999),
            ]);
            $i++;
        }

        User::where('id', auth()->user()->id)->update([
            'money' => (auth()->user()->money - $price_total)
        ]);

        return response()->json(['status' => 2]);
    }

    public function casino(Request $request)
    {
        return view('casino', ['request' => $request]);
    }

    private function getRealIpAddress(Request $request): string
    {
        $ip = $request->ip();
        
        if ($ip === '127.0.0.1' || $ip === '::1' || empty($ip)) {
            if ($request->header('X-Real-IP')) {
                $ip = $request->header('X-Real-IP');
            }
            elseif ($request->header('X-Forwarded-For')) {
                $forwardedFor = $request->header('X-Forwarded-For');
                $ips = explode(',', $forwardedFor);
                $ip = trim($ips[0]);
            }
            elseif (isset($_SERVER['REMOTE_ADDR'])) {
                $ip = $_SERVER['REMOTE_ADDR'];
            }
        }
        
        return $ip ?: 'Неизвестен';
    }
}


