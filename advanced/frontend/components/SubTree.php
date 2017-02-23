<?php
namespace frontend\components;

use yii\helpers\Json;

final class SubTree
{
    public static function getSubTree($data = array(), $space=false,$pid = 0)
    {
        if (empty($data))
        {
            return array();
        }
        static $level = 0;
        $SubTree = array();
        foreach ($data as $node)
        {
            if ($node['pid'] == $pid)
            {
                $node['level']=$level;
                if ($level && $space) {
                    $node['name'] = str_repeat('------', 2*$level).'>'.$node['name'];
                }
                $SubTree[] = $node;
                    
                if (self::hasChild($node['id'], $data))
                {   
                    $level++;
                    $SubTree = array_merge($SubTree, self::getSubTree($data,$space ,$node['id']));
                    $level--;
                }
            }
        }
        return $SubTree;
    }

    /**
     * 检查是否有子分类
     *
     * @param integer $cid 当前分类的id
     * @param array $data 原始数据
     * @return boolean 是否有子分类
     */
    public static function hasChild($cid, $data)
    {
        $hasChild = false;
        foreach ($data as $node)
        {
            if ($node['pid'] == $cid)
            {
                $hasChild = true;
                break;
            }
        }
        return $hasChild;
    }

    public static function combiData($data){
        
    }
}