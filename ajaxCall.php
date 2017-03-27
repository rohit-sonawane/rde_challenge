<?php
/**
 * Created by PhpStorm.
 * User: rohit
 * Date: 3/25/2017
 * Time: 5:27 AM
 */
error_reporting(E_ERROR | E_PARSE);
require_once("include.php");

if(isset($_REQUEST['lat']) && isset($_REQUEST['lon']))
{
    $query="insert into visitors_details (ip,time_stamp,lat,lon) VALUES ('".$_SERVER['HTTP_HOST']."',NOW(),".$_REQUEST['lat'].",".$_REQUEST['lon'].")";
    mysqli_query($db,$query);
    echo $_SERVER['HTTP_HOST'];
}
if($_REQUEST['admin'] && $_REQUEST['fd'] && $_REQUEST['td'])
{

     $fd=date("Y-m-d", strtotime($_REQUEST['fd'])); $td=date("Y-m-d", strtotime($_REQUEST['td']));
     $query="select ip,lat,lon from visitors_details where date(time_stamp) between '".$fd."' and '".$td."'  ";
    $res=mysqli_query($db,$query);
    $marker_data = array();
    while($arr=mysqli_fetch_array($res,MYSQLI_NUM))
    {
        array_push($marker_data,$arr);
    }


    echo json_encode($marker_data);
}

if($_REQUEST['admin'] && $_REQUEST['start'])
{
      $query="select ip,lat,lon from visitors_details where time_stamp >  DATE_SUB(NOW(),INTERVAL 300 MINUTE);";
    $res=mysqli_query($db,$query);
    $marker_data = array();
    while($arr=mysqli_fetch_array($res,MYSQLI_NUM))
    {
        array_push($marker_data,$arr);
    }


    echo json_encode($marker_data);
}
?>

