<?php

namespace application\library;


class PDODriver implements IDriver
{

    private $connection;

    public function __construct($host, $database, $user, $password, $port, $charset)
    {
        $this->connection = new \PDO("mysql:host={$host};dbname={$database};port={$port};charset={$charset}",
            $user,
            $password
        );
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function find($table, $login = NULL)
    {
        $query = sprintf("SELECT * FROM %s", $table);
        $params = [];

        if ($login != NULL) {
            $params = [
                ':login' => $login
            ];
            $query .= " WHERE {$table}_login = :login";
        }

        $queryPrepare = $this->getConnection()->prepare($query);
        $queryPrepare->execute($params);
        return $queryPrepare->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function insert($table, $data)
    {
        $result = null;
        if (isset($data) && !empty($data)) {
            $fields = array_keys($data);

            $labels = array_map(function ($items) {
                return ":" . $items;
            }, $fields);

            $fields = array_map(function ($items) {
                return "`" . $items . '`';
            }, $fields);

            $query = sprintf(
                "INSERT INTO %s (%s) VALUES (%s)",
                $table,
                implode(", ", $fields),
                implode(", ", $labels)
            );
            $queryPrepare = $this->getConnection()->prepare($query);

            $queryPrepare->execute(array_combine($labels, array_values($data)));
                $result = $this->getConnection()->lastInsertId();
        }
        return $result;
    }

    public function update($table, $data, $condition, $comparator = 'AND')
    {
        $result = false;

        if (isset($data) && !empty($data)) {
            $comparator = ' ' . trim($comparator) . ' ';
            $keys = array_keys($data);

            $dataMap = array_map(function ($items) {
                return $items . " = :" . $items;
            }, $keys);

            $conditionMap = [];

            foreach ($condition as $key => $value) {
                array_push($conditionMap, "{$key} ='$value' ");
            }

            $query = sprintf(
                "UPDATE %s SET %s WHERE %s",
                $table,
                implode(', ', $dataMap),
                implode($comparator, $conditionMap)
            );

            $queryPrepare = $this->getConnection()->prepare($query);

            $dataEx = array_combine(
                array_map(
                    function ($key) {
                        return ":" . $key;
                    },
                    $keys
                )
                , array_values($data));

            $result = $queryPrepare->execute($dataEx);
        }

        return $result;
    }

    public function delete($table, $id)
    {
        $result = false;

        if (isset($id)) {
            $query = sprintf("DELETE FROM %s WHERE %s_id = :id", $table, $table);
            $queryPrepare = $this->getConnection()->prepare($query);
            $queryPrepare->bindParam(':id', $id, \PDO::PARAM_INT);
            $queryPrepare->execute();

        }
        return $result;
    }

    public function __destruct()
    {
        $this->connection = NULL;
    }


}