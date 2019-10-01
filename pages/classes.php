<?php
class Tools{
   public static function connect(
       $host='localhost:3306',
       $user='root',
       $password='',
       $dbname='shop_db'
   ){
       $cs="mysql:host=$host;dbname=$dbname;charset=utf8";
       $option=[
           PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,//генерация исключений в этом же месте
           PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,
           PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES UTF8'
       ];
       try{
           $pdo=new PDO($cs, $user, $password, $option);
           return $pdo;
       }
       catch (PDOException $exception){
           echo $exception->getMessage();
           return false;
       }
   }

   public static function register($login,$password, $image_path){
       if($login==''||$password==''||$image_path==''){
           echo "<script>alert('Fill all required fields')</script>";
           return false;
       }

       $login=trim(htmlspecialchars($login));
       $password=trim(htmlspecialchars($password));
       $image_path=trim(htmlspecialchars($image_path));
       Tools::connect();
       $customer=new Customer($login, $password, $image_path);
       $err=$customer->intoDb();
       if($err){
           if($err==1062){
               echo "<script>alert($err)</script>";
           }
           return false;
       }
       return true;

   }
}

class Customer{
    protected $id;
    protected $login;
    protected $password;
    protected $role_id;
    protected $discount;
    protected $image_path;

    public function __construct($login,$password, $image_path, $id=0)
    {
        $this->login = $login;
        $this->password=$password;
        $this->image_path=$image_path;
        $this->id=0;
        $this->role_id=2;
    }
    public  function intoDb(){
        try{
            $pdo=Tools::connect();
            $ps=$pdo->prepare('insert into customers(login, password, role_id, discount, image_path) VALUES (:login, :password, :role_id, :discount, :image_path)');
            $array=['login'=>$this->login, 'password'=>$this->password, 'role_id'=>$this->role_id, 'discount'=>$this->discount,
                'image_path'=>$this->image_path];
            $ps->execute($array);
        }
        catch (PDOException $ex){
            $err=$ex->getMessage();
            if(substr($err,0,strpos($err,':'))=='SQLSTATE[23000]:Integrity constraint violation'){
                return 1062;
            }else{
                return $ex->getMessage();
            }
        }
    }
    public static function fromDb($id){
        try{
            $pdo=Tools::connect();
            $ps=$pdo->prepare("select * from customers where id=?");
            $ps->execute([$id]);
            $row=$ps->fetch();
            $customer=new Customer($row['login'], $row['password'], $row['image_path'], $row['id']);
            return $customer;
        }catch (PDOException $ex){
            echo $ex->getMessage();
            return false;
        }
    }
}

class Item{
    protected $id;
    protected $item_name;
    protected $category_id;
    protected $price_in;
    protected $price_sale;
    protected $info;
    protected $image_path;

    public function __construct($item_name, $category_id, $price_in, $price_sale, $info, $image_path, $id = 0)
    {
        $this->item_name = $item_name;
        $this->category_id = $category_id;
        $this->price_in = $price_in;
        $this->price_sale = $price_sale;
        $this->info = $info;
        $this->image_path = $image_path;
        $this->id  = $id;
    }

    public function intoDb()
    {
        try {
            $pdo = Tools::connect();
            $ps = $pdo->prepare('insert into items (item_name, category_id, price_in, 
price_sale, info, image_path) values(:item_name, :category_id, :price_in, :price_sale, :info, :image_path)');
            $ps->execute(['item_name'=>$this->item_name, 'category_id'=>$this->category_id, 'price_in'=>$this->price_in, 'price_sale'=>$this->price_sale, 'info'=>$this->info, 'image_path'=>$this->image_path]);
        } catch (PDOException $ex) {
            return $ex->getMessage();
        }
    }

    public static function fromDb($id)
    {
        try {
            $pdo = Tools::connect();
            $ps = $pdo->prepare("select * from items where id=?");
            $ps->execute([$id]);
            $row = $ps->fetch();
            $item = new Item($row['item_name'], $row['category_id'], $row['price_in'], $row['price_sale'], $row['info'], $row['image_path'], $row['id']);
            return $item;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            return false;
        }
    }
}