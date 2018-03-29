<?php
/**
 * Created by PhpStorm.
 * User: JRokH
 * Date: 2018-03-29
 * Time: 오후 5:57
 */
require_once ('./db_con.php');

$id = intval($_GET['bss_no']) ?? 0;

$response = array();

if ($id === 0){
    $response['code'] = 501;
    $response['msg'] = 'parameter error!';
}

try {
    $sql = 'select a.id,a.title,a.contents,a.img_path,a.updated_at as \'bbs_updated_at\',b.email as \'author_email\',b.nickname as \'author_name\',b.created_at as \'author_created_at\' from (select * from bbs WHERE id = :id) a join users b ON a.user_id=b.id';
    $stat = $pdo->prepare($sql);
    $stat->execute(array(':id'=>$id));
    $result = $stat->fetch(PDO::FETCH_ASSOC);

    $isBBS = $stat->rowCount();
    if ($isBBS > 0){
        $response['code'] = 200;
        $response['result'] = $result;
    } else {
        $response['code'] = 201;
        $response['msg'] = 'none';
    }

} catch (PDOException $e){
    $response['code'] = 502;
    $response['msg'] = 'db error!';
} catch (Exception $e){
    $response['code'] = 500;
    $response['msg'] = 'server error!';
}

header("Content-Type: application/json");
echo json_encode($response);

