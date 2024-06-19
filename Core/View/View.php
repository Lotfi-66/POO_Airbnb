<?php 

namespace Core\View;

class View
{
    public const PATH_VIEW = PATH_ROOT . 'views' . DS;
    public const PATH_PARTIALS = self::PATH_VIEW . '_templates' . DS;
    public string $title = 'airbnb';


    public function __construct(private string $name, private bool $is_complete = true )
    {

    }

    private function getRequirePath():string
    {
        $arr_name = explode('/', $this->name);
        $cat = $arr_name['0'];
        $name = $arr_name['1'];

        $name_prefix = $this->is_complete ? "" : "_";
        return self::PATH_VIEW . $cat . DS . $name_prefix . $name . ".html.php";
    }

    public function render(?array $view_data = [])
    {
        if(!empty($view_data)){
            extract($view_data);
        }
        
        ob_start();
        if($this->is_complete){
            require self::PATH_PARTIALS . '_header.html.php';
        }

        require_once $this->getRequirePath();

        if($this->is_complete){
            require self::PATH_PARTIALS . '_footer.html.php';
        }
        ob_end_flush();
    }
}