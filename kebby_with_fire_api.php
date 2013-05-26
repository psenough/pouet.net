<?php

//
// kebby_with_fire api for pouet improvement
// as seen on tv: https://github.com/lra/pouet.net/issues/33
//

// gameplan:
// 1) go through all .php's and document use cases as function calls.
// 2) create a json_api.php with those php functions that take arguments and return the json.
// 3) refactor the current user.php and prod.php etc to use them, parsing the json result into the currently used php arrays.
// 4) test if all documented use cases are working ok locally. only then push it live.
// 5) write a json_rpc_api.php with functions that parse a json rpc input call, detect the right call and wrap it to the corresponding function in json_api.php (or port the calls to nodejs/whatever)
// 6) replace all user.php and prod.php again and have them call the json_rpc_api directly?
// 7) refactor v2 to use json_rpc_api calls. open them to authenticated external calls.


// lets take this wonderful opportunity to migrate from the deprecated mysql to mysqli
function connect_mysqli() {
	if (!$mysqli) $mysqli = new mysqli($auth['localhost'],$auth['user'],$auth['pass'],$auth['db']);
}

$close_mysqli_automatically = true;

function close_mysqli() {
	if ($close_mysqli_automatically && $mysqli) $mysqli->close();
}


//
// account.php
//

// uc_account_1
// get im types
function kbfire_api_get_imtypes() {
 	connect_mysqli();
 	
	$query = 'DESC users im_type';
	unset($row);
	unset($im_types);
	if ($result = $mysqli->query($query)) {

		while ($row = $result->fetch_row()) {
			//printf ("%s (%s)\n", $row[0], $row[1]);
			$reg = "/^enum\('(.*)'\)$/";
			$tmp = preg_replace($reg,'\1',$row[1]);
			$im_types = preg_split("/[']?,[']?/",$tmp);
		}

		$result->close();
	}
	
	//todo: verify, if db is not utf-8, need to iconv('latin1', 'UTF-8', $tmp); before calling json_encode
	
	close_mysqli();
	return json_encode($im_types);
}
//todo: test me

// uc_account_2
// update user
//todo:

// uc_account_3
// select cdc
// SELECT cdc, timelock FROM users_cdcs WHERE user='".$_SESSION["SCENEID_ID"]."'
function kbfire_api_get_cdc_timelock($sceneid) {
	connect_mysqli();
 	
	$query = 'SELECT cdc, timelock FROM users_cdcs WHERE user=\''.$sceneid.'\'';
	unset($row);
	unset($output);
	if ($result = $mysqli->query($query)) {
		while($row = $result->fetch_array(MYSQLI_ASSOC)) {
			$output[] = array( 
				'cdc' 		=> $row['cdc'],
				'timelock'	=> $row['timelock']
				); 
		}
	}
	$result->close();

	return json_encode($output);
}
//todo: test me

// uc_account_4
// update users cdc
// delete from users_cdcs where user=".$_SESSION["SCENEID_ID"];
// insert into users_cdcs set cdc='".$v."', user='".$_SESSION["SCENEID_ID"]."', timelock=CURRENT_DATE";

// uc_account_5
// select banned 
// select id from users where level='banned' and lastip='".$_SERVER["REMOTE_ADDR"]."'

// uc_account_6
// insert user
// INSERT users SET

// uc_account_7
// SELECT * FROM users WHERE id='".$_SESSION["SCENEID_ID"]."'"

// uc_account_8
// SELECT cdc, (CURRENT_DATE - timelock) as time, prods.name FROM users_cdcs LEFT JOIN prods ON prods.id = users_cdcs.cdc WHERE user='".$_SESSION["SCENEID_ID"]."'";
    


//
// add.php
//

// uc_add_1
// SELECT who FROM oneliner ORDER BY quand DESC LIMIT 1";

// uc_add_2
// $query="SELECT message FROM oneliner WHERE who = ".(int)$who." ORDER BY quand DESC LIMIT 1";
// dont forget lastmine output

// uc_add_3
// $query="INSERT INTO oneliner SET who=".$who.", quand=NOW(), message='".addslashes($message)."'";

// uc_add_4
// create_cache_module("onelines", "SELECT oneliner.who,oneliner.message,users.nickname,users.avatar FROM oneliner,users WHERE oneliner.who=users.id ORDER BY oneliner.quand DESC LIMIT 50",0);

// uc_add_5
// SELECT topic FROM bbs_topics ORDER BY lastpost DESC LIMIT 1";

// uc_add_6
// $query="INSERT bbs_topics SET topic='".mysql_real_escape_string($topic)."',category='".(int)$_POST["category"]."',lastpost=NOW(),firstpost=NOW(),userlastpost=".$_SESSION["SCENEID_ID"].",userfirstpost=".$_SESSION["SCENEID_ID"];

// uc_add_7
// $query="INSERT bbs_posts SET topic=".$lastid.",post='".addslashes($message)."',author=".$_SESSION["SCENEID_ID"].",added=NOW()";

// uc_add_8
// $query="SELECT author,topic,post FROM bbs_posts ORDER BY added DESC LIMIT 1";

// uc_add_9
// $query="SELECT id FROM bbs_topics where id=".$which;

// uc_add_10
// $query="SELECT count(0) FROM bbs_posts WHERE topic=".$which;

// uc_add_11
//  $query="UPDATE bbs_topics SET lastpost=NOW(),count=".$count.",userlastpost=".$_SESSION["SCENEID_ID"]." WHERE id=".$which;

// uc_add_12
//  $query="INSERT bbs_posts SET topic=".$which.",post='".addslashes($message)."',author=".$_SESSION["SCENEID_ID"].",added=NOW()";

// uc_add_13
// $query="SELECT who FROM comments where comment='".addslashes($comment)."' and who=".$_SESSION["SCENEID_ID"]." and which=".$which." ORDER BY quand DESC LIMIT 1";

// uc_add_14
// $query="SELECT count(0) FROM comments WHERE who=".$_SESSION["SCENEID_ID"]." AND which=".$which." AND rating!=0";

// uc_add_15
//  $query="INSERT comments SET comment='".addslashes($comment)."',who=".$_SESSION["SCENEID_ID"].",which=".$which.",rating=".$rating.",quand=NOW()";

// uc_add_16
//	$query  = "SELECT comments.rating,comments.who FROM comments WHERE comments.which='".$which."'";

// uc_add_17
// $query="UPDATE prods SET voteup=".$rulez.", votepig=".$piggie.", votedown=".$sucks.", voteavg='".$avg."' where id=".$which;

// uc_add_18
//		$sql = "SELECT prods.id,prods.name,prods.type,prods.group1,prods.group2,prods.group3,comments.who,users.nickname,users.avatar,".
//              " g1.name as groupname1,g1.acronym as groupacron1, ".
//              " g2.name as groupname2,g2.acronym as groupacron2, ".
//              " g3.name as groupname3,g3.acronym as groupacron3, ".
//              " GROUP_CONCAT(platforms.name) as platform ".
// 			       " FROM prods ".
// 			       " JOIN comments JOIN prods_platforms JOIN platforms ".
// 			       " LEFT JOIN users ON users.id=comments.who ".
//              " LEFT JOIN groups AS g1 ON prods.group1 = g1.id".
//              " LEFT JOIN groups AS g2 ON prods.group2 = g2.id".
//              " LEFT JOIN groups AS g3 ON prods.group3 = g3.id".
//              " AND prods_platforms.prod=prods.id ".
//              " AND prods_platforms.platform=platforms.id ".
// 			       " WHERE comments.which=prods.id ".
//              " GROUP BY comments.id ".
// 			       " ORDER BY comments.quand DESC LIMIT 20";

// uc_add_19
// create_cache_module("latest_comments", "SELECT prods.id,prods.name,prods.type,prods.group1,prods.group2,prods.group3,comments.who,users.nickname,users.avatar FROM prods JOIN comments LEFT JOIN users ON users.id=comments.who WHERE comments.which=prods.id ORDER BY comments.quand DESC LIMIT 20",1);

// uc_add_20
// create_cache_module("top_demos", "SELECT prods.id, prods.name,prods.type,prods.group1,prods.group2,prods.group3 FROM prods WHERE prods.quand > DATE_SUB(sysdate(),INTERVAL '30' DAY) AND prods.quand < DATE_SUB(sysdate(),INTERVAL '0' DAY) ORDER BY (prods.views/((sysdate()-prods.quand)/100000)+prods.views)*prods.voteavg*prods.voteup desc LIMIT 50",1);


//
// affil.php
//

// uc_affil_1
// $sql  = " SELECT *,".
// " p1.id as p1id, ".
// " p1.name as p1name, ".
// " p1.type as p1type, ".
// " p2.id as p2id, ".
// " p2.name as p2name, ".
// " p2.type as p2type, ".
// " affiliatedprods.type as type ".
// " from affiliatedprods ".
// " left join prods as p1 on p1.id = affiliatedprods.original ".
// " left join prods as p2 on p2.id = affiliatedprods.derivative ".
// "";


//todo: document usecases of all remaining .php's


?>