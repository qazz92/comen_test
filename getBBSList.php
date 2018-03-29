<?php
/**
 * Created by PhpStorm.
 * User: JRokH
 * Date: 2018-03-29
 * Time: 오후 5:09
 */
require_once ('./db_con.php');

$page = intval($_GET['page']) ?? 0;
$limit = intval($_GET['limit']) ?? 0;

$response = array();

if ($page === 0 || $limit === 0){
    $response['code'] = 501;
    $response['msg'] = 'parameter error!';
}

$offset = ($page-1)*$limit;

try {
    $sql = 'select id,title,img_path,updated_at from bbs ORDER BY id desc LIMIT :limit OFFSET :offset';
    $stat = $pdo->prepare($sql);
    $stat->bindValue(':limit', intval($limit), PDO::PARAM_INT);
    $stat->bindValue(':offset', intval($offset), PDO::PARAM_INT);
    $stat->execute();
    $result = $stat->fetchAll(PDO::FETCH_ASSOC);

    $response['code'] = 200;
    $response['result'] = $result;
} catch (PDOException $e){
    $response['code'] = 502;
    $response['msg'] = 'db error!';
} catch (Exception $e){
    $response['code'] = 500;
    $response['msg'] = 'server error!';
}

header("Content-Type: application/json");
echo json_encode($response);
