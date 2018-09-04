<?php
	require_once('../support/config.php');

	$index=-1;

	$columns = array(
		array( 'db' => 'amount','dt' => ++$index,'formatter'=>function($d,$row)
		{
			return htmlspecialchars(number_format($d,2). " PHP");
		} ),
		array( 'db' => 'date_generated','dt' => ++$index,'formatter'=>function($d,$row)
		{
			return htmlspecialchars($d);
        } ),
        array( 'db' => 'code','dt' => ++$index,'formatter'=>function($d,$row)
		{
			return htmlspecialchars($d);
		} ),
		array( 'db' => 'stud_name','dt' => ++$index,'formatter'=>function($d,$row)
		{
			return htmlspecialchars($d);
		} ),
		array( 'db' => 'date_used','dt' => ++$index,'formatter'=>function($d,$row)
		{
			return htmlspecialchars($d);
		} ),
		
    
    
	);
	require( '../support/ssp.class.php' );

		$limit = SSP::limit( $_GET, $columns );
		$order = SSP::order( $_GET, $columns );

		$where = SSP::filter( $_GET, $columns, $bindings );
		$whereAll="";
		$whereResult="";

		$filter_sql="  ";
		$whereAll=" cg.is_deleted='0' AND cg.status_id='2' " ;
		

	

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
$complete_query="SELECT cg.id,cg.code,cg.amount,cg.date_generated,cg.used_by,cg.date_used,cg.is_deleted,cg.status_id,CONCAT('(',s.student_id,') ',s.first_name,' ',s.last_name) as stud_name
FROM code_generated cg
INNER JOIN student s ON cg.used_by=s.id

{$where} {$order} {$limit}";    

//NEED TO CREATE VIEWS.

$data=$con->myQuery($complete_query,$bindings)->fetchAll();

$recordsFiltered=$con->myQuery("SELECT FOUND_ROWS();")->fetchColumn();



$recordsTotal=$con->myQuery("SELECT COUNT(cg.id)
FROM code_generated cg {$where};",$bindings)->fetchColumn();


$json['draw']=isset ( $request['draw'] ) ?intval( $request['draw'] ) :0;
$json['recordsTotal']=$recordsTotal;
$json['recordsFiltered']=$recordsTotal;
$json['data']=SSP::data_output($columns,$data);

echo json_encode($json);
	die;
?>