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
    public function index()
    {
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
        require APP_PATH . '/view/index/index.php';
    }

    /**
     * 删除通讯录记录
     * POST
     * id_list: 要删除的记录id列表数组
     */
    public function del(){

    }
}
