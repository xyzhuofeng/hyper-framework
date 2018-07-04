<?php

namespace app\model;

use hyper\Connection;

/**
 * 通讯录
 * Class Contacts
 */
class Contacts
{
    /**
     * 添加记录
     * @param array $data
     * @return bool|string 成功返回最后插入的id，失败返回false
     */
    public static function save(array $data)
    {
        $pdo = Connection::getInstance();
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
     * 通过主键id获取记录
     * @param int $id
     * @return mixed
     */
    public static function get(int $id)
    {
        $pdo = Connection::getInstance();
        $prepare = 'SELECT * FROM contacts WHERE id = ?';
        $state = $pdo->prepare($prepare);
        $state->bindParam(1, $id, \PDO::PARAM_INT);
        $state->execute();
        return $state->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * 获取所有联系人
     * @return array|null
     */
    public static function all()
    {
        $pdo = Connection::getInstance();
        $state = $pdo->prepare('SELECT * FROM contacts');
        $state->execute();
        return $state->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * 通过关键字查找记录（姓名、手机、邮箱）
     * @param string $keyword 关键字
     * @return array
     */
    public static function findByKeyword(string $keyword)
    {
        $pdo = Connection::getInstance();
        $keyword = '%' . $keyword . '%';
        $prepare = 'SELECT * FROM contacts WHERE name LIKE ? OR phone LIKE ? OR email LIKE ?';
        $state = $pdo->prepare($prepare);
        $state->bindParam(1, $keyword);
        $state->bindParam(2, $keyword);
        $state->bindParam(3, $keyword);
        $state->execute();
        return $state->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * 根据id更新记录
     * @param int $id 要更新的记录主键id
     * @param array $data 更新的数据
     * @return bool|string
     */
    public static function update(int $id, array $data)
    {
        $pdo = Connection::getInstance();
        $state = $pdo->prepare('UPDATE contacts SET name=?,phone=?,email=? WHERE id=?');
        $state->bindParam(1, $data['name']);
        $state->bindParam(2, $data['phone']);
        $state->bindParam(3, $data['email']);
        $state->bindParam(4, $id);
        if ($state->execute()) {
            return $state->rowCount();
        }
        return false;
    }

    /**
     * 通过id列表批量删除记录
     * @param array $id_list
     * @return int
     */
    public static function deleteByIdList(array $id_list)
    {
        $list_str = implode(',', $id_list);
        $pdo = Connection::getInstance();
        $prepare = 'DELETE FROM contacts WHERE id IN (' . $list_str . ')';
        $state = $pdo->prepare($prepare);
        if ($state->execute()) {
            return $state->rowCount();
        }
        return false;
    }
}
