<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Model\CartItem;

class DefaultController extends Controller
{
    private $products = [
        [ "name" => "Sledgehammer", "price" => 125.75 ],
        [ "name" => "Axe", "price" => 190.50 ],
        [ "name" => "Bandsaw", "price" => 562.131 ],
        [ "name" => "Chisel", "price" => 12.9 ],
        [ "name" => "Hacksaw", "price" => 18.45 ],
    ];
    
    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function indexAction()
    {
        $cart = $this->container->get('cart');

        return $this->render('default/index.html.twig', [
            'products' => $this->products,
            'cartItems' => $cart->getItems(),
            'cartTotal' => $cart->getTotal(),
        ]);
    }

    /**
     * @Route("/add/{productIndex}", name="add_to_cart", methods={"GET"})
     */
    public function addAction($productIndex)
    {
        $product = $this->products[$productIndex];

        $cart = $this->container->get('cart');

        $item = new CartItem();
        $item
            ->setName($product['name'])
            ->setPrice($product['price'])
        ;

        $cart->addItem($item);

        return $this->redirectToRoute('index');
    }

    /**
     * @Route("/remove/{itemIndex}", name="remove_from_cart", methods={"GET"})
     */
    public function removeAction($itemIndex)
    {
        $cart = $this->container->get('cart');

        $cart->removeItem($itemIndex);

        return $this->redirectToRoute('index');
    }
}
