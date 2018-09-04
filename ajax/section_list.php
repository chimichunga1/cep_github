<?php
	require_once('../support/config.php');

	$index=-1;

	$columns = array(
		array( 'db' => 'institute','dt' => ++$index,'formatter'=>function($d,$row)
		{
			return htmlspecialchars($d);
		} ),
		array( 'db' => 'name','dt' => ++$index,'formatter'=>function($d,$row)
		{
			return htmlspecialchars($d);
		} ),

		array(
        'db'        => 'id',
        'dt'        => ++$index,
        'formatter' => function( $d, $row )
        {
            $action_buttons="";

          	$action_buttons.=" <a href='frm_section.php?id={$d}' class='btn btn-info' id='btn-approve' data-toggle='tooltip' data-placement='top' title='Edit Institute' name='btnedit' ><i class='fa fa-edit'> </i></a> ";
          	$s_name=$row['name'];
          	if ($_SESSION[WEBAPP]['user']['user_type_id'] == '1') {
			$action_buttons.= "<a onclick='return confirm(\"Are you sure to delete {$s_name} ?\")' href='delete.php?id={$d}&t=sec' class='btn btn-danger' id='btn-archive' name='btnarchive' data-toggle='tooltip' data-placement='top' title='Delete' onclick='archive({$d});'><i class='fa fa-remove'> </i></a>";
			}

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
		$whereAll=" s.is_deleted='0' " ;




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
$complete_query="SELECT s.id, s.name, i.institute
FROM section s
INNER JOIN institute i ON s.institute_id=i.id

{$where} {$order} {$limit}";

//NEED TO CREATE VIEWS.

$data=$con->myQuery($complete_query,$bindings)->fetchAll();

$recordsFiltered=$con->myQuery("SELECT FOUND_ROWS();")->fetchColumn();



$recordsTotal=$con->myQuery("SELECT COUNT(s.id)
FROM section s {$where};",$bindings)->fetchColumn();


$json['draw']=isset ( $request['draw'] ) ?intval( $request['draw'] ) :0;
$json['recordsTotal']=$recordsTotal;
$json['recordsFiltered']=$recordsTotal;
$json['data']=SSP::data_output($columns,$data);

echo json_encode($json);
	die;
?>
