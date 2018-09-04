<?php
	require_once('../support/config.php');


	$primaryKey ='acc_id';
	$index=-1;

	$columns = array(
		array( 'db' => 'book_title','dt' => ++$index,'formatter'=>function($d,$row)
		{
			return htmlspecialchars($d);
		} ),
		array( 'db' => 'name','dt' => ++$index,'formatter'=>function($d,$row)
		{
			return htmlspecialchars($d);
		} ),
		array(
        'db'        => 'book_id',
        'dt'        => ++$index,
        'formatter' => function( $d, $row )
        {
            $action_buttons="";

          	$action_buttons.=" <a href='chapter_list.php?id={$d}' class='btn btn-info' id='btn-approve' data-toggle='tooltip' data-placement='top' title='View' ><i class='fa fa-search'> </i></a> ";
			$action_buttons.=" <a href='sem_report.php?id={$d}' target='_blank' class='btn btn-info' id='btn-approve' data-toggle='tooltip' data-placement='top' title='View' ><i class='fa fa-print'> PRINT SEMESRAL REPORT </i></a> ";



                //reject(\"{$row['id']}\")   --------- forApprovalDetails.php?id={$d}
            return $action_buttons;


        }
		)

	);
	require( '../support/ssp.class.php' );

		$limit = SSP::limit( $_GET, $columns );
		$order = SSP::order( $_GET, $columns );

		$where = SSP::filter( $_GET, $columns, $bindings );
		$whereAll="";
		$whereResult="";

		$filter_sql="  ";
		$whereAll=" bt.is_deleted='0' AND bt.acc_id = ".$_SESSION[WEBAPP]['user']['user_id']." " ;




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
$complete_query="SELECT bt.book_id,CONCAT('(',bt.book_title,') ',bt.book_content) as book_title, bt.section_id,s.name,bt.is_deleted
 FROM book_tbl bt
 INNER JOIN section s ON bt.section_id=s.id
 {$where} {$order} {$limit}";

//NEED TO CREATE VIEWS.

$data=$con->myQuery($complete_query,$bindings)->fetchAll();

$recordsFiltered=$con->myQuery("SELECT FOUND_ROWS();")->fetchColumn();



$recordsTotal=$con->myQuery("SELECT COUNT(bt.book_id)
FROM book_tbl bt
{$where};",$bindings)->fetchColumn();


$json['draw']=isset ( $request['draw'] ) ?intval( $request['draw'] ) :0;
$json['recordsTotal']=$recordsTotal;
$json['recordsFiltered']=$recordsTotal;
$json['data']=SSP::data_output($columns,$data);

echo json_encode($json);
	die;
?>
