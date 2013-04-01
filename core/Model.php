<?php

class Model
{
    /**
     * @var array
     */
    private static $connections = array();

    /**
     * @var string
     */
    private $conf = 'default';

    /**
     * @var string|boolean
     */
    protected $table = false;

    /**
     * @var resource
     */
    private $db;

    /**
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var int
     */
    private $id;

    /**
     * @var array
     */
    private $errors = array();

    /**
     * @var Form
     */
    private $form;

    /**
     * @var array
     */
    protected $validate = array();

    /**
     * Constructeur (connection à la bdd)
     */
    public function __construct()
    {
        $conf = Conf::$databases[$this->conf];

        if (false === $this->table) {
            $this->table = strtolower(get_class($this)).'s';
        }

        if (isset(Model::$connections[$this->conf])) {
            $this->db = Model::$connections[$this->conf];

            return true;
        }

        try {
            $pdo = new PDO(
                'mysql:host='.$conf['host'].';dbname='.$conf['database'].';',
                $conf['login'],
                $conf['password'],
                array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')
            );

            $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);

            Model::$connections[$this->conf] = $pdo;
            $this->db = $pdo;
        } catch (PDOException $e) {
            if (Conf::$debug >= 1) {
                die($e->getMessage());
            } else {
                die('Impossible de se connecter à la base de donnée');
            }
        }
    }

    /**
     * Permet de faire un SELECT
     *
     * @param array $req Tableau qui contient les arguments à passer au SELECT
     *
     * @return array Retourne un tableau qui contient les objets retrounés par le SELECT
     */
    public function find($req)
    {
        $sql = 'SELECT ';

        if (isset($req['fields'])) {
            if (is_array($req['fields'])) {
                $sql .= implode(',' , $req['fields']);
            } else {
                $sql .= $req['fields'];
            }
        } else {
            $sql .= '*';
        }

        $sql .= ' FROM '.$this->table.' ';

        if (isset($req['join'])) {
            foreach ($req['join'] as $key => $value) {
                $sql .= 'LEFT JOIN '.$key.' ON '.$value.' ';
            }
        }

        if (isset($req['conditions'])) {
            $sql .= 'WHERE ';

            if (!is_array($req['conditions'])) {
                $sql .= $req['conditions'];
            } else {
                $cond = array();
                foreach ($req['conditions'] as $k => $v) {
                    if (!is_numeric($v)) {
                        $v = '"'.$v.'"';
                    }

                    $cond[] = "$k=$v";
                }

                $sql .= implode(' AND ',$cond);
            }
        }

        if (isset($req['order'])) {
            $sql .= ' ORDER BY '.$req['order']['field'].' '.$req['order']['sc'];
        }

        if (isset($req['limit'])) {
            $sql .= ' LIMIT '.$req['limit'];
        }

        $pre = $this->db->prepare($sql);
        $pre->execute();

        return $pre->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Permet de récupérer le premier élément d'une requête SQL
     *
     * @param array $req Tableau qui contient les arguments à passer au SELECT
     *
     * @return array Retourne la première ligne retournée par la requete SQL
     */
    public function findFirst($req)
    {
        return current($this->find($req));
    }

    /**
    * Permet de récupérer un tableau indexé par primaryKey et avec name pour valeur
    *
    * @param array $req Tableau qui contient les arguments à passer au SELECT
    *
    * @return array
    */
    public function findList($req = array())
    {
        if (!isset($req['fields'])) {
            $req['fields'] = $this->primaryKey.', name';
        }

        $d = $this->find($req);

        $r = array();
        foreach ($d as $key => $value) {
            $r[current($value)] = next($value);
        }

        return $r;
    }

    /**
     * Permet de compter le nombre de ligne d'une table
     *
     * @param array $conditions Conditions de la clause WHERE
     *
     * @return int Retourne le nombre de ligne trouvée
     */
    public function findCount($conditions)
    {
        $res = $this->findFirst(array(
            'fields'     => 'COUNT('.$this->primaryKey.') as count',
            'conditions' => $conditions
        ));

        return $res->count;
    }

    /**
     * Permet de faire un INSERT ou un UPDATE
     *
     * @param array $data Données à sauvegarder
     *
     * @return boolean true si tout est OK
     */
    public function save($data)
    {
        $key = $this->primaryKey;

        $fields = array();
        $d = array();

        foreach ($data as $k => $value) {
            if ($k != $this->primaryKey) {
                $fields[] = $k.'=:'.$k;
                $d[':'.$k] = $value;
            } elseif (!empty($value)) {
                $d[':'.$k] = $value;
            }
        }

        if (isset($data->$key) && !empty($data->$key)) {
            $sql = 'UPDATE '.$this->table.' SET '.implode(',', $fields).' WHERE '.$key.'=:'.$key;
            $this->id = $data->$key;
            $action = 'update';
        } else {
            $sql = 'INSERT INTO '.$this->table.' SET '.implode(',', $fields);
            $action = 'insert';
        }

        $pre = $this->db->prepare($sql);

        $pre->execute($d);

        if ('insert' === $action) {
            $this->id = $this->db->lastInsertId();
        }

        return true;
    }

    /**
     * Permet de supprimer une ligne d'une table en spécifiant sa clé primaire
     *
     * @param int $id Clé primaire de la ligne à supprimer
     *
     * @return Retourne true
     */
    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE {$this->primaryKey} = $id;";
        $this->db->query($sql);

        return true;
    }

    /**
     * Permet de valider les données d'un formulaire avant de le sauvegarder en bdd
     *
     * @param array $data Données du formulaire
     *
     * @return boolean Retourne true si tout c'est bien passé, false sinon
     */
    public function validates($data)
    {
        $errors = array();
        $primaryKey = $this->primaryKey;

        foreach ($this->validate as $field => $rules) {
            foreach ($rules as $rule => $options) {
                if (!isset($options['edit']) || (true === $options['edit'] && empty($data->$primaryKey))) {
                    if ('notEmpty' === $rule) {
                        if (empty($data->$field)) {
                            $errors[$field] = $options['message'];
                        }
                    }

                    if ('unique' === $rule) {
                        if (empty($data->$primaryKey)) {
                            $conditions = array($field => $data->$field);
                        } else {
                            $conditions = array($field => $data->$field, $primaryKey.' !' => $data->$primaryKey);
                        }

                        $count = $this->findCount($conditions);
                        if ($count > 0) {
                            $errors[$field] = $options['message'];
                        }
                    }

                    if ('regex' === $rule) {
                        if (!preg_match('/^'.$options['regex'].'$/', $data->$field)) {
                            $errors[$field] = $options['message'];
                        }
                    }

                    if ('equal' === $rule) {
                        if ($data->$field != $data->$options['field']) {
                            $errors[$field] = $options['message'];
                        }
                    }
                }
            }
        }

        $this->errors = $errors;

        if (isset($this->form)) {
            $this->form->setErrors($errors);
        }

        if (empty($errors)) {
            return true;
        }

        return false;
    }
}
