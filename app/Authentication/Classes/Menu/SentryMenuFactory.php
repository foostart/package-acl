<?php namespace Foostart\Acl\Authentication\Classes\Menu;
/**
 * Class SentryFactory
 *
 * @author Foostart foostart.com@gmail.com
 */

use Config;

class SentryMenuFactory
{
    public static $config_file = "acl_menu.list";

    public static function create($config_file = null)
    {
        // load the config file
        $config_file = $config_file ? $config_file : static::$config_file;
        $menu_items = Config::get($config_file);

        $items = [];
        foreach ($menu_items as $menu_item) {
            if (!empty($menu_item["name"])) $items[] = new SentryMenuItem($menu_item["link"], $menu_item["name"], $menu_item["permissions"], $menu_item["route"]);
        }

        return new MenuItemCollection($items);
    }
}
