<?php

//
// kebby_with_fire api for pouet improvement
//


//
// account.php
//

// update user

// select cdc
// SELECT cdc, timelock FROM users_cdcs WHERE user='".$_SESSION["SCENEID_ID"]."'

// update users cdc
// delete from users_cdcs where user=".$_SESSION["SCENEID_ID"];
// insert into users_cdcs set cdc='".$v."', user='".$_SESSION["SCENEID_ID"]."', timelock=CURRENT_DATE";

// select banned 
// select id from users where level='banned' and lastip='".$_SERVER["REMOTE_ADDR"]."'

// insert user
// INSERT users SET

// SELECT * FROM users WHERE id='".$_SESSION["SCENEID_ID"]."'"

// SELECT cdc, (CURRENT_DATE - timelock) as time, prods.name FROM users_cdcs LEFT JOIN prods ON prods.id = users_cdcs.cdc WHERE user='".$_SESSION["SCENEID_ID"]."'";
    


//
// add.php
//

// SELECT who FROM oneliner ORDER BY quand DESC LIMIT 1";

// $query="SELECT message FROM oneliner WHERE who = ".(int)$who." ORDER BY quand DESC LIMIT 1";
// dont forget lastmine output

// $query="INSERT INTO oneliner SET who=".$who.", quand=NOW(), message='".addslashes($message)."'";

// create_cache_module("onelines", "SELECT oneliner.who,oneliner.message,users.nickname,users.avatar FROM oneliner,users WHERE oneliner.who=users.id ORDER BY oneliner.quand DESC LIMIT 50",0);

// SELECT topic FROM bbs_topics ORDER BY lastpost DESC LIMIT 1";

// $query="INSERT bbs_topics SET topic='".mysql_real_escape_string($topic)."',category='".(int)$_POST["category"]."',lastpost=NOW(),firstpost=NOW(),userlastpost=".$_SESSION["SCENEID_ID"].",userfirstpost=".$_SESSION["SCENEID_ID"];

// $query="INSERT bbs_posts SET topic=".$lastid.",post='".addslashes($message)."',author=".$_SESSION["SCENEID_ID"].",added=NOW()";

// $query="SELECT author,topic,post FROM bbs_posts ORDER BY added DESC LIMIT 1";

// $query="SELECT id FROM bbs_topics where id=".$which;

// $query="SELECT count(0) FROM bbs_posts WHERE topic=".$which;

//  $query="UPDATE bbs_topics SET lastpost=NOW(),count=".$count.",userlastpost=".$_SESSION["SCENEID_ID"]." WHERE id=".$which;

//  $query="INSERT bbs_posts SET topic=".$which.",post='".addslashes($message)."',author=".$_SESSION["SCENEID_ID"].",added=NOW()";

// $query="SELECT who FROM comments where comment='".addslashes($comment)."' and who=".$_SESSION["SCENEID_ID"]." and which=".$which." ORDER BY quand DESC LIMIT 1";

// $query="SELECT count(0) FROM comments WHERE who=".$_SESSION["SCENEID_ID"]." AND which=".$which." AND rating!=0";

//  $query="INSERT comments SET comment='".addslashes($comment)."',who=".$_SESSION["SCENEID_ID"].",which=".$which.",rating=".$rating.",quand=NOW()";

//	$query  = "SELECT comments.rating,comments.who FROM comments WHERE comments.which='".$which."'";

// $query="UPDATE prods SET voteup=".$rulez.", votepig=".$piggie.", votedown=".$sucks.", voteavg='".$avg."' where id=".$which;

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

// create_cache_module("latest_comments", "SELECT prods.id,prods.name,prods.type,prods.group1,prods.group2,prods.group3,comments.who,users.nickname,users.avatar FROM prods JOIN comments LEFT JOIN users ON users.id=comments.who WHERE comments.which=prods.id ORDER BY comments.quand DESC LIMIT 20",1);

// create_cache_module("top_demos", "SELECT prods.id, prods.name,prods.type,prods.group1,prods.group2,prods.group3 FROM prods WHERE prods.quand > DATE_SUB(sysdate(),INTERVAL '30' DAY) AND prods.quand < DATE_SUB(sysdate(),INTERVAL '0' DAY) ORDER BY (prods.views/((sysdate()-prods.quand)/100000)+prods.views)*prods.voteavg*prods.voteup desc LIMIT 50",1);


//
// affil.php
//

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




?>