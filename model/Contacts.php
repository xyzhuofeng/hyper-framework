<?php

/**
 * 通讯录
 * Class Contacts
 */
class Contacts
{
    private $whereList = null;

    /**
     * 添加记录
     * @param array $data
     * @return bool|string 成功返回最后插入的id，失败返回false
     */
    public static function save(array $data)
    {
        $pdo = DBDriver::getInstance();
        $state = $pdo->prepare('INSERT INTO contacts (name, phone, email) VALUES (?,?,?) ');
        $state->bindParam(1, $data['name']);
        $state->bindParam(2, $data['phone']);
        $state->bindParam(3, $data['email']);
        if ($state->execute()) {
            return $pdo->lastInsertId();
        }
        return false;
    }

    /**
     * 获取所有联系人
     * @return array|null
     */
    public static function all()
    {
        $pdo = DBDriver::getInstance();
        $state = $pdo->prepare('SELECT * FROM contacts');
        $state->execute();
        return $state->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * 通过关键字查找记录（姓名、手机、邮箱）
     * @param string $keyword 关键字
     * @return array
     */
    public static function findByKeyword(string $keyword)
    {
        $pdo = DBDriver::getInstance();
        $keyword = '%' . $keyword . '%';
        $prepare = 'SELECT * FROM contacts WHERE name LIKE ? OR phone LIKE ? OR email LIKE ?';
        $state = $pdo->prepare($prepare);
        $state->bindParam(1, $keyword);
        $state->bindParam(2, $keyword);
        $state->bindParam(3, $keyword);
        $state->execute();
        return $state->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * 通过id列表批量删除记录
     * @param array $id_list
     * @return int
     */
    public static function deleteByIdList(array $id_list)
    {
        $list_str = implode(',', $id_list);
        $pdo = DBDriver::getInstance();
        $prepare = 'DELETE FROM contacts WHERE id IN (' . $list_str . ')';
        $state = $pdo->prepare($prepare);
        $state->execute();
        return $state->rowCount();
    }
}
