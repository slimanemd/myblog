<?php 
// /*------------------------------------------------------------------*/
// //
// class PostEntity{
//     // Properties
//     public $id;
//     public $category_id;
//     public $title;
//     public $body;
//     public $author;
//     public $created_at;
    
//     //ref
//     public $category; //link with $category_id
    
//     //
//     public function __construct()  {  }
    
//     //
//     public function setEntityProperties($row){
//         foreach(array_keys($row) as $key) $this->$key = $row[$key];
//     }
    
//     //
//     public function toString(){
//         return $this->id . " ; " . $this->title;
//     }
// }
/*------------------------------------------------------------------*/
require_once('entities/Post.php');

/*------------------------------------------------------------------*/
//
class PostManager
{
    // DB Stuff
    //private $table = 'posts';
    public $entity;
    public $db;
    
    const TABLE = "posts";
    const FIELDS = ['id','created_at', 'title', 'body', 'author', 'category_id']; //ICTBAG
    
    //Cat
    public function __construct($db, $entity){
        $this->db =  $db;
        $this->entity = $entity;
    }
    
    // Create Post
    public function crud($operation, $pParams =[], $pSetMap=[]) {
        
        //prefix  c.name
        if ($operation == 'read')
            $query = (new Select( array_merge(self::FIELDS,  []))) // 'name AS category_name'])))
                ->from([self::TABLE])  //  . ' AS p'
                ->where(($pParams == []) ? '*' : 'id = :id')  //p.id
                ->orderby(['created_at'])->query;
        
        //->join(['dir'=>'L', 'tab'=>'categories','alia'=>'c', 'on'=>'p.category_id = c.id'])

        //  [title, body, author, category_id]        
        if ($operation == 'create')
            $query = (new Insert(self::TABLE))->set(array_keys($pSetMap))->query;

        if ($operation == 'update')
            $query = (new Update(
                ['Tab' => self::TABLE,'Set' => array_keys($pSetMap),'Cri' => 'id = :id']))->query; // ['name']

        if ($operation == 'delete')
            $query = (new Delete(['Tab' => self::TABLE,'Cri' => 'id = :id']))->query;

        //
        return $this->db->doPrepExecGetStmts($query, array_merge($pParams, $pSetMap));
    }
    
    //postFactory
    public static function postFactory() {
        return function ($db){
            return new PostManager($db, new Post());  //Entity
        };
    }
}

//
function Post_main(){
    global $db;
    print_r((PostManager::postFactory())($db)->update(['id'=> 1],['name'=>'DOM']));
}

?>


