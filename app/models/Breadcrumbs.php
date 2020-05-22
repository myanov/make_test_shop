<?php


namespace app\models;


use ishop\App;

class Breadcrumbs
{
    public static function getBreadcrumbs($cat_id, $title = '')
    {
        $breadcrumbs = '';
        $breadParts = self::getParts(App::$app->getProperty('cats'), $cat_id);
        $breadcrumbs .= '<li><a href="'. PATH .'">Главная</a></li>';
        if($breadParts) {
            foreach ($breadParts as $alias => $name) {
                $breadcrumbs .= '<li><a href="'.PATH.'/category/'.$alias.'">'.$name.'</a></li>';
            }
        }
        if($name) {
            $breadcrumbs .= '<li class="active">'.$title.'</li>';
        }
        return $breadcrumbs;
    }

    public static function getParts($cats, $id)
    {
        if(!$id) return false;
        $cat_parts = array();
        foreach ($cats as $k => $value) {
            if(isset($cats[$id])) {
                $cat_parts[$cats[$id]['alias']] = $cats[$id]['title'];
                $id = $cats[$id]['parent_id'];
            }
            else
                break;
        }
        return $cat_parts;
    }
}