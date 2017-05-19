<?php

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
    public function save(array $data)
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
}
