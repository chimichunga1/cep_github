<?php
	require_once('../support/config.php');

	$index=-1;

	$columns = array(
		array( 'db' => 'name','dt' => ++$index,'formatter'=>function($d,$row)
		{
			return htmlspecialchars($d);
		} ),
		array( 'db' => 'last_activity','dt' => ++$index,'formatter'=>function($d,$row)
		{
			return htmlspecialchars($d);
        } ),
        array( 'db' => 'email','dt' => ++$index,'formatter'=>function($d,$row)
		{
			return htmlspecialchars($d);
		} ),

		array(
        'db'        => 'user_id',
        'dt'        => ++$index,
        'formatter' => function( $d, $row )
        {
            $action_buttons="";

          	$action_buttons.=" <a href='frm_faculty.php?id={$d}' class='btn btn-info' id='btn-approve' data-toggle='tooltip' data-placement='top' title='Edit Institute' name='btnedit' ><i class='fa fa-edit'> </i></a> ";

			// $action_buttons.= "<a onclick='return confirm(\"Are you sure to delete this entry?\")' href='delete.php?id={$d}&t=fac' class='btn btn-danger' id='btn-archive' name='btnarchive' data-toggle='tooltip' data-placement='top' title='Delete' onclick='archive({$d});'><i class='fa fa-remove'> </i></a>";


            return $action_buttons;


        }
    ),

	);
	require( '../support/ssp.class.php' );

		$limit = SSP::limit( $_GET, $columns );
		$order = SSP::order( $_GET, $columns );

		$where = SSP::filter( $_GET, $columns, $bindings );
		$whereAll="";
		$whereResult="";

		$filter_sql="  ";
		$whereAll=" is_deleted='0' " ;




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
$complete_query="SELECT user_id, CONCAT(last_name,', ',first_name,' ',middle_initial) as name, last_activity,email
FROM users

{$where} {$order} {$limit}";

//NEED TO CREATE VIEWS.

$data=$con->myQuery($complete_query,$bindings)->fetchAll();

$recordsFiltered=$con->myQuery("SELECT FOUND_ROWS();")->fetchColumn();



$recordsTotal=$con->myQuery("SELECT COUNT(user_id)
FROM users {$where};",$bindings)->fetchColumn();


$json['draw']=isset ( $request['draw'] ) ?intval( $request['draw'] ) :0;
$json['recordsTotal']=$recordsTotal;
$json['recordsFiltered']=$recordsTotal;
$json['data']=SSP::data_output($columns,$data);

echo json_encode($json);
	die;
?>
