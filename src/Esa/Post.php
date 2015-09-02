<?php

namespace Esa;

class Post
{
	private $client;

	public function __construct (\Esa\Esa $client)
	{
		$this->client = $client;
	}

	public function get ($postId=null)
	{
		$response;

		if ($postId == null) 
		{
			$response = $this->client->sendRequest('get', '/posts');
		} else 
		{
			$response = $this->client->sendRequest('get', '/posts/'.$postId);
		}
		return $response;
	}

}

