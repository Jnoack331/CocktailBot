<?php
/**
 * Created by PhpStorm.
 * User: jnoack
 * Date: 14.06.18
 * Time: 17:32
 */

namespace App\Controller;

use App\Entity\Cocktail;
use App\Entity\Ingredient;
use App\Entity\IngredientAmount;
use PiPHP\GPIO\GPIO;
use PiPHP\GPIO\Pin\PinInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CocktailsController extends Controller
{
    public function index()
    {
        // https://packagist.org/packages/piphp/gpio
        $cocktails = $this->getDoctrine()->getRepository(Cocktail::class)->findAll();
        $ingrediants = $this->getDoctrine()->getRepository(Ingredient::class)->findAll();

        return $this->render('cocktails.html.twig', [
            'cocktails' => $cocktails,
            'ingredients' => $ingrediants
        ]);
    }

    public function create(Request $request)
    {
        $ingredients = $request->get('ingredients');
        $cocktail = new Cocktail();
        $cocktail->setName($request->get('name'));
        $repository = $ingredientEntity = $this->getDoctrine()->getRepository(Ingredient::class);
        $manager = $ingredientEntity = $this->getDoctrine()->getManager();

        if (!is_array($ingredients)) {
            $ingredients = [$ingredients];
        }

        foreach ($ingredients as $ingredient) {
            $ingredientAmount = new IngredientAmount();
            $ingredientAmount->setIngredient($repository->find((int)$ingredient['ingredient']));
            $ingredientAmount->setAmount((int)$ingredient['amount']);
            $ingredientAmount->setCocktail($cocktail);
            $manager->persist($ingredientAmount);

            $cocktail->addIngredientAmount($ingredientAmount);
            $cocktail->addIngredient($repository->find((int)$ingredient['ingredient']));
        }

        $manager->persist($cocktail);
        $manager->flush();
        return $this->json([]);
    }
}