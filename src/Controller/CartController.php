<?php  

namespace App\Controller;

use App\Service\cart\CartItem;
use App\Repository\ProductRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{
    #[Route('/panier/ajouter/{id}', name: 'cart_add')]
    public function add(int $id, ProductRepository $productRepository,SessionInterface $session)
    {
        $product = $productRepository->find($id);

        if(!$product)
        {
            return $this->redirectToRoute("home");
        }

        $cart = $session->get('cart',[]);

        foreach($cart as $item)
        {
            if($item->getId() === $id)
            {
                $qtyActual = $item->getQty();
                $newQty = $qtyActual + 1;

                $item->setQty($newQty);

                $session->set('cart', $cart);

                $this->addFlash("success", "Le produit a bien été ajouté au panier");
            }
        }

        $cartItem = new CartItem();
        $cartItem->setId($id);
        $cartItem->setQty(1);

        $cart[] = $cartItem;

        $session->set('cart',$cart);

        $this->addFlash("success", "Le produit a bien été ajouté au panier");

        return $this->redirectToRoute("boutique_product_detail",['id'=> $id]);
    }
}