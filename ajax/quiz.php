<?php

require_once("../support/config.php");


$primaryKey ='question_id';
$index=-1;

$columns = array(

array( 'db' => 'question','dt' => ++$index,'formatter'=>function($d,$row)
{
   return htmlspecialchars($d);
} ),
array( 'db' => 'question_type','dt' => ++$index,'formatter'=>function($d,$row)
{
   return htmlspecialchars($d);
} ),

array(
        'db'        => 'question_id',
        'dt'        => ++$index,
        'formatter' => function( $d, $row ) 
        {
            $action_buttons="";
                
             
                    // $action_buttons.="<a class='btn btn-sm btn-success btn-flat' title='Update User' href='frm_user.php?user_id=" .$d. "'>  <span class='fa fa-edit'></span></a>&nbsp;";
                    //  $action_buttons.="<a class='btn btn-sm btn-danger btn-flat' onclick='return confirm(\"Are you sure to delete this user?\")' title='Delete User' href='delete.php?id={$row['question_id'] }&t=users'> <span class='fa fa-trash'></span></a>&nbsp;";
                    
      
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

$filter_sql="";


// if(!empty($_GET['company']))
// {
//     $company_sql=":company";
//     $inputs['company']=$_GET['company'];
//     $filter_sql.=" AND company_id = ".$company_sql."";
//     $bindings[]=array('key'=>'company','val'=>$_GET['company'],'type'=>0);
//     //$company_sql = !empty($_GET['company']);
// }
$chapt_id = $_GET['chapt_id'];

$whereAll=" is_deleted=0 AND chapt_id = '{$chapt_id}' "; //dagdag ung nakasession na user :)
$whereAll.=$filter_sql;
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
$where.= !empty($where) ? " AND ".$whereAll:"WHERE ".$whereAll;
$bindings=jp_bind($bindings);
$complete_query="SELECT * FROM `questions_tbl`  {$where} {$order} {$limit}";    
//NEED TO CREATE VIEWS.

$data=$con->myQuery($complete_query,$bindings)->fetchAll();
$recordsFiltered=$con->myQuery("SELECT FOUND_ROWS();")->fetchColumn();

$recordsTotal=$con->myQuery("SELECT COUNT(question_id) FROM `questions_tbl` {$where};",$bindings)->fetchColumn();


$json['draw']=isset ( $request['draw'] ) ?intval( $request['draw'] ) :0;
$json['recordsTotal']=$recordsFiltered;
$json['recordsFiltered']=$recordsFiltered;
$json['data']=SSP::data_output($columns,$data);

echo json_encode($json);

// $resTotalLength = SSP::sql_exec( $db, $bindings,
//             "SELECT COUNT(`{$primaryKey}`)
//              FROM   `$table` ".
//             $whereAllSql
//         );

die;
