<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Golf extends Model
{
	public function getPlayers($is_active)
	{
		$query = "SELECT * FROM players WHERE is_active = ?;";
                
        return DB::select($query, array($is_active));
	}
	
	public function getAllPlayers()
	{
		$query = "SELECT * FROM players;";
                
        return DB::select($query);
	}
	
	public function getPlayer($id_players)
	{
		$query = "SELECT * FROM players WHERE id_players = ?;";
                
        return DB::select($query, array($id_players));
	}
	
	public function getPlayerByEmail($email)
	{
		$query = "SELECT * FROM players WHERE LOWER(email) = LOWER(?);";
                
        return DB::select($query, array($email));
	}
	
	public function createPlayer($email, $name, $is_active)
	{
		$query = "INSERT INTO players VALUES (NULL, ?, ?, ?, ?, ?);";
		
		return DB::connection()->insert( $query, array( $email, $name, strtotime('now'), strtotime('now'), $is_active ) );
	}
	
	public function getFullRanking($year, $month)
	{
		$query = "SELECT a.id_players, d.name, SUM(a.shots) AS shots, COUNT(*) AS played, e.points, 
				SUM(a.single_point) AS single, SUM(a.two_point) AS two, SUM(a.three_point) AS three, 
				(SUM(a.single_point) + SUM(a.two_point) + SUM(a.three_point) ) AS successful, 
				f.lost, f.tie, f.won
				FROM games a  
				LEFT JOIN rounds b ON (b.id_rounds=a.id_rounds)
				LEFT JOIN tournaments c ON (c.id_tournaments=b.id_tournaments)
				LEFT JOIN players d ON (d.id_players=a.id_players) 
				LEFT JOIN (
					SELECT a.id_players, SUM(a.points) AS points
					FROM ranking a
					LEFT JOIN tournaments b ON (b.id_tournaments=a.id_tournaments)
					WHERE strftime('%Y', b.date, 'unixepoch') = ? AND strftime('%m', b.date, 'unixepoch') = ? 
					GROUP BY a.id_players
				) e ON (e.id_players=a.id_players) 
				LEFT JOIN (
					SELECT t.id_players,  
						SUM( CASE WHEN t.points = 0 THEN t.q ELSE 0 END ) AS 'lost', 
						SUM( CASE WHEN t.points = 1 THEN t.q ELSE 0 END ) AS 'tie', 
						SUM( CASE WHEN t.points = 2 THEN t.q ELSE 0 END ) AS 'won' 
					FROM (
						SELECT a.id_players, a.points, COUNT(*) AS q 
						FROM ranking a 
						LEFT JOIN tournaments b ON (b.id_tournaments=a.id_tournaments)
						WHERE strftime('%Y', b.date, 'unixepoch') = ? AND strftime('%m', b.date, 'unixepoch') = ?
						GROUP BY a.id_players, a.points
					) t
					GROUP BY t.id_players
				) f ON (f.id_players=a.id_players) 
				WHERE strftime('%Y', c.date, 'unixepoch') = ? AND strftime('%m', c.date, 'unixepoch') = ?
				GROUP BY a.id_players
				ORDER BY e.points DESC, won DESC, shots ASC;";
                
        return DB::select($query, array($year, $month, $year, $month, $year, $month) );
	}
	
	public function getFullRankingByTournament($id_tournaments)
	{
		$query = "SELECT a.id_players, d.name, SUM(a.shots) AS shots, COUNT(*) AS played, e.points, 
				SUM(a.single_point) AS single, SUM(a.two_point) AS two, SUM(a.three_point) AS three, 
				(SUM(a.single_point) + SUM(a.two_point) + SUM(a.three_point) ) AS successful, 
				f.lost, f.tie, f.won
				FROM games a  
				LEFT JOIN rounds b ON (b.id_rounds=a.id_rounds)
				LEFT JOIN tournaments c ON (c.id_tournaments=b.id_tournaments)
				LEFT JOIN players d ON (d.id_players=a.id_players) 
				LEFT JOIN (
					SELECT a.id_players, SUM(a.points) AS points
					FROM ranking a
					LEFT JOIN tournaments b ON (b.id_tournaments=a.id_tournaments)
					WHERE b.id_tournaments = ? 
					GROUP BY a.id_players
				) e ON (e.id_players=a.id_players) 
				LEFT JOIN (
					SELECT t.id_players,  
						SUM( CASE WHEN t.points = 0 THEN t.q ELSE 0 END ) AS 'lost', 
						SUM( CASE WHEN t.points = 1 THEN t.q ELSE 0 END ) AS 'tie', 
						SUM( CASE WHEN t.points = 2 THEN t.q ELSE 0 END ) AS 'won' 
					FROM (
						SELECT a.id_players, a.points, COUNT(*) AS q 
						FROM ranking a 
						LEFT JOIN tournaments b ON (b.id_tournaments=a.id_tournaments)
						WHERE b.id_tournaments = ?
						GROUP BY a.id_players, a.points
					) t
					GROUP BY t.id_players
				) f ON (f.id_players=a.id_players) 
				WHERE c.id_tournaments = ?
				GROUP BY a.id_players
				ORDER BY e.points DESC, won DESC, shots ASC;";
                
        return DB::select($query, array($id_tournaments, $id_tournaments, $id_tournaments) );
	}
	
	public function getRankingByTournament($id_tournaments)
	{
		$query = "SELECT b.name, a.* 
			FROM ranking a 
			LEFT JOIN players b ON (b.id_players=a.id_players) 
			WHERE id_tournaments = ? 
			ORDER BY a.points DESC;";
		
        return DB::select($query, array($id_tournaments) );
	}
	
	public function getLastTournamentByDateType($year, $month, $type)
	{
		$query = "SELECT * 
				FROM tournaments a 
				WHERE strftime('%Y', a.date, 'unixepoch') = ? AND 
				strftime('%m', a.date, 'unixepoch') = ? AND 
				a.type = ? 
				ORDER BY a.id_tournaments DESC
				LIMIT 1;";
		
        return DB::select($query, array($year, $month, $type) );
	}
	
	public function countPlayerWithMaxPoints($id_tournaments)
	{
		$query = "SELECT COUNT(*) AS q FROM ranking WHERE id_tournaments = ? AND points = (SELECT MAX(points) AS max_points FROM ranking WHERE id_tournaments = ?);";
		
        return DB::select($query, array($id_tournaments, $id_tournaments) );
	}
	
	public function getTournamentByTypeAndStatus($type, $is_open)
	{
		$query = "SELECT * FROM tournaments WHERE type = ? AND is_open = ?;";
		
        return DB::select($query, array($type, $is_open) );
	}
	
	public function createTournament($type, $date, $is_open)
	{
		$query = "INSERT INTO tournaments VALUES (NULL, ?, ?, ?, ?, ? );";
		
		DB::connection()->insert( $query, array( $type, $date, strtotime('now'), strtotime('now'), $is_open ) );
		
		return DB::getPdo()->lastInsertId();
	}
	
	public function getLastRound($id_tournaments)
	{
		$query = "SELECT * FROM rounds WHERE id_tournaments = ? ORDER BY id_rounds DESC LIMIT 1;";
		
		return DB::select($query, array($id_tournaments) );
	}
	
	public function createRound($id_tournaments, $round)
	{
		$query = "INSERT INTO rounds VALUES (NULL, ?, ?);";
		
		DB::connection()->insert( $query, array( $id_tournaments, $round ) );
		
		return DB::getPdo()->lastInsertId();
	}
	
	public function createGame($id_rounds, $id_players, $shots, $single_point, $two_point, $three_point)
	{
		$query = "INSERT INTO games VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ? );";
		
		return DB::connection()->insert( $query, array( $id_rounds, $id_players, $shots, $single_point, $two_point, $three_point, strtotime('now'), strtotime('now') ) );
	}
	
	public function createRanking($id_tournaments, $id_players, $points)
	{
		$query = "INSERT OR IGNORE INTO ranking VALUES (?, ?, ?, ?, ?);";
		
		return DB::connection()->insert( $query, array( $id_tournaments, $id_players, $points, strtotime('now'), strtotime('now') ) );
	}
	
	public function closeTournament($id_tournaments)
	{
		$query = "UPDATE tournaments SET is_open = 0, updated_at = ? WHERE id_tournaments = ?;";
		
		return DB::connection()->insert( $query, array( strtotime('now'), $id_tournaments) );
	}
	
	public function updateRanking($id_tournaments, $id_players, $points)
	{
		$query = "UPDATE ranking SET points = points + ?, updated_at = ? WHERE id_tournaments = ? AND id_players = ?;";
		
		return DB::connection()->insert( $query, array( $points, strtotime('now'), $id_tournaments, $id_players ) );
	}
	
	public function getPlayerComparison($players)
	{
		$q = count($players);
		$players = implode(",", $players);
		
		$query = "SELECT b.name, a.id_players, SUM(a.shots) AS shots, SUM(a.single_point) AS single, SUM(a.two_point) AS two, SUM(a.three_point) AS three 
				FROM games a 
				LEFT JOIN players b ON (b.id_players=a.id_players) 
				WHERE a.id_rounds IN (
				  SELECT id_rounds
				  FROM games
				  WHERE  
				  id_players IN ($players)
				  GROUP BY id_rounds
				  HAVING COUNT(*) = $q) AND 
				a.id_players IN ($players) 
				GROUP BY a.id_players;";
			
        return DB::select( DB::raw($query) );
        
	}

}
