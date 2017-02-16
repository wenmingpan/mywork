<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * dwz ajax 数据返回
 * @param type $statusCode ok:200, error:300, timeout:301
 * @param type $message
 * @param type $navTabId
 * @param type $callbackType
 * @param type $forwardUrl
 */
function dwz_ajax_do($statusCode, $message, $navTabId='', $callbackType='closeCurrent', $forwardUrl='')
{
    $data = array(
        'statusCode' => $statusCode,
        'message' => $message,
        'navTabId' => $navTabId,
        'callbackType' => $callbackType,
        'forwardUrl' => $forwardUrl,
        
    );
    echo json_encode($data);exit;
}
