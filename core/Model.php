<?php


namespace Core;

class Model
{
    protected $pdo;

    protected $id;

    public function getTable(){}

    public function getColumn(){}

    public function __construct($pdo = null)
    {
        $opt = array(
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
        );
        $this->pdo = $pdo ? $pdo : new \PDO('mysql:dbname=question;host=127.0.0.1', 'root', '', $opt);
    }

    public function makeQuery($sql, $many = false, $opt= null)
    {
        $query = $this->pdo->query($sql);
        return $many ? $query->fetchAll($opt) : $query->fetch($opt);
    }

    public function findByKey($cols, $key, $value, $order = null, $sort = true, $fetchAll = false, $opt = null)
    {
        if(is_array($cols)){
            $cols = implode(',', $cols);
        }
        $continue = '';
        if($order){
            $sort = $sort ? ' ASC' : ' DESC';
            $continue = ' ORDER BY '.$order.$sort;
        }
        $sql = 'SELECT '. $cols .' FROM '. $this->getTable(). ' WHERE '. $key .' = \''. $value. '\''.$continue;
        if($fetchAll){
            return $this->pdo->query($sql)->fetchAll($opt);
        }
        return $this->pdo->query($sql)->fetch($opt);
    }

    public function findAll($wheres = '', $opt = null)
    {
        $sql = 'SELECT * FROM '. $this->getTable().' '.$wheres;
        return $this->pdo->query($sql)->fetchAll(\PDO::FETCH_CLASS, static::class);
    }

    public function find($key, $value)
    {
        return $this->pdo->query('SELECT * FROM '. $this->getTable(). ' WHERE '. $key . ' = \'' . $value. '\'')->fetchObject(static::class);
    }

    public function delete()
    {
        return $this->pdo->query('DELETE FROM '. $this->getTable(). ' WHERE id = '. $this->id);
    }

    public function save()
    {
        foreach ($this->getColumn() as $key) {
            $values[] = '"'.$this->$key.'"';
        }
        return $this->pdo->query('INSERT INTO '.$this->getTable().'('.implode(',', $this->getColumn()).
            ') VALUES ('.implode(',',$values).')');
    }

    public function update()
    {
        foreach ($this->getColumn() as $key) {
            $values[] = $key.' = "'.$this->$key.'"';
        }
        return $this->pdo->query('UPDATE '.$this->getTable().' SET '.implode(',', $values).' WHERE id = '.$this->id);
    }


}