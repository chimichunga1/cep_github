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
		array( 'db' => 'book_title','dt' => ++$index,'formatter'=>function($d,$row)
		{
			return htmlspecialchars($d);
		} ),
		array( 'db' => 'date','dt' => ++$index,'formatter'=>function($d,$row)
		{
			return htmlspecialchars($d);
        } ),
		array(
        'db'        => 'id',
        'dt'        => ++$index,
        'formatter' => function( $d, $row )
        {
            $action_buttons="";
            $stud_id=$row['student_id'];
          	$action_buttons.=" <button type='submit' class='btn btn-info' onclick='approve({$d},{$stud_id});' id='btn-approve' data-toggle='tooltip' data-placement='top' title='Approve Student' name='btnapprove' ><i class='fa fa-check'> </i></button> ";
          	$stud_name = $row['stud_name'];
			// $action_buttons.= "<a href='reject_student.php?id={$d}' onclick='return confirm(\"Reject {$stud_name}?\")' class='btn btn-danger' id='btn-archive' name='btnarchive' data-toggle='tooltip' data-placement='top' title='Delete' onclick='archive({$d});'><i class='fa fa-remove'> </i></a>";


                //reject(\"{$row['id']}\")   --------- forApprovalDetails.php?id={$d}
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
		$whereAll=" ss.is_approved='0' AND bt.acc_id = ".$_SESSION[WEBAPP]['user']['user_id']." " ;




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
$complete_query="SELECT ss.id, ss.student_id, ss.book_id, CONCAT('(',bt.book_title,') ',bt.book_content) as book_title, CONCAT(s.first_name,' ',s.last_name) as stud_name, ss.student_id, s.institute, s.section, i.institute, se.name as section,ss.date_enroll as date,ss.is_approved,bt.acc_id
FROM student_subject ss 
INNER JOIN student s ON ss.student_id=s.id
INNER JOIN book_tbl bt ON ss.book_id=bt.book_id
INNER JOIN institute i ON s.institute=i.id
INNER JOIN section se ON s.section=se.id
{$where} {$order} {$limit}";

//NEED TO CREATE VIEWS.

$data=$con->myQuery($complete_query,$bindings)->fetchAll();

$recordsFiltered=$con->myQuery("SELECT FOUND_ROWS();")->fetchColumn();



$recordsTotal=$con->myQuery("SELECT COUNT(ss.id)
FROM student_subject ss 
INNER JOIN book_tbl bt ON ss.book_id=bt.book_id
{$where};",$bindings)->fetchColumn();


$json['draw']=isset ( $request['draw'] ) ?intval( $request['draw'] ) :0;
$json['recordsTotal']=$recordsTotal;
$json['recordsFiltered']=$recordsTotal;
$json['data']=SSP::data_output($columns,$data);

echo json_encode($json);
	die;
?>
