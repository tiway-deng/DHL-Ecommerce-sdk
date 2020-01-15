<?php

namespace Tiway\DhlEcommerce\Core;

/**
 * Class ConfigManager
 * @package App\Packages\Ecommerce\Core
 */
class ConfigManager
{
    /**
     * @var
     */
    private $is_pro;

    private $host;

    /**
     * @var array
     */
    private $configs = [
        'sandbox' => [
            'clientId'        => 'LTEzMDQ3ODk4NA==',
            'password'        => 'MjAzMDI5MTU',
            'sold_to_account' => '5999999201',
            'pick_up_account' => '5999999201',
        ],

        'pro' => [
            'clientId'        => 'LTE2OTg3NTQ0MzM=',
            'password'        => 'MjAzMDI5MTU',
            'sold_to_account' => '5267469019',
            'pick_up_account' => '5352896',
        ],
    ];

    /**
     * @var
     */
    private static $instance;

    /**
     * ConfigManager constructor.
     */
    private function __construct()
    {
        $configFile = implode(DIRECTORY_SEPARATOR, [
                dirname(__FILE__),
                "..",
                "Config",
                "config.php",
            ]);
        if (file_exists($configFile)) {
            $configs = include_once $configFile;
            $this->env = $configs['env'];
            $this->configs = $configs[$this->env];
        }
    }

    /**
     * @Desc:
     *
     * @Auth: tiway
     * @Date: 2019/8/7
     * @return ConfigManager
     */
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * @Desc:
     *
     * @Auth: tiway
     * @Date: 2019/8/7
     * @param array $configs
     * @return $this
     */
    public function addConfigs($configs = array())
    {
        //修改配置
        $this->configs = $this->configs + $configs;
        return $this;
    }

    /**
     * @Desc:
     *
     * @Auth: tiway
     * @Date: 2019/8/7
     * @return array
     */
    public function getConfigs() {
        return $this->configs;
    }

    /**
     * @Desc:
     *
     * @Auth: tiway
     * @Date: 2019/8/8
     * @return mixed
     */
    public function getEnv() {
        return $this->env;
    }

    /**
     * @Desc:
     *
     * @Auth: tiway
     * @Date: 2019/8/7
     */
    public function __clone()
    {
        trigger_error('Clone is not allowed.', E_USER_ERROR);
    }

}