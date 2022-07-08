<?php

namespace application\library;

use Exception;

class MySQLiDriver implements IDriver {
    public $connection;
    public function __construct($host, $database, $user, $password, $port, $charset)
    {
        $this->connection = new \mysqli($host, $user, $password, $database, $port);
        $this->connection->set_charset($charset);
        if ($this->connection->connect_errno) {
            $error = sprintf("Mysql error %s : %s",
                $this->connection->connect_errno,
                $this->connection->connect_error
            );
            throw new Exception($error);
        }
    }
    public function getConnection()
    {
        return $this->connection;
    }


    public function find($table, $id = 0)
    {
        if ($id) {
            $query = $this->getConnection()->prepare("SELECT * FROM {$table} WHERE id = ? LIMIT 1");
            $query->bind_param('i', $id);
            $query->execute();

            $data = $query->get_result();
            $result = $data->fetch_assoc();
        } else {
            $query = $this->getConnection()->query("SELECT * FROM {$table}");
            $result = [];
            while ($row = $query->fetch_assoc()) {
                $result[] = $row;
            }
        }

        return $result;
    }

    /**
     * @param string $table
     * @param string $model
     * @param int $id
     * @return object|array
     */
    public function findAndMap($table, $model, $id = 0)
    {
        if ($id) {
            $query = $this->getConnection()->prepare("SELECT * FROM {$table} WHERE id = ? LIMIT 1");
            $query->bind_param('i', $id);
            $query->execute();

            $data = $query->get_result();
            $result = $data->fetch_object($model);
        } else {
            $query = $this->getConnection()->query("SELECT * FROM {$table}");
            $result = [];
            while ($row = $query->fetch_object($model)) {
                $result[] = $row;
            }
        }

        return $result;
    }

    /**
     * @param string $table
     * @param array $data
     * @return bool|mixed
     */
    public function insert($table,  $data)
    {
        $result = false;
        $keys = array_keys($data);
        $values = array_values($data);

        if ($keys && $values) {
            $query = sprintf(
                'INSERT INTO %s (%s) VALUES ("%s")',
                $table,
                implode(', ', $keys),
                implode('", "', $values)
            );
            if ($this->getConnection()->query($query)) {
                $result = $this->getConnection()->insert_id;
            }
        }

        return $result;
    }

    /**
     * @param string $table
     * @param array $data
     * @param array $conditions
     * @param string $comparator
     * @return bool
     */
    public function update($table,  $data,  $conditions, $comparator = 'AND')
    {
        $result = false;
        if ($data) {
            $dataMap = [];
            foreach ($data as $key => $value) {
                array_push($dataMap, "{$key} = '{$value}'");
            }
            $conditionsMap = [];
            foreach ($conditions as $key => $value) {
                array_push($conditionsMap, "{$key} = '{$value}'");
            }

            $comparator = ' ' . strtoupper(trim($comparator)) . ' ';
            $query = sprintf(
                'UPDATE %s SET %s WHERE %s',
                $table,
                implode(', ', $dataMap),
                implode($comparator, $conditionsMap)
            );

            $result = $this->getConnection()->query($query);
        }

        return $result;
    }

    /**
     * @param string $table
     * @param int $id
     * @return bool
     */
    public function delete($table, $id)
    {
        $result = false;
        if ($id) {
            $query = sprintf('DELETE FROM %s WHERE id = ?', $table);
            $query = $this->getConnection()->prepare($query);
            $query->bind_param('i', $id);
            $result = $query->execute();
        }

        return $result;
    }
//    public function findUser($userlogin)
//    {
//        $query = "SELECT * FROM `users` WHERE `login` LIKE '$userlogin'";
//        $queryPrepare = $this->getConnection()->query($query);
//        $result = mysqli_fetch_array($queryPrepare);
//        echo $result['login'] . ' ' . $result['name'] . ' ' . $result['email'];
//    }
//
//
//    public function insertUser()
//    {
//
//        $login = $_POST['userlogin'];
//        $name = $_POST['name'];
//        $email = $_POST['email'];
//        $pass = md5($_POST['password']);
//
//        $sql = "INSERT INTO `users`(`login`, `password`, `name`, `email`)
// VALUES ('$login', '$pass', '$name', '$email')";
//
//        mysqli_query($this->getConnection(), $sql);
//    }
//    public function __destruct()
//    {
//        $this->getConnection()->close();
//    }
    public function __destruct()
    {
        $this->getConnection()->close();
    }
}