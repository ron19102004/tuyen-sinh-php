<?php
class Response{
    /**
     * @var string message
     * @var bool status
     * @var mixed data
     */
    private $status,$data,$message;
    public function __construct($status,$data,$message){
        $this->status = $status;
        $this->data = $data;
        $this->message = $message;
    }
    public function toJson(){
        return json_encode([
            "status" => $this->status,
            "data" => $this->data,
            "message" => $this->message
        ]);
    }
}
abstract class Route
{
    public function redirect($path){
        header('Location: /src/views/pages/'.$path);
        exit;
    }
    /**
     * @return void
     */
    public function run()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $this->post_action(htmlspecialchars($_POST["method"]));
        } else {
            $this->get_action(htmlspecialchars($_GET["method"]));
        }
    }
    /**
     * @param string|null $method
     * @return void
     */
    public abstract function post_action($method);
     /**
     * @param string|null $method
     * @return void
     */
    public abstract function get_action($method);
}
