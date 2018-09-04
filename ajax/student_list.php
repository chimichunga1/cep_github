<?php
	require_once('../support/config.php');

	$index=-1;

	$columns = array(
		array( 'db' => 'stud_name','dt' => ++$index,'formatter'=>function($d,$row)
		{
			return htmlspecialchars($d);
		} ),
		array( 'db' => 'institute','dt' => ++$index,'formatter'=>function($d,$row)
		{
			return htmlspecialchars($d);
		} ),
		array( 'db' => 'section','dt' => ++$index,'formatter'=>function($d,$row)
		{
			return htmlspecialchars($d);
		} ),
		array( 'db' => 'date','dt' => ++$index,'formatter'=>function($d,$row)
		{
			return htmlspecialchars($d);
        } ),
        array( 'db' => 'my_balance','dt' => ++$index,'formatter'=>function($d,$row)
		{
			if ($d > 0) {
				return htmlspecialchars($d." PHP");
			} else {
				return htmlspecialchars("---");
			}
			
        } ),
		
    
    
	);
	require( '../support/ssp.class.php' );

		$limit = SSP::limit( $_GET, $columns );
		$order = SSP::order( $_GET, $columns );

		$where = SSP::filter( $_GET, $columns, $bindings );
		$whereAll="";
		$whereResult="";

		$filter_sql="  ";
		$whereAll=" s.is_deleted='0' AND is_approve='1' " ;
		

	

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
$complete_query="SELECT s.id, CONCAT(s.first_name,' ',s.last_name) as stud_name, s.is_deleted, s.is_approve, s.institute, s.section, i.institute, se.name as section,date_register as date, s.my_balance
FROM student s 
INNER JOIN institute i ON s.institute=i.id
INNER JOIN section se ON s.section=se.id
{$where} {$order} {$limit}";    

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