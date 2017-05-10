<?php   

	function redisWengAway()
	{
		$newsid = rand(100,1000);
        
       
		$msg = new StdClass();	       
		$broker = 'tcp://182.92.122.165:61613';  #使用tcp连接
		$queue = '/queue/redis'; #主站队列的名称

	    $msg->message = 'redis服务器挂了';
	    
		$stomp = new Stomp($broker,'xiaomo');
	    
	 	$stomp->send($queue,json_encode($msg));
			
		unset($stomp);
	}

    
?>