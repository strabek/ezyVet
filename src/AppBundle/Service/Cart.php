<?php

namespace AppBundle\Service;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use AppBundle\Model\CartItem;

class Cart
{
	private $session;

	public function __construct(SessionInterface $session)
	{
		$this->session = $session;
	}

	public function getItems()
	{
		return $this->session->get('cart_items') ? $this->session->get('cart_items') : [];
	}

	public function getTotal()
	{
		$cartTotal = 0.00;
		$itemsInCart = $this->getItems();

		foreach ($itemsInCart as $key => $item) {
			$cartTotal += $item["price"] * $item["quantity"];
		}
		
		return $cartTotal;
	}

	public function addItem(CartItem $item)
	{
		if (!$this->session->get('cart_items')) {
			$this->session->set('cart_items', []);
		}

		$itemsInCart = $this->getItems();

		if (!$this->checkIfInCart($item->getName())) {
			$itemToCart = [
				"price" => $item->getPrice(),
				"quantity" => 1,
			];
			
			$itemsInCart[$item->getName()] = $itemToCart;
		} else {
			$itemsInCart[$item->getName()]["quantity"] ++;
		}

		$this->session->set('cart_items', $itemsInCart);
		
		return $this;
	}

	public function removeItem($itemIndex)
	{
		if ($this->checkIfInCart($itemIndex)) {
			$itemsInCart = $this->getItems();

			if ($itemsInCart[$itemIndex]["quantity"] > 1) {
				$itemsInCart[$itemIndex]["quantity"] --;
			} else {
				unset($itemsInCart[$itemIndex]);
			}
			
			$this->session->set('cart_items', $itemsInCart);
		}
		
		return $this;
	}

	private function checkIfInCart($itemName)
	{
		$itemsInCart = $this->getItems();
		
		if (array_key_exists($itemName, $itemsInCart)) {
			return true;
		}
		
		return false;
	}
}
