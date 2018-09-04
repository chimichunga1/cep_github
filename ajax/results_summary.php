<?php
	require_once('../support/config.php');


	$primaryKey ='acc_id';
	$index=-1;

	$columns = array(
		array( 'db' => 'stud_name','dt' => ++$index,'formatter'=>function($d,$row)
		{
			return htmlspecialchars($d);
		} ),
		array( 'db' => 'book_title','dt' => ++$index,'formatter'=>function($d,$row)
		{
			return htmlspecialchars($d);
		} ),
		array( 'db' => 'chapter_desc','dt' => ++$index,'formatter'=>function($d,$row)
		{
			return htmlspecialchars($d);
		} ),
		array( 'db' => 'total_score','dt' => ++$index,'formatter'=>function($d,$row)
		{
			return htmlspecialchars($d);
		} ),
		array( 'db' => 'total_item','dt' => ++$index,'formatter'=>function($d,$row)
		{
			return htmlspecialchars($d);
        } ),
        array( 'db' => 'average','dt' => ++$index,'formatter'=>function($d,$row)
		{
			return htmlspecialchars($d."%");
        } ),
        
		array( 'db' => 'date_taken','dt' => ++$index,'formatter'=>function($d,$row)
		{
			return htmlspecialchars($d);
        } )
    
	);
	require( '../support/ssp.class.php' );

		$limit = SSP::limit( $_GET, $columns );
		$order = SSP::order( $_GET, $columns );

		$where = SSP::filter( $_GET, $columns, $bindings );
		$whereAll="";
		$whereResult="";

		$filter_sql="  ";
		$whereAll=" ct.is_deleted='0' " ;
		

	if(!empty($_GET['client_id']))
	{
		$emp=" client_id=:client_id ";    
		if(!empty($filter_sql))
		{
			$filter_sql.=" AND ";
		}
		$bindings[]=array('key'=>'client_id','val'=>$_GET['client_id'],'type'=>0);
		$filter_sql.=$emp;
	}

	function jp_bind($bindings)
	{
		$return_array=array();
		if ( is_array( $bindings ) ) 
		{
			for ( $i=0, $ien=count($bindings) ; $i<$ien ; $i++ ) 
			{
				//$binding = $bindings[$i];
				// $stmt->bindValueb   	qA@( $binding['key'], $binding['val'], $binding['type'] );
				$return_array[$bindings[$i]['key']]=$bindings[$i]['val'];
			}
		}
		return $return_array;
	}
$whereAll.=$filter_sql;
$where.= !empty($where) ? " AND ".$whereAll:"WHERE ".$whereAll;
$bindings=jp_bind($bindings);
// var_dump($bindings);
$complete_query="SELECT ss.id, ss.student_id, ss.chapter_id, ss.total_score, ss.total_item, ss.date_taken, ss.average,ct.chapter_desc,ct.is_deleted,
CONCAT(s.first_name,' ',s.last_name) as stud_name, ct.book_id, bt.book_title
 FROM student_score ss
 INNER JOIN chapter_tbl ct ON ss.chapter_id=ct.chapt_id
 INNER JOIN student s ON ss.student_id=s.id 
 INNER JOIN book_tbl bt ON ct.book_id=bt.book_id {$where} {$order} {$limit}";    

//NEED TO CREATE VIEWS.

$data=$con->myQuery($complete_query,$bindings)->fetchAll();

$recordsFiltered=$con->myQuery("SELECT FOUND_ROWS();")->fetchColumn();



$recordsTotal=$con->myQuery("SELECT COUNT(ss.id)
FROM student_score ss
INNER JOIN chapter_tbl ct ON ss.chapter_id=ct.chapt_id  {$where};",$bindings)->fetchColumn();


$json['draw']=isset ( $request['draw'] ) ?intval( $request['draw'] ) :0;
$json['recordsTotal']=$recordsTotal;
$json['recordsFiltered']=$recordsTotal;
$json['data']=SSP::data_output($columns,$data);

echo json_encode($json);
	die;
?>