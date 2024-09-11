<?php
require($_SERVER['DOCUMENT_ROOT'] . "/src/utils/env.util.php");
/**
 * @param string $page_path
 * @return bool
 */
function isActiveLink($page_path)
{
    return $_SERVER['REQUEST_URI'] == '/src/views/pages/' . $page_path;
}
class Import
{
     /**
     * @param string $file_name
     * @return void
     */
    public static function migration($file_name)
    {
        require($_SERVER['DOCUMENT_ROOT'] . "/src/migrations/" . $file_name);
    }
    /**
     * @param array $files_name
     * @return void
     */
    public static function configs($files_name): void
    {
        foreach ($files_name as $file_name) {
            require($_SERVER['DOCUMENT_ROOT'] . "/src/configs/" . $file_name);
        }
    }
     /**
     * @param array $files_name
     * @return void
     */
    public static function interfaces($files_name)
    {
        foreach ($files_name as $file_name) {
            require($_SERVER['DOCUMENT_ROOT'] . "/src/interfaces/" . $file_name);
        }
    }
    /**
     * @param array $files_name
     * @return void
     */
    public static function controllers($files_name)
    {
        foreach ($files_name as $file_name) {
            require($_SERVER['DOCUMENT_ROOT'] . "/src/controllers/" . $file_name);
        }
    }

    /**
     * @param array $files_name
     * @return void
     */
    public static function utils($files_name)
    {
        foreach ($files_name as $file_name) {
            require($_SERVER['DOCUMENT_ROOT'] . "/src/utils/" . $file_name);
        }
    }

    /**
     * @param array $files_name
     * @return void
     */
    public static function entities($files_name)
    {
        foreach ($files_name as $file_name) {
            require($_SERVER['DOCUMENT_ROOT'] . "/src/entities/" . $file_name);
        }
    }
    /**
     * @param array $files_name
     * @return void
     */
    public static function repositories($files_name)
    {
        foreach ($files_name as $file_name) {
            require($_SERVER['DOCUMENT_ROOT'] . "/src/repositories/" . $file_name);
        }
    }
    /**
     * @param array $files_name
     * @return void
     */
    public static function middlewares($files_name)
    {
        foreach ($files_name as $file_name) {
            require($_SERVER['DOCUMENT_ROOT'] . "/src/middlewares/" . $file_name);
        }
    }
    /**
     * @param string $file_name
     * @return string
     */
    public static function route_path($file_name)
    {
        return Env::get("server") . "/src/routes/" . $file_name;
    }
    /**
     * Path lấy từ root folder
     * @param string $file_name
     * @return string
     */
    public static function view_layout_path($file_name)
    {
        return $_SERVER['DOCUMENT_ROOT']. "/src/views/layout/" . $file_name;
    }
     /**
     * Path lấy từ root folder
     * @param string $file_name
     * @return string
     */
    public static function view_assets_path($file_name)
    {
        return $_SERVER['DOCUMENT_ROOT']. "/src/views/assets/" . $file_name;
    }
    /**
     * @param string $file_name
     * @return string
     */
    public static function view_component_path($file_name)
    {
        return Env::get("server") . "/src/views/components/" . $file_name;
    }
    /**
     * @param string $file_name
     * @return string
     */
    public static function view_page_path($file_name)
    {
        return Env::get("server"). "/src/views/pages/" . $file_name;
    }
}
