<?php

namespace Models;
use Database\Database;

class GroupsItems
{

    protected $table = 'groups';
    protected $db;

    public function __construct()
    {
        $this->db = new Database();

    }

    public function getByIdParent($id_parent)
    {
        $query = "SELECT * from {$this->table} where id_parent = :id_parent";
        $this->db->query($query, [':id_parent' => $id_parent]);

        return $this->db->get();
    }

    public function getDepth($id_parent)
    {
        $query = "SELECT count(distinct id_parent) as count from {$this->table}";

        $this->db->query($query);
        $result = $this->db->get();


        return $result[0]['count'];
    }
}