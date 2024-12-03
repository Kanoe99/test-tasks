<?php

namespace Models;
use Database\Database;

class GroupsItems
{

    protected $table = 'groups';
    protected $db;

    public function __construct()
    {
        $this->db = new Database('mysql', 'db', 'database', 'root', 'root');

    }

    public function getByIdParent($id_parent)
    {
        $query = "SELECT * from {$this->table} where id_parent = :id_parent";
        $this->db->query($query, ['id_parent' => $id_parent]);

        return $this->db->get();
    }
}