<?php
/**
 * Vitex 一个基于php5.5开发的 快速开发restful API的微型框架
 * @version  0.2.0
 *
 * @package vitex
 *
 * @author  skipify <skipify@qq.com>
 * @copyright skipify
 * @license MIT
 */
/**
 * 缓存类的session管理
 * 缓存方法需要支持  set  get  delete 三个方法
 */

namespace vitex\ext\sessionhandler;


use vitex\core\Exception;
use vitex\Vitex;

class CacheHandler extends SessionHandler implements \SessionHandlerInterface
{
    private $cache;
    public function __construct()
    {
        parent::__construct();
        $sessionHandler = $this->vitex->getConfig('session.cache.handler');

        if(!$sessionHandler){
            throw new Exception('您需要传递一个缓存连接的实例',Exception::CODE_PARAM_VALUE_ERROR);
        }
        $this->cache = $sessionHandler;
    }

    public function close()
    {
        return true;
    }

    public function destroy($session_id)
    {
        return $this->cache->delete($session_id);
    }

    public function gc($maxlifetime)
    {
        return true;
    }

    public function open($save_path, $name)
    {
        return true;
    }

    public function read($session_id)
    {
        return $this->cache->get($session_id);
    }

    public function write($session_id, $session_data)
    {
        $this->cache->set($session_id,$session_data);
    }
}