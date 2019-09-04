<?php

namespace AppBundle\Model;

class CartItem
{
	private $name;
	private $price;

	public function getName()
	{
		return $this->name;
	}

	public function setName($name)
	{
		$this->name = $name;
		return $this;
	}

	public function getPrice()
	{
		return $this->price;
	}

	public function setPrice($price)
	{
		$this->price = $price;
		return $this;
	}
}
