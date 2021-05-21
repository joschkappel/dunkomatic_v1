<?php 
include_once ($APLICATION_ROOT.'db_objects/db_object.class.php');
include_once ($APLICATION_ROOT.'objects/db_object_handler.class.php');

/**
* season_handler class 
* this class supports operations on all games of a season
* such as: generate all games, delete all games, drop teams, replace teams....
*/
class season_handler extends db_object_handler {

	/**
	* Constructor for season_handler
	* @param $conn adodb connection
	*/
	function __construct($conn) {
		parent::__construct($conn);
	}

	/**
	 * generate all games of a league
	 * @param league_id integer
	 */
	function generate_league_games() {
		// check whether this league is already generated
		// if so, exit

		$league_id = $_REQUEST['league_id_selected'];

		$sql = "SELECT * FROM game WHERE league_id=".$league_id;
		$rs = $this->conn->Execute($sql);
		if (!$rs->EOF) {
			print ("this league is already generated");
			return;
		}

		// get some additional data from LEAGUE
		$sql = "SELECT group_id, league_teams , shortname, above_region, region FROM league WHERE league_id=".$league_id;
		$rs = $this->conn->Execute($sql);

		if ($rs->EOF) {
			print ("this league does not exist");
			return;
		}
		$group_id = $rs->fields['group_id'];
		$above_region = $rs->fields['above_region'];
		$league_teams = $rs->fields['league_teams'];
		$league_name = $rs->fields['shortname'];
		$region = $rs->fields['region'];


		//		print_r($group_id);			 	
		//		print_r($league_teams);			 	

		// get teams from TEAM and CLUB
		$sql = "SELECT t.club_id, c.shortname, t.team_no, t.league_char, t.team_id, t.pref_game_day, t.pref_game_time FROM team t, club c WHERE t.league_id=".$league_id." AND t.club_id=c.club_id ";
		$rs = $this->conn->Execute($sql);

		if ($rs->EOF) {
			print ("no teams for this league");
			exit;
		}

		while (!$rs->EOF) {
			$team_name[$rs->fields['league_char']] = $rs->fields['shortname'].$rs->fields['team_no'];
			$team_club[$rs->fields['league_char']] = $rs->fields['club_id'];
			$team_id[$rs->fields['league_char']] = $rs->fields['team_id'];
			$team_pref_game_day[$rs->fields['league_char']] = $rs->fields['pref_game_day'];
			$team_pref_game_time[$rs->fields['league_char']] = $rs->fields['pref_game_time'];

			$rs->MoveNext();
		}

		// get the SCHEDULE
		$sql = "SELECT game_day, game_date FROM schedule WHERE GROUP_ID=".$group_id;
		$rs = $this->conn->Execute($sql);

		if ($rs->EOF) {
			print ("no schedule for this league");
			exit;
		}

		while (!$rs->EOF) {
			$schedule[$rs->fields['game_day']] = $rs->fields['game_date'];
			$rs->MoveNext();
		}

		// get the SEASON _SCHEME
		if ($league_teams < 10) {
			$league_teams = '0'.$league_teams;
		}
		$sql = "SELECT game_day, game_no, team_home, team_guest FROM team_".$league_teams."_scheme";
		$rs = $this->conn->Execute($sql);

		if ($rs->EOF) {
			print ("no scheme for this league");
			exit;
		}

		// generate all games
		while (!$rs->EOF) {

			unset ($fields);

			$fields['league_id'] = $league_id;

			if ($team_pref_game_day[$rs->fields['team_home']] > 1) {
				// game_day = game_day + pref_date -1    ( 1 = SAT, 2= SUN)

				$gyear = (int) substr($schedule[$rs->fields['game_day']], 0, 4);
				$gmonth = (int) substr($schedule[$rs->fields['game_day']], 5, 2);
				$gday = (int) substr($schedule[$rs->fields['game_day']], 8, 2);

				$gday = $gday + $team_pref_game_day[$rs->fields['team_home']] - 1;

				$fields['game_date'] = strftime(DB_DATE_FORMAT, mktime(0, 0, 0, $gmonth, $gday, $gyear));

				// old: $fields['game_date']		= $schedule[$rs->fields['game_day']];				

			} else {
				$fields['game_date'] = $schedule[$rs->fields['game_day']];
			}
			$fields['game_plan_date'] = $schedule[$rs->fields['game_day']];

			// print ($team_pref_game_time[$rs->fields['team_home']]."<br>");

			if ($team_pref_game_time[$rs->fields['team_home']] != "") {

				$fields['game_time'] = $team_pref_game_time[$rs->fields['team_home']].":00";

			}

			$fields['game_no'] = $rs->fields['game_no'];
			$fields['club_id'] = $team_club[$rs->fields['team_home']];
			$fields['team_id_home'] = $team_id[$rs->fields['team_home']];
			$fields['game_team_home'] = $team_name[$rs->fields['team_home']];
			$fields['char_team_home'] = $rs->fields['team_home'];
			$fields['club_id_guest'] = $team_club[$rs->fields['team_guest']];
			$fields['team_id_guest'] = $team_id[$rs->fields['team_guest']];
			$fields['game_team_guest'] = $team_name[$rs->fields['team_guest']];
			$fields['char_team_guest'] = $rs->fields['team_guest'];
			$fields['game_gym'] = 1;
			$fields['active'] = 1;
			$fields['lastchange'] = date(DB_DATE_FORMAT_FOR_PHP_DATE_FUNCTION);
			$fields['lastuser'] = $_SESSION['system_manager_name'];
			$fields['region'] = $region;

			// if the league is an upperleague ( above_region=1 or 3 < group_id <9 ) then only insert home_game
			$doit = false;
			if ($above_region != 1)  {
				$doit = true;
			}

			if (($above_region == 1) AND ($fields['game_team_home'] != '')) {
				$fields['game_team_ref1'] = $league_name;
				$doit = true;
			}

			if ($doit) {
				$insobj = $this->get_db_object('game', 'game_id');
				$insobj->insert($fields);
			}

			$rs->MoveNext();
		}

		$sql = "UPDATE league SET changeable='N', lastuser='".$_SESSION['system_manager_name']."', lastchange='".date(DB_DATE_FORMAT_FOR_PHP_DATE_FUNCTION)."' WHERE league_id=".$league_id;
		$rs = $this->conn->Execute($sql);
		$sql = "UPDATE team SET changeable='N', lastuser='".$_SESSION['system_manager_name']."', lastchange='".date(DB_DATE_FORMAT_FOR_PHP_DATE_FUNCTION)."' WHERE league_id=".$league_id;
		$rs = $this->conn->Execute($sql);

		/*
		if (isset($_SESSION["main_list_page"]) && $_SESSION["main_list_page"]!="")
			{
				header("Location:".$_SESSION["main_list_page"]);
				exit;
			}
		
			*/

	}


	/**
	 * add a team to a league, that has been alerdy cleaned up
	 * @param league_id integer
	 * @param league_char to be injected
	 */
	function add_team_to_cleanedup( $league_id, $league_char) {


		// get some additional data from LEAGUE
		$sql = "SELECT group_id, league_teams , shortname, above_region, region FROM league WHERE league_id=".$league_id;
		$rs = $this->conn->Execute($sql);

		if ($rs->EOF) {
			print ("this league does not exist");
			return;
		}
		$group_id = $rs->fields['group_id'];
		$above_region = $rs->fields['above_region'];
		$league_teams = $rs->fields['league_teams'];
		$league_name = $rs->fields['shortname'];
		$region = $rs->fields['region'];


		// get teams from TEAM and CLUB
		$sql = "SELECT t.club_id, c.shortname, t.team_no, t.team_id, t.league_char, t.pref_game_day, t.pref_game_time FROM team t, club c WHERE t.league_id=".$league_id." AND t.club_id=c.club_id ";
		$rs = $this->conn->Execute($sql);

		if ($rs->EOF) {
			print ("team does not exist");
			exit;
		}

		while (!$rs->EOF) {
			$team_name[$rs->fields['league_char']] = $rs->fields['shortname'].$rs->fields['team_no'];
			$team_club[$rs->fields['league_char']] = $rs->fields['club_id'];
			$team_id[$rs->fields['league_char']] = $rs->fields['team_id'];			
			$team_pref_game_day[$rs->fields['league_char']] = $rs->fields['pref_game_day'];
			$team_pref_game_time[$rs->fields['league_char']] = $rs->fields['pref_game_time'];

			$rs->MoveNext();
		}

		// get the SCHEDULE
		$sql = "SELECT game_day, game_date FROM schedule WHERE GROUP_ID=".$group_id;
		$rs = $this->conn->Execute($sql);

		if ($rs->EOF) {
			print ("no schedule for this league");
			exit;
		}

		while (!$rs->EOF) {
			$schedule[$rs->fields['game_day']] = $rs->fields['game_date'];
			$rs->MoveNext();
		}

		// get the SEASON _SCHEME
		if ($league_teams < 10) {
			$league_teams = '0'.$league_teams;
		}
		$sql = "SELECT game_day, game_no, team_home, team_guest FROM team_".$league_teams."_scheme";
		$rs = $this->conn->Execute($sql);

		if ($rs->EOF) {
			print ("no scheme for this league");
			exit;
		}

		// generate all games
		while (!$rs->EOF) {

			if ( ($league_char==$rs->fields['team_home']) OR ($league_char==$rs->fields['team_guest'])){ 
				unset ($fields);

				$fields['league_id'] = $league_id;

				if ($team_pref_game_day[$rs->fields['team_home']] > 1) {
					// game_day = game_day + pref_date -1    ( 1 = SAT, 2= SUN)

					$gyear = (int) substr($schedule[$rs->fields['game_day']], 0, 4);
					$gmonth = (int) substr($schedule[$rs->fields['game_day']], 5, 2);
					$gday = (int) substr($schedule[$rs->fields['game_day']], 8, 2);

					$gday = $gday + $team_pref_game_day[$rs->fields['team_home']] - 1;

					$fields['game_date'] = strftime(DB_DATE_FORMAT, mktime(0, 0, 0, $gmonth, $gday, $gyear));

					// old: $fields['game_date']		= $schedule[$rs->fields['game_day']];				

				} else {
					$fields['game_date'] = $schedule[$rs->fields['game_day']];
				}
	
				$fields['game_plan_date'] = $schedule[$rs->fields['game_day']];

				// print ($team_pref_game_time[$rs->fields['team_home']]."<br>");

				if ($team_pref_game_time[$rs->fields['team_home']] != "") {
					$fields['game_time'] = $team_pref_game_time[$rs->fields['team_home']].":00";
				}

				$fields['game_no'] = $rs->fields['game_no'];
				$fields['club_id'] = $team_club[$rs->fields['team_home']];
				$fields['team_id_home'] = $team_id[$rs->fields['team_home']];
				$fields['game_team_home'] = $team_name[$rs->fields['team_home']];
				$fields['char_team_home'] = $rs->fields['team_home'];
				$fields['club_id_guest'] = $team_club[$rs->fields['team_guest']];
				$fields['team_id_guest'] = $team_id[$rs->fields['team_guest']];
				$fields['game_team_guest'] = $team_name[$rs->fields['team_guest']];
				$fields['char_team_guest'] = $rs->fields['team_guest'];
				$fields['game_gym'] = 1;
				$fields['active'] = 1;
				$fields['lastchange'] = date(DB_DATE_FORMAT_FOR_PHP_DATE_FUNCTION);
				$fields['lastuser'] = 'program';
				$fields['region'] = $region;

				// if the league is an upperleague ( above_region=1 or 3 < group_id <9 ) then only insert home_game
				$doit = false; 
				if ($above_region != 1)  {
					$doit = true;
				}

				if (($above_region == 1) AND ($fields['game_team_home'] != '')) {
					$fields['game_team_ref1'] = $league_name;
					$doit = true;
				}

				if ($doit) {
					$insobj = $this->get_db_object('game', 'game_id');
					$insobj->insert($fields);
				}
			}

			$rs->MoveNext();
		}

		$sql = "UPDATE team SET changeable='N' WHERE league_id=".$league_id;
		$rs = $this->conn->Execute($sql);


	}


	/**
	 * remove a team from a league
	 * @param team_id integer
	 */
	function remove_team() {
		// get parameter

		$team_id = $_REQUEST['team_id_selected'];

		// get team data
		$sql = "SELECT t.club_id, t.league_id, t.league_char FROM team t WHERE t.team_id=".$team_id;
		$rs = $this->conn->Execute($sql);
		$league_id = $rs->fields['league_id'];
		$league_char = $rs->fields['league_char'];
		$club_id = $rs->fields['club_id'];

		// get league data
		$sql = "SELECT l.changeable, l.above_region, l.club_id_A, l.club_id_B,l.club_id_C,l.club_id_D,l.club_id_E,l.club_id_F,l.club_id_G,l.club_id_H,l.club_id_I,l.club_id_K,l.club_id_L,l.club_id_M,l.club_id_N,l.club_id_O FROM league l WHERE l.league_id=".$league_id;
		$rs = $this->conn->Execute($sql);
		$leagueIsChangeable = $rs->fields['changeable'];
		$leagueAboveRegion = $rs->fields['above_region'];
		$clubs["A"]=$rs->fields['club_id_A'];
		$clubs["B"]=$rs->fields['club_id_B'];
		$clubs["C"]=$rs->fields['club_id_C'];
		$clubs["D"]=$rs->fields['club_id_D'];
		$clubs["E"]=$rs->fields['club_id_E'];
		$clubs["F"]=$rs->fields['club_id_F'];
		$clubs["G"]=$rs->fields['club_id_G'];
		$clubs["H"]=$rs->fields['club_id_H'];
		$clubs["I"]=$rs->fields['club_id_I'];
		$clubs["K"]=$rs->fields['club_id_K'];
		$clubs["L"]=$rs->fields['club_id_L'];
		$clubs["M"]=$rs->fields['club_id_M'];
		$clubs["N"]=$rs->fields['club_id_N'];
		$clubs["O"]=$rs->fields['club_id_O'];
		

		if ($leagueIsChangeable != 'Y') {
			// games have been created, update games and team

			$sql = "UPDATE game SET club_id=NULL, team_id_home=NULL, game_team_home=NULL WHERE char_team_home=".$league_char." and league_id=".$league_id;
			$rs = $this->conn->Execute($sql);

			$sql = "UPDATE game SET club_id_guest=NULL, team_id_guest=NULL, game_team_guest=NULL WHERE char_team_guest=".$league_char." AND league_id=".$league_id;
			$rs = $this->conn->Execute($sql);

		}

		if ($leagueAboveRegion == '0'){
			//update team data
			$sql = "UPDATE team SET changeable='Y', league_char=0, league_id=0 WHERE team_id=".$team_id;
			$rs = $this->conn->Execute($sql);
		}
		
		
		//adjust league table - remove club
		$sql = "SELECT league_id FROM game where league_id = ".$league_id." AND club_id=".$club_id;
		$rs = $this->conn->Execute($sql);
		
		if (!isset ($rs->fields['league_id'])){
			// only 1 team in league
			
			$key  = array_search($club_id, $clubs);
			while ($key != false):
				$sql = "UPDATE league set club_id_".$key." = NULL WHERE league_id=".$league_id;
				$rs = $this->conn->Execute($sql);
				$clubs[$key]=0;
				$key  = array_search($club_id, $clubs);
			endwhile;
		
		}
		 

		return;

	}

	function add_team() {
		// get parameters

		$league_id = $_SESSION['primary_id'];
		$club_id = $_REQUEST['club_id'];
		$league_char = $_REQUEST['league_char'];
		$team_no = $_REQUEST['team_no'];

		// get league data
		$sql = "SELECT l.changeable, l.above_region, l.club_id_A, l.club_id_B,l.club_id_C,l.club_id_D,l.club_id_E,l.club_id_F,l.club_id_G,l.club_id_H,l.club_id_I,l.club_id_K,l.club_id_L,l.club_id_M,l.club_id_N,l.club_id_O FROM league l WHERE l.league_id=".$league_id;
		$rs = $this->conn->Execute($sql);
		$clubs["A"]=$rs->fields['club_id_A'];
		$clubs["B"]=$rs->fields['club_id_B'];
		$clubs["C"]=$rs->fields['club_id_C'];
		$clubs["D"]=$rs->fields['club_id_D'];
		$clubs["E"]=$rs->fields['club_id_E'];
		$clubs["F"]=$rs->fields['club_id_F'];
		$clubs["G"]=$rs->fields['club_id_G'];
		$clubs["H"]=$rs->fields['club_id_H'];
		$clubs["I"]=$rs->fields['club_id_I'];
		$clubs["K"]=$rs->fields['club_id_K'];
		$clubs["L"]=$rs->fields['club_id_L'];
		$clubs["M"]=$rs->fields['club_id_M'];
		$clubs["N"]=$rs->fields['club_id_N'];
		$clubs["O"]=$rs->fields['club_id_O'];
		$leagueIsChangeable = $rs->fields['changeable'];
		$above_region = $rs->fields['above_region'];

		if ($above_region == 1) {

			$teamname = $team_no;

			// check available league_char
			$sql = "SELECT game_team_guest from game WHERE (char_team_guest=".$league_char." ) and league_id=".$league_id;
			$rs = $this->conn->Execute($sql);

			if (($rs->fields['game_team_guest'] != '') OR ($rs->EOF)) {
				print ("Ziffer nicht mehr frei!");
				exit;
			} else {

				if ($leagueIsChangeable != 'Y') {
					// games have been created, update games and team

					$sql = "UPDATE game set game_team_guest='".$teamname."' where char_team_guest=".$league_char." and league_id=".$league_id;
					$rs = $this->conn->Execute($sql);
				}
			}

		} else {

			//get club data
			$sql = "SELECT shortname FROM club where club_id=".$club_id;
			$rs = $this->conn->Execute($sql);
			$shortname = $rs->fields['shortname'];
			$teamname = $shortname.$team_no;

			// check available league_char
			$sql = "SELECT game_team_home from game WHERE (char_team_home=".$league_char." ) and league_id=".$league_id;
			$rs = $this->conn->Execute($sql);

			$isCleanedup = false;
			$isGenerated = false;
			if ($rs->fields['game_team_home'] != '') {
				print ("Ziffer nicht mehr frei!");
				exit;
			} else {
				if ($rs->EOF) {
					$isCleanedup = true;
				} else {
					$isCleanedup = false;
				}
			}

			if ($leagueIsChangeable == 'Y'){
				$isGenerated = false;
			} else {
				$isGenerated = true;
			}

			$fields['club_id'] = $club_id;
			$fields['league_id'] = $league_id;
			$fields['team_no'] = $team_no;
			$fields['league_char'] = $league_char;
			$fields['lastuser'] = 'program';
			$fields['active'] = 1;
			$fields['lastchange'] = date(DB_DATE_FORMAT_FOR_PHP_DATE_FUNCTION);
			$fields['changeable'] = 'N';

			// check available team
			$sql3 = "SELECT team_id from team WHERE club_id=".$club_id."  and league_id=0 and team_no='".$team_no."'";
			$rs3 = $this->conn->Execute($sql3);
			if ($rs3->EOF){
				$insobj = $this->get_db_object('team', 'team_id');
				$team_id = $insobj->insert($fields);
			} else {
				$team_id = $rs3->fields['team_id'];
				// update team
				$sql = "UPDATE team set league_id=".$league_id.", league_char=".$league_char.", changeable='N' where team_id=".$team_id; 
				$rs = $this->conn->Execute($sql);	
			}

			if (($isGenerated) AND (!$isCleanedup)) {
				// games have been created, update games and team

				$sql = "UPDATE game set club_id=".$club_id.", team_id_home=".$team_id.", game_team_home='".$teamname."' where char_team_home=".$league_char." and league_id=".$league_id;
				$rs = $this->conn->Execute($sql);

				$sql = "UPDATE game set club_id_guest=".$club_id.", team_id_guest=".$team_id.", game_team_guest='".$teamname."' where char_team_guest=".$league_char." and league_id=".$league_id;
				$rs = $this->conn->Execute($sql);
			} else if (($isGenerated) AND ($isCleanedup)) {
				$this->add_team_to_cleanedup($league_id, $league_char);
								
			} 

			// add club to league
			
			$key  = array_search(0, $clubs); // search empty place
			if ($key != false){
				$sql = "UPDATE league set club_id_".$key." = ".$club_id." WHERE league_id=".$league_id;
				$rs = $this->conn->Execute($sql);
			}
				
				
			}

		header("Location:".$_SESSION["main_list_page"]);
		return;

	}

	function clean_up(){
		$league_id = $_REQUEST['league_id_selected'];
	
		$sql = "DELETE FROM game WHERE league_id=".$league_id." AND ( IFNULL(team_id_home,0)=0 OR IFNULL(team_id_guest,0)=0 )";
		$rs = $this->conn->Execute($sql);
	
		
	}

}

?>