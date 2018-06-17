<?php
/**
 * Created by PhpStorm.
 * User: jnoack
 * Date: 14.06.18
 * Time: 17:32
 */

namespace App\Controller;

use App\Entity\Ingredient;
use PiPHP\GPIO\GPIO;
use PiPHP\GPIO\Pin\PinInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class IngredientsController extends Controller
{

    public function index()
    {
        // https://packagist.org/packages/piphp/gpio
        $entityManager = $this->getDoctrine()->getRepository(Ingredient::class);
        return $this->render('ingredients.html.twig', [
            "ingredients" => $entityManager->findAll()
        ]);
    }

    public function create(Request $request)
    {
        $ingredient = new Ingredient();
        $ingredient->setName($request->get('name'));
        $ingredient->setTime($request->get('time'));

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($ingredient);
        $manager->flush();
        return $this->json([]);
    }

    public function remove(Request $request)
    {
        $manager = $this->getDoctrine()->getManager();
        $entityManager = $this->getDoctrine()->getRepository(Ingredient::class);
        $ingredient = $entityManager->find($request->get('id'));
        if ($ingredient !== null) {
            $manager->remove($ingredient);
        }
        $manager->flush();
        return $this->json([]);
    }

    public function getIngredients(Request $request)
    {
        $query = $request->get('q');
        $entityManager = $this->getDoctrine()->getRepository(Ingredient::class);
        $result = $entityManager->findAll();
        $response = [];

        if (!empty($query)) {
            $result = array_filter($result, function(Ingredient $ingredient) use ($query) {
                if (strstr(strtolower($ingredient->getName()), strtolower($query))) {
                    return true;
                }
                return false;
            });
        }

        foreach ($result as $ingredient) {
            $response['results'][] = [
                'text' => $ingredient->getName(),
                'id' => $ingredient->getId(),
            ];
        }

        return $this->json($response);
    }

}