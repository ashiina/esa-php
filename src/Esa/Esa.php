<?php

namespace Esa;

use Guzzle\Service\Client as GuzzleClient;
use Guzzle\Common\Event as GuzzleEvent;

class Esa
{
	private $client;
	private $allowedResources;
	private $teamName;

	/*
	resource objects
	 */
	private $team; 
	private $post; 
	private $comment; 

	public function __construct ($accessToken, $teamName)
	{
		$this->teamName = $teamName;
		$this->allowedResources = array(
			'team', 'post', 'comment'
		);

		$baseUrl = 'https://api.esa.io/v1/';
		$this->client = new GuzzleClient($baseUrl);
		$this->client->setDefaultOption('headers/Authorization', 'Bearer '.$accessToken);
		$this->client->setDefaultOption('headers/Content-Type', "application/json");
		$this->client->setDefaultOption('headers/Accept', "application/json");

		/* instantiate resources */
		$this->team = new Team($this);
		$this->post = new Post($this);
		$this->comment = new Comment($this);
	}

	public function sendRequest($method, $path)
	{
		$path = 'teams/'.$this->teamName.'/'.$path;
		$req = $this->client->createRequest($method, $path, array());
		try {
			$res = $req->send();
			return $res->json();
		} catch (\Guzzle\Common\Exception\RuntimeException $e) {
			echo $e->getMessage();
			throw new \Exception($e);
		}
	}

	function __get ($name) {
		if (in_array($name, $this->allowedResources)) {
			return $this->{$name};
		} else {
			throw new \Exception('Invalid property:'.__CLASS__."->$name");
		}
	}

	function __set ($name, $value) {
		throw new \Exception('Cannot set property:'.__CLASS__."->$name");
	}
}

