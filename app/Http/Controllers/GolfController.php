<?php

namespace App\Http\Controllers;
use \Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Golf as Golf;

class GolfController extends Controller
{
    public function authenticate(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        
        if (Auth::attempt(['email' => $email, 'password' => $password]))
        {
            return redirect()->intended('dashboard');
        }
        
        return redirect()->back()->withInput()->with('message', 'Login Failed');
    }

    public function showLogin() 
    {
        if (Auth::check()) {
            return redirect()->intended('dashboard');
        }
        
        $year = strval(date("Y"));
        $month = date("m");
        $db = new Golf;
        $ranking = $db->getFullRanking($year, $month);
        
        $data = [
            'header' => null, 
            'container' => 'login',
            'ranking' => $ranking,
            'rank' => 0,
            'i' => 0,
            'last_score' => false
        ];
        return view('admin',  $data);
    }
    
     public function dashboard(Request $request) {
         
        $dates[] = [
            'year' => date('Y'),
            'month' => date('m')
            ];
        $dt1 = date('Y-m-d');
        $i = 4;
        while( $i > 0 ) {
            $datestring = $dt1.' first day of last month';
            $dt2 = date_create($datestring);
            $dt1 = $dt2->format('Y-m-d');
            if ( $dt1 == '2017-07-01' ) {
                break;
            }
            $dates[] = [
                'year' => date('Y', strtotime($dt1)),
                'month' => date('m', strtotime($dt1))
                ];
            $i--;
        }
        
        if ( ! $request->input('year') ) {
            $year = strval(date("Y"));
        } else {
            $year = $request->input('year');
        }
        
        if ( ! $request->input('month') ) {
            $month = date("m");
        } else {
            $month = $request->input('month');
        }
        
        $db = new Golf;
        $ranking = $db->getFullRanking($year, $month);
        $last_tournament = $db->getLastTournamentByDateType($year, $month, 1);
        $ranking_cup = array();
        if ( $last_tournament ) {
            $ranking_cup = $db->getFullRankingByTournament($last_tournament[0]->id_tournaments);
        }
        
        $data = [
            'header' => 'dashboard', 
            'container' => 'dashboard',
            'ranking' => $ranking,
            'ranking_cup' => $ranking_cup,
            'rank' => 0,
            'i' => 0,
            'a' => 0,
            'last_score' => false,
            'year' => $year, 
            'month' => $month, 
            'dates' => $dates
        ];
        
        return view('admin', $data );
    }
    
     public function createStep1(Request $request) {
        $db = new Golf;
        $players = $db->getPlayers(1);
        session(['players' => $players]);
        return view('includes.create-step1', array('players'=>$players) );
    }
    
     public function saveStep1(Request $request) {
        $validator = Validator::make($request->all(), [
            'type' => 'required|integer',
            'shots' => 'required|integer',
            'participants' => 'required|array|min:2'
        ]);
        
        if ($validator->fails()) {
            return redirect()->to('create-step1')->withInput()->withErrors($validator->errors());
        } else {
            session([
                'type' => $request->input('type'),
                'shots' => $request->input('shots'),
                'participants' => $request->input('participants')
            ]);
        }
        
        return redirect()->to('create-step2');
    }
    
    public function createStep2(Request $request) {
        $tournamets = [1=>'Master', 2=>'Relampago'];
        $tournamet = $tournamets[$request->session()->get('type')];
        $data = [
            'players' => $request->session()->get('players'),
            'tournamet' => $tournamet,
            'type' => $request->session()->get('type'),
            'shots' => $request->session()->get('shots'),
            'participants' => $request->session()->get('participants')
        ];
        return view('includes.create-step2', $data );
    }
    
     public function saveStep2(Request $request) {
        $players = $request->session()->get('players');
        $participants = $request->session()->get('participants');
        
        foreach ($players as $player) {
            if ( in_array($player->id_players, $participants) ) {
                $rules['player_'.$player->id_players] = 'required|integer';
                $rules['single_'.$player->id_players] = 'required|integer';
                $rules['two_'.$player->id_players] = 'required|integer';
                //$rules['three_'.$player->id_players] = 'required|integer';
            }
        }
        
        $rules['type'] = 'required|integer';
        $rules['shots'] = 'required|integer';
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->to('create-step2')->withErrors($validator->errors());
        } else {
            $type = $request->input('type');
            $shots = $request->input('shots');
            
            $db = new Golf;
            
            if ( $type == 1 ) {
                $tournament = $db->getTournamentByTypeAndStatus($type, 1);
                if ( $tournament ) {
                    $id_tournaments = $tournament[0]->id_tournaments;
                    $last_round = $db->getLastRound($id_tournaments);
                    if ( $last_round ) {
                        $round = $last_round[0]->round + 1;
                    } else {
                        $round = 1;
                    }
                } else {
                    $id_tournaments = $db->createTournament($type, strtotime( date('Y-m-d') ), 1 );
                    $round = 1;
                }
            } else {
                $id_tournaments = $db->createTournament($type, strtotime( date('Y-m-d') ), 0 );
                $round = 1;
            }
            
            $id_rounds = $db->createRound($id_tournaments, $round);
            
            $ranking = array();
            
            foreach ($players as $player) {
                if ( in_array($player->id_players, $participants) ) {
                    $id_players = $request->input('player_'.$player->id_players);
                    $single = $request->input('single_'.$player->id_players);
                    $two = $request->input('two_'.$player->id_players);
                    $three = 0; //$request->input('three_'.$player->id_players);
                    $db->createGame($id_rounds, $id_players, $shots, $single, $two, $three);
                    $db->createRanking($id_tournaments, $id_players, 0);
                    $ranking[$id_players] = [
                        'points' => ( $single + ($two*2) + ($three*3) )
                    ];
                }
            }
            
            arsort($ranking);
            $rank = 0;
            $i = 0;
            $last_score = false;
            
            foreach ($ranking as $id_players => $v) {
                $i++;
                if( $last_score != $v['points'] ){
                    $last_score = $v['points'];
                    $rank = $i;
                }
                $ranking[$id_players]['rank'] = $rank;
            }
            
            $aux1 = count($ranking);
            foreach ($ranking as $id_players => $v) {
                if ( $v['rank'] != 1) {
                    unset($ranking[$id_players]);
                }
            }
            
            if ( count($ranking) > 1 ) {
                $points = 1;
            } else {
                $points = 2;
            }
            
            foreach ($ranking as $id_players => $v) {
                $db->updateRanking($id_tournaments, $id_players, $points);
            }
            
            if ( $aux1 == 2 ) {
                $aux2 = $db->countPlayerWithMaxPoints($id_tournaments);
                if ( $aux2 ) {
                    if ( intval($aux2[0]->q) == 1) {
                        $db->closeTournament($id_tournaments);
                    }
                }
            }
        }
        
        return redirect()->to('success/'.$id_tournaments);
    }
    
     public function success($id_tournaments) {
        $db = new Golf;
        $ranking = $db->getRankingByTournament($id_tournaments);
        $data = [
            'ranking' => $ranking,
            'rank' => 0,
            'i' => 0,
            'last_score' => false
        ];
        return view('includes.success', $data );
    }
    
     public function h2hStep1() {
        $db = new Golf;
        $players = $db->getPlayers(1);
        session(['players' => $players]);
        return view('includes.h2h-step1', array('players'=>$players) );
    }

     public function h2hStep2(Request $request) {
        $validator = Validator::make($request->all(), [
            'participants' => 'required|array|min:2'
        ]);
        
        if ($validator->fails()) {
            return redirect()->to('h2h-step1')->withErrors($validator->errors());
        } 
        
        $participants = $request->input('participants');
        
        $db = new Golf;
        $comparison = $db->getPlayerComparison($participants);
        
        return view('includes.h2h-step2', array('comparison'=>$comparison) );
    }

    public function players() {
        $db = new Golf;
        $players = $db->getAllPlayers();
        session(['players' => $players]);
        return view('includes.players', array('players'=>$players) );
    }
    
     public function newPlayer() {
        return view('includes.player-new');
    }
    
    public function createPlayer(Request $request) {
        
        $messages = [
            'email_player_available' => 'Email address is already taken.',
        ];
        $rules['email'] = 'required|email|max:255|email_player_available';
        $rules['name'] = 'required|string|max:255';
        $rules['is_active'] = 'required|boolean';
        
        $validator = Validator::make($request->all(), $rules, $messages);
        
        if ($validator->fails()) {
            return redirect()->to('new-player')->withInput()->withErrors($validator->errors());
        } else {
            $db = new Golf;
            $db->createPlayer(
                strtolower($request->input('email')),
                $request->input('name'),
                $request->input('is_active')
            );
        }
        
        return redirect()->to('players');
    }
    
    public function getlogout()
    {
        Auth::logout();
        return redirect()->route('show-login');
    }
    
    public function test()
    {
        if(DB::connection()->getDatabaseName())
        {
            echo "connected successfully to database ".DB::connection()->getDatabaseName();
        }
    }
}