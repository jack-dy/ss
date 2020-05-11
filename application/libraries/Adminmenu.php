<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Adminmenu {
    public function getmenu($routeUri=null){
        $array=explode('/', $routeUri);
        $group =strpos($array[1],'_')?strstr($array[1],'_',true):$array[1];
        $menu = $this->menu();
        //return $menu;
         $this->first($menu,$routeUri,$group);
        return $menu;
    }

    private function first(&$menus, $routeUri, $group)
    {
        foreach ($menus as $key => &$first) :
            // 一级菜单索引url
            $indexData = $this->getMenusIndexUrls($first, 1);
            // 权限验证
            // $first['index'] = $this->getAuthUrl($indexData);
            // if ($first['index'] === false) {
            //     unset($menus[$key]);
            //     continue;
            // }
            // 菜单聚焦
            $first['active'] = $key === $group;
            // 遍历：二级菜单
            if (isset($first['submenu'])) {
                $this->second($first['submenu'], $routeUri);
            }
        endforeach;
    }

    /**
     * 二级菜单
     * @param menus
     * @param $routeUri
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function second(&$menus, $routeUri)
    {
        foreach ($menus as $key => &$second) :
            // 二级菜单索引url
            $indexData = $this->getMenusIndexUrls($second, 2);
            // 权限验证
            // $second['index'] = $this->getAuthUrl($indexData);
            // if ($second['index'] === false) {
            //     unset($menus[$key]);
            //     continue;
            // }
            // 二级菜单所有uri
            $secondUris = array();
            // 遍历：三级菜单
            if (isset($second['submenu'])) {
                $this->third($second['submenu'], $routeUri, $secondUris);
            } else {
                if (isset($second['uris']))
                    $secondUris = array_merge($secondUris, $second['uris']);
                else
                    $secondUris[] = $second['index'];
            }
            // 二级菜单：active
            !isset($second['active']) && $second['active'] = in_array($routeUri, $secondUris);
        endforeach;
        // 删除空数组
        $menus = array_filter($menus);
    }

    /**
     * 三级菜单
     * @param $menus
     * @param $routeUri
     * @param $secondUris
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    private function third(&$menus, $routeUri, &$secondUris)
    {
        foreach ($menus as $key => &$third):
            // 三级菜单索引url
            $indexData = $this->getMenusIndexUrls($third, 3);
            // 权限验证
            // $third['index'] = $this->getAuthUrl($indexData);
            // if ($third['index'] === false) {
            //     unset($menus[$key]);
            //     continue;
            // }
            // 三级菜单所有uri
            $thirdUris = array();
            if (isset($third['uris'])) {
                $secondUris = array_merge($secondUris, $third['uris']);
                $thirdUris = array_merge($thirdUris, $third['uris']);
            } else {
                $secondUris[] = $third['index'];
                $thirdUris[] = $third['index'];
            }
            $third['active'] = in_array($routeUri, $thirdUris);
        endforeach;
    }

    /**
     * 获取指定菜单下的所有索引url
     * @param $menus
     * @param int $level
     * @return array|null
     */
    private function getMenusIndexUrls(&$menus, $level = 1)
    {
        // 三级
        if ($level === 3) {
            return isset($menus['index']) ? array($menus['index']) : null;
        }
        // 一级和二级
        if (!isset($menus['index']) && !isset($menus['submenu'])) {
            return null;
        }
        $data = array();
        if (isset($menus['index']) && !empty($menus['index'])) {
            $data[] = $menus['index'];
        }
        if (isset($menus['submenu']) && !empty($menus['submenu'])) {
            foreach ($menus['submenu'] as $submenu) {
                $submenuIndex = $this->getMenusIndexUrls($submenu, ++$level);
                !is_null($submenuIndex) && $data = array_merge($data, $submenuIndex);
            }
        }
        return $data;
    }

    private function menu(){
        $menu = array(
            'main'=>array(
                'name' => '首页',
                'index' => 'admin/main/index',
            ),
            'goods'=>array(
                'name' => '商品管理',
                'index' => 'admin/goods/index',
                'submenu' =>array(
                    array(
                        'name' => '商品列表',
                        'index' => 'admin/goods/index',
                        'uris' =>array(
                            'admin/goods/index',
                            'admin/goods/add',
                            'admin/goods/edit'
                        )
                    ),
                    array(
                        'name' => '商品分类',
                        'index' => 'admin/goods_category/index',
                        'uris' =>array(
                            'admin/goods_category/index',
                            'admin/goods_category/add',
                            'admin/goods_category/edit'
                        )
                    ),
                    array(
                        'name' =>'商品风格',
                        'index' => 'admin/goods_style/index',
                        'uris' =>array(
                            'admin/goods_style/index',
                            'admin/goods_style/add',
                            'admin/goods_style/edit'
                        )
                    )
                    
                    // array(
                    //     'name' => '商品/卡片列表',
                    //     'index' => 'admin/goods/list/index'
                    // )
                )

            ),
            'card'=>array(
                'name' => '卡片管理',
                'index' => 'admin/card/index',
                'submenu' =>array(
                    array(
                        'name' => '卡片列表',
                        'index' => 'admin/card/index',
                        'uris' =>array(
                            'admin/card/index',
                            'admin/card/add',
                            'admin/card/edit',
                        )
                    ),
                )
                
            ),
            'area' =>  array(
                'name' => '地区',
                'index' => 'admin/area/index',
                'submenu' =>  array(
                    array(
                        'name' => '国家列表',
                        'index' => 'admin/area/index',
                        'uris' =>  array(
                            'admin/area/index',
                            'admin/area/add',
                            'admin/area/edit'
                        ),
                    ),
                    array(
                        'name' => '大洲列表',
                        'index' => 'admin/area_continent/index',
                        'uris' =>  array(
                            'admin/area_continent/index',
                            'admin/area_continent/add',
                            'admin/area_continent/edit'
                        ),
                    ),
                    array(
                        'name' => '邮费地区分类',
                        'index' => 'admin/area_postage/index',
                        'uris' =>  array(
                            'admin/area_postage/index',
                            'admin/area_postage/add',
                            'admin/area_postage/edit',
                        ),
                    ),
                ),
            ), 
            'order' =>  array(
                'name' => '订单管理',
                'index' => 'admin/order/all_list',
                'submenu' =>  array(
                    array(
                        'name' => '全部订单',
                        'index' => 'admin/order/all_list',
                    ),
                    array(
                        'name' => '待付款',
                        'index' => 'admin/order/pay_list',
                    ),
                    array(
                        'name' => '待发货',
                        'index' => 'admin/order/delivery_list',
                    ),
                    array(
                        'name' => '已发货',
                        'index' => 'admin/order/send_list',
                    ),
                    // array(
                    //     'name' => '已完成',
                    //     'index' => 'admin/order/complete_list',
        
                    // ),
                    array(
                        'name' => '已取消',
                        'index' => 'admin/order/cancel_list',
                    )
                    
                    
                )
            ),
        );
        // $menu = array(
        //     'main'=>array(
        //         'name' => '首页',
        //         'index' => 'admin/main/index',
        //     ),
        //     'goods'=>array(
        //         'name' => '商品管理',
        //         'index' => 'admin/goods/index',
        //         'submenu' =>array(
        //             array(
        //                 'name' => '商品列表',
        //                 'index' => 'admin/goods/index',
        //                 'uris' =>array(
        //                     'admin/goods/index',
        //                     'admin/goods/add',
        //                     'admin/goods/edit'
        //                 )
        //             ),
        //             array(
        //                 'name' => '商品分类',
        //                 'index' => 'admin/goods/category/index',
        //                 'uris' =>array(
        //                     'admin/goods/category/index',
        //                     'admin/goods/category/add',
        //                     'admin/goods/category/edit'
        //                 )
        //             ),
        //             array(
        //                 'name' => '卡片列表',
        //                 'index' => 'admin/goods/card/index',
        //                 'uris' =>array(
        //                     'admin/goods/card/index',
        //                     'admin/goods/card/add',
        //                     'admin/goods/card/edit',
        //                 )
        //             ),
        //             array(
        //                 'name' => '（商品/卡片）列表',
        //                 'index' => 'admin/goods/list/index'
        //             )
        //         )

        //     ),
        //     'area' =>  array(
        //         'name' => '地区',
        //         'index' => 'area/index',
        //         'submenu' =>  array(
        //             array(
        //                 'name' => '地区列表',
        //                 'index' => 'area/index',
        //                 'uris' =>  array(
        //                     'admin/area/index',
        //                     'admin/area/add',
        //                     'admin/area/edit'
        //                 ),
        //             ),
        //             array(
        //                 'name' => '地区邮费分类',
        //                 'index' => 'area/category/index',
        //                 'uris' =>  array(
        //                     'admin/area/category/index',
        //                     'admin/area/category/add',
        //                     'admin/area/category/edit',
        //                 ),
        //             ),
        //         ),
        //     ), 
        //     'order' =>  array(
        //         'name' => '订单管理',
        //         'index' => 'admin/order/delivery/list',
        //         'submenu' =>  array(
        //             array(
        //                 'name' => '待发货',
        //                 'index' => 'admin/order/delivery/list',
        //             ),
        //             array(
        //                 'name' => '已完成',
        //                 'index' => 'admin/order/complete/list',
        
        //             ),
        //             array(
        //                 'name' => '已取消',
        //                 'index' => 'admin/order/cancel/list',
        //             ),
        //             array(
        //                 'name' => '全部订单',
        //                 'index' => 'admin/order/all/list',
        //             ),
                    
        //         )
        //     ),
        // );
        return $menu;
    }
}
?>