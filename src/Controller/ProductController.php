<?php  

namespace App\Controller;

use App\Repository\ProductRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController 
{
    #[Route('boutique/categorie\{id}', name: 'boutique_product_show_by_category')]
    public function showProductByCategory(int $id, CategoryRepository $categoryRepository)
    {
        $category = $categoryRepository->find($id);

        if(!$category)
        {
            return $this->redirectToRoute("home");
        }

        return $this->render("customer/product/show_by_category.html.twig", [
            'category' => $category
        ]);
    }
    #[Route('boutique/produit\{id}', name: 'boutique_product_detail')]
    public function detailProduct(int $id, ProductRepository $productRepository)
    {
        //Je vais chercher un produit grâce à l'id que j'ai reçu dans les paramètres de l'url et avec l'aide du P
        //ProductRepository
        $product = $productRepository->find($id);

        //Si je ne le trouve pas en bdd 
        //Je redirige directement vers la page d'accueil
        if(!$product)
        {
            return $this->redirectToRoute("home");
        }

        //Je vais chercher la catégorie associée au produit
        $category = $product->getCategory();

        //Je récupère tous les produits associés à cette catégorie
        $productsCategory = $category->getProducts();

        //J'initialise un tableau vide mais j'ai pour but de la remplir avec 
        //4 produits à suggérer au clt
        $suggestedProducts = [];

        //Je boucle sur les produits associés à la catégorie
        //J'évite de mette dans le tableau le même produit que je présente actuellement
        foreach($productsCategory as $item)
        {
            if($item !== $product)
            {
                $suggestedProducts[] = $item;
            }
        }

        //J'utilise une fonction php pour envoyer seulement 4 produits de suggestion
        $suggestedProducts = array_slice($suggestedProducts,0,3);

        return $this->render("customer/product/detail_product.html.twig", [
            'product' => $product,
            'suggestedProducts' => $suggestedProducts
        ]);
    }
    
}