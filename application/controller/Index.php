<?php

namespace app\controller;
use app\model\Contacts;

/**
 * Class Index
 * @package app\controller
 */
class Index
{
    /**
     * 首页
     */
    public function index(){
        if (isset($_GET['keyword']) && $_GET['keyword'] !== '') {
            $keyword = addslashes(htmlspecialchars(trim($_GET['keyword'])));
        } else {
            $keyword = null;
        }
// 获取数据
        if ($keyword) {
            $result = Contacts::findByKeyword($keyword);
        } else {
            $result = Contacts::all();
        }
        require APP_PATH.'/view/index/index.php';
    }
}