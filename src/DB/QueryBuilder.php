<?php
/***
 * Builder pattern for QueryBuilder class
 */

namespace App\DB;

use stdClass;
use Exception;

class QueryBuilder
{
    protected stdClass $query;
    private DBConnection $db;

    public function __construct()
    {
        $this->db = DBConnection::getInstance();
        $this->reset();
    }

    protected function reset(): void
    {
        $this->query = new stdClass();
    }

    public function select(string $table, array $fields): QueryBuilder
    {
        $this->reset();
        $this->query->base = "SELECT ".implode(',', $fields)." FROM ".$table;
        $this->query->type = 'select';

        return $this;
    }

    public function join(string $table, string $condition1, string $condition2): QueryBuilder
    {
        if (!in_array($this->query->type, ['select', 'update', 'delete'])) {
            throw new Exception('JOIN can only be added to SELECT, UPDATE or DELETE');
        }

        $this->query->join[] = " INNER JOIN $table ON $condition1=$condition2";

        return $this;
    }

    public function where(string $field1, string $fieldOrCondition, string $field2 = null): QueryBuilder
    {
        if (!in_array($this->query->type, ['select', 'update', 'delete'])) {
            throw new Exception('WHERE can only be added to SELECT, UPDATE or DELETE');
        }

        if (isset ($field2)) {
            $this->query->where[] = "$field1 $fieldOrCondition '$field2'";
        } else {
            $this->query->where[] = "$field1 = '$fieldOrCondition'";
        }

        return $this;
    }


    public function get(): array
    {
        $rows = [];

        $sql = $this->query->base;

        if (!empty($this->query->join)) {
            $sql .= implode(', ', $this->query->join);
        }

        if (!empty($this->query->where)) {
            $sql .= " WHERE ".implode(' AND ', $this->query->where);
        }
        $sql .= ";";

        $sqlObject = $this->db->runSql($sql);

        while ($row = $sqlObject->fetch_array(MYSQLI_ASSOC)) {
            $rows[] = $row;
        }

        return $rows;
    }

}