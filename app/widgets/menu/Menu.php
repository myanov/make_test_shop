<?php


namespace app\widgets\menu;


use ishop\App;
use ishop\Cache;

class Menu
{
    protected $data;
    protected $tree = [];
    protected $menuHtml;
    protected $tpl;
    protected $class = '';
    protected $container = 'ul';
    protected $table = 'category';
    protected $cacheTime = 3600;
    protected $cacheKey = 'ishop_menu';
    protected $attrs = [];
    protected $prepend = '';

    public function __construct(array $options = [])
    {
        $this->tpl = __DIR__.'menu_tpl/menu.php';
        $this->getOptions($options);
        $this->run();
    }

    protected function getOptions($options)
    {
        foreach($options as $k => $v) {
            if(property_exists($this, $k)) {
                $this->$k = $v;
            }
        }
    }

    protected function run()
    {
        $this->menuHtml = Cache::get($this->cacheKey);
        if(!$this->menuHtml || !$this->cacheTime) {
            $this->data = $this->cacheTime ? Cache::get('cats') : '';
            if(!$this->data) {
                $this->data = \R::getAssoc("SELECT * FROM {$this->table}");
            }
            $this->tree = $this->getTree();
            $this->menuHtml = $this->getMenuHtml($this->tree);
            if($this->cacheTime) {
                Cache::set($this->cacheKey, $this->menuHtml);
            }
        }
        $this->output();
    }

    protected function output()
    {
        $attrs = '';
        foreach ($this->attrs as $k=>$v) {
            $attrs .= " $k='$v' ";
        }
        echo "<{$this->container} class='{$this->class}' $attrs>";
        echo $this->menuHtml;
        echo "</{$this->container}>";
    }

    protected function getTree()
    {
        $tree = [];
        $data = $this->data;
        foreach($data as $id => &$node) {
            if(!$node["parent_id"]) {
                $tree[$id] = &$node;
            }
            else {
                $data[$node['parent_id']]['childrens'][$id] = &$node;
            }
        }
        return $tree;
    }

    protected function getMenuHtml($tree, $tab = '')
    {
        $html = "";
        foreach ($tree as $id => $node) {
            $html .= $this->catToTemplate($node, $tab, $id);
        }
        return $html;
    }

    protected function catToTemplate($category, $tab, $id)
    {
        ob_start();
        require $this->tpl;
        return ob_get_clean();
    }
}