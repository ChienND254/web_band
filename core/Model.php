<?php
class Model extends Database
{
    protected $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function create($table, $data)
    {
        if (!empty($data)) {
            $fieldStr = '';
            $valueStr = '';
            foreach ($data as $key => $value) {
                $fieldStr .= "$key,";
                $valueStr .= "'$value',";
            }
            $fieldStr = rtrim($fieldStr, ',');
            $valueStr = rtrim($valueStr, ',');
            $sql = "INSERT INTO $table($fieldStr) VALUE ($valueStr)";

            $status = $this->db->query($sql);
            if ($status) {
                return true;
            }
        }
        return false;
    }

    public function update($table, $id, $data){
        if (!empty($data)) {
            $updateStr = '';
            foreach ($data as $key => $value) {
                $updateStr .= "$key = '$value',";
            }
            $updateStr = rtrim($updateStr, ',');

            $sql = "UPDATE $table SET $updateStr WHERE id = $id";

            $status = $this->db->query($sql);
            if ($status) {
                return true;
            }
        }
        return false;
    }

    public function delete_row($table, $id) {
        $sql = "DELETE FROM $table WHERE id = $id";

        $status = $this->db->query($sql);
        if ($status) {
            return true;
        }
        return false;
    }

    public function findAll($table, $condition = '')
    {
        if ($condition == '') {
            $sql = "SELECT * FROM $table";
        } else {
            $sql = "SELECT * FROM $table $condition";
        }
        $query = $this->db->query($sql);
        if (!empty($sql)) {
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        return false;
    }

    public function findById($table, $id)
    {
        $sql = "SELECT * FROM $table WHERE id = $id";
        $query = $this->db->query($sql);
        if (!empty($sql)) {
            return $query->fetchAll(PDO::FETCH_ASSOC)[0];
        }
        return false;
    }
    public function querySQL($condition)
    {
        $query = $this->db->query($condition);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
