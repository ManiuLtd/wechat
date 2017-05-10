<?php
namespace App\libs;
use \Exception;
use \Redis;
use Log;
class RedisLock
{   
    const EXPIRE = 5;
    protected $_lock = null;

    public function __construct()
    {
        $redis = new Redis();
        if(!$redis){
             Log::info('10005: redis初始化错误');
          
        }
        $redis->connect('127.0.0.1', 6379);
        $this->_lock = $redis;
    }

    //获取锁状态
    public function getLock($key, $timeout = self::EXPIRE)
    {
        $waitime = 20000;    // 1s = 1000000um
        $totalWaitime = 0;
        $time = $timeout * 1000000; //5秒

        // 0 < 1000000 &&   仅当缓存中不存在键时，add 命令才会向缓存中添加一个键值对
        while ($totalWaitime < $time && false == $this->_lock->set($key, 1, $timeout)) {
            usleep($waitime);  // usleep() 函数延迟代码执行若干微秒。
            $totalWaitime += $waitime;
        }
        if ($totalWaitime >= $time){
            throw new Exception('can not get lock for waiting ' . $timeout . 's.');
        }

    }



    //重置锁
    public function releaseLock($key)
    {
        $this->_lock->del($key);
    }
}



