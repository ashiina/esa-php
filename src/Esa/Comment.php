<?php

namespace Esa;

class Comment 
{
	private $client;

	public function __construct (\Esa\Esa $client)
	{
		$this->client = $client;
	}

	public function get ($commentId=null)
	{

		if ($commentId == null) 
		{
			throw new \Exception("Invalid comment_id");
		}
		$response = $this->client->sendRequest('get', '/comments/'.$commentId);
		return $response;
	}

}

