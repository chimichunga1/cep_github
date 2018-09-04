<?php
	require_once('../support/config.php');


	$primaryKey ='acc_id';
	$index=-1;

	$columns = array(
		array( 'db' => 'stud_name','dt' => ++$index,'formatter'=>function($d,$row)
		{
			return htmlspecialchars($d);
		} ),
		array( 'db' => 'action','dt' => ++$index,'formatter'=>function($d,$row)
		{
			return htmlspecialchars($d);
		} ),
		array( 'db' => 'price','dt' => ++$index,'formatter'=>function($d,$row)
		{
			return htmlspecialchars($d);
		} ),
		array( 'db' => 'date_of_payment','dt' => ++$index,'formatter'=>function($d,$row)
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
		$whereAll=" s.is_deleted='0' " ;
		

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
$complete_query="SELECT ph.id, ph.student_id, ph.action, ph.price, ph.date_of_payment, CONCAT(s.first_name,' ',s.last_name) as stud_name, s.is_deleted
FROM payment_history ph 
INNER JOIN student s ON ph.student_id=s.id {$where} {$order} {$limit}";    

//NEED TO CREATE VIEWS.

$data=$con->myQuery($complete_query,$bindings)->fetchAll();

$recordsFiltered=$con->myQuery("SELECT FOUND_ROWS();")->fetchColumn();



$recordsTotal=$con->myQuery("SELECT COUNT(ph.id)
FROM payment_history ph
INNER JOIN student s ON ph.student_id=s.id {$where};",$bindings)->fetchColumn();


$json['draw']=isset ( $request['draw'] ) ?intval( $request['draw'] ) :0;
$json['recordsTotal']=$recordsTotal;
$json['recordsFiltered']=$recordsTotal;
$json['data']=SSP::data_output($columns,$data);

echo json_encode($json);
	die;
?>