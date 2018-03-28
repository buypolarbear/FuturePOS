<?php
	
	$articoli=Array();
	$risultati=Array();
	$risultatiTag=Array();
	$analisiTag=Array();
	$programmiTag=Array();
	
	$arraySearchers=["titolo","testo","autore","descrizione","anteprima", "anteprima_miniatura", "credits", "tag"];
	$i=0;
	$r=0;
	$t=0;
	$url=$_SERVER['REQUEST_URI'];
	$searchKeywords=str_replace('%20',' ',str_replace('/ricerca/','',$url));
	
	if($searchKeywords==''){
		$searchKeywords=$_GET['ricerca'];
	}
	
	if(isset($searchKeywords)){
		//check se è una ricerca già fatta		
		mysql_select_db($database_connect, $connect);
		$query_rs_check_search = "SELECT * FROM datatype_ricerche WHERE search_keywords='".str_replace("'","\'",$searchKeywords)."' ORDER BY data_ricerca DESC";
		$rs_check_search = mysql_query($query_rs_check_search, $connect) or die(mysql_error());
		$check_search = mysql_fetch_assoc($rs_check_search);
		$risultati='';
		$foundTags=0;
		do{
			if($i==0){$risultatiIDs=$check_search['risultati'];}
			$past=strtotime('now')-strtotime($check_search['data_ricerca']);
			$days=$past/(60*60*24);
			if($days<=1){
				$foundTags=1;
				$risultatiIDs=$check_search['risultati_tags'];
				$newCount=$check_search['count']+1;
				$updateSQL = sprintf("UPDATE datatype_ricerche SET count=%s WHERE id=%s",
		                       GetSQLValueString($newCount, "text"),
		                       GetSQLValueString($check_search['id'], "int"));
		
		                       mysql_select_db($database_connect, $connect);
		                       mysql_query($updateSQL, $connect) or die(mysql_error());
			}//ricerca esatta
			$i++;
		}while($check_search = mysql_fetch_assoc($rs_check_search));
		
		if($risultatiIDs!=''){
			$i=0;
				mysql_select_db($database_connect, $connect);
				$query_rs_articoli="SELECT * FROM datatype_articoli WHERE id IN (".$risultatiIDs.") ORDER BY data DESC";
				$rs_articoli = mysql_query($query_rs_articoli, $connect) or die(mysql_error($connect));
				$row_rs_articoli = mysql_fetch_assoc($rs_articoli);
				$i=0;
				
				do{
					$inArray=1;
						$risultati[$r]=$row_rs_articoli['id'];
						$articoli[$i]=$row_rs_articoli;
						if(!in_array($row_rs_articoli['programmi'], $programmiTags)){
							array_push($programmiTags, $row_rs_articoli['programmi']);
						}
						if(!in_array($row_rs_articoli['analisi'], $analisiTags)){
							array_push($analisiTags, $row_rs_articoli['analisi']);
						}
						array_push($arrayPrezzo,$row_rs_articoli);
						$i++;
						$t++;
					$r++;
				}while($row_rs_articoli = mysql_fetch_assoc($rs_articoli));
				
		}else{
			$query_rs_articoli="SELECT * FROM datatype_articoli WHERE attivo='SI' ORDER BY data DESC";
			$rs_articoli = mysql_query($query_rs_articoli, $connect) or die(mysql_error($connect));
			$row_rs_articoli = mysql_fetch_assoc($rs_articoli);
			
			$searchArray=str_split($searchKeywords);
			$searchWords=explode(' ',$searchKeywords);
	
			$percOneWord=50;
			$percRelativeWord=50;
			do{
				$possible='no';
				$exact='no';
				$corrispondenze=0;
				foreach($arraySearchers as $searchFunction){
					if(strtolower($searchKeywords)==strtolower($row_rs_articoli[$searchFunction])){
						$exact='si';
					}
				}
				if($exact=='si'){
					$possible='si';
					$productScores[0]=1000000;
				}else{
					$productScores=Array();
					foreach($arraySearchers as $searchFunction){
						$searcher=explode(' ',strtolower($row_rs_articoli[$searchFunction]));
						$letterWords=str_split(strtolower($row_rs_articoli[$searchFunction]));				
						$percPlusWord=100/count($searcher);
						$totMatch=count($searchArray);
						if(count($searcher)>1){
							$corrispondenzeRelative=0;
							$corrispondenzeAbs=0;
							$countMatchWords=0;
							foreach ($searcher as $words){
								$corrispondenze=0;
								$letterWords=str_split($words);
								$totMatchRelative=count($words);
								$ltt=0;
								$wordLoop=0;
								foreach ($searchArray as $char){
									if(in_array($words, $searchWords)){
										$countMatchWords++;
									}else{
										if($ltt<=count($searchArray)){
											if($char==$letterWords[$ltt]){
												$corrispondenze++;
											}else{
												$corrispondenze--;
											}
											$ltt++;
										}
									}
									$wordLoop++;
								}	
								$percMatch=100*$corrispondenze/$totMatchRelative;
								if(round($percMatch)>=$percRelativeWord){$countMatchWords++;}
								if(round($percMatch)>90){$countMatchWords+=3;}
								$corrispondenzeAbs+=$corrispondenze;
							}
							if($searchFunction!='testo'){
								$corrispondenzeAbs+=$countMatchWords*$percPlusWord;
								$percMatchAbsolute=100*$corrispondenzeAbs/$totMatch;
								if(round($percMatchAbsolute)>=$percPlusWord){$possible='si';}	
							}else{
								if($countMatchWords>=1){$possible='si';}
							}
						}else{			
							$ltt=0;
							foreach ($searchArray as $char){
								if($char==$letterWords[$ltt]){
									$corrispondenze++;
								}
								$ltt++;
							}	
							$percMatchAbsolute=100*$corrispondenze/$totMatch;	
							if(round($percMatchAbsolute)>=$percOneWord){$possible='si';}					
						} //ricerca inDB
						array_push($productScores, $percMatchAbsolute);
					}//loopoversearchers
					arsort($productScores);
				} //ricerca							
				if($possible=='si'){
					$risultati[$r]['id']=$row_rs_articoli['id'];
					$risultati[$r]['match']=$productScores[0];
					$articoli[$i]=$row_rs_articoli;
					$articoli[$i]['match']=$productScores[0];	
					if(!in_array($row_rs_articoli['programmi'], $programmiTags)){
						array_push($programmiTags, $row_rs_articoli['programmi']);
					}
					if(!in_array($row_rs_articoli['analisi'], $analisiTags)){
						array_push($analisiTags, $row_rs_articoli['analisi']);
					}
					$r++;
					$i++;
				}				
			}while($row_rs_articoli = mysql_fetch_assoc($rs_articoli));
			aarsort($risultati,'match');
			aarsort($articoli,'match');
			
			$rtoStore=Array();
			foreach($risultati as $risultato){
				array_push($rtoStore, $risultato['id']);
			}
			$rTagToStore=Array();
			
			$insertSQL = sprintf("INSERT INTO datatype_ricerche (search_keywords, tags, risultati, risultati_tags, data_ricerca, id_utente, count) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString(str_replace("'","\'",$searchKeywords), "text"),
                       GetSQLValueString($tagString, "text"),
                       GetSQLValueString(implode(',',$rtoStore), "text"),
                       GetSQLValueString(implode(',',$rTagToStore), "text"),
                       GetSQLValueString(date('Y-m-d H:i:s'), "date"),
                       GetSQLValueString($user['id'], "text"),
                       GetSQLValueString(1, "int"));

                       mysql_select_db($database_connect, $connect);
                       mysql_query($insertSQL, $connect) or die(mysql_error());
		}//ricerca non fatta
	}//ricerca dettagliata
					
	
?>