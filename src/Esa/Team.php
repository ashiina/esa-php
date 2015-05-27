<?php

namespace Esa;

class Team
{
	private $client;

	public function __construct (\Esa\Esa $client)
	{
		$this->client = $client;
	}

	public function get ()
	{
		$response = $this->client->sendRequest('get', '');
		return $response;
	}
}

