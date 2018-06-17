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

class PumpPortController extends Controller
{
    public function index()
    {
        // https://packagist.org/packages/piphp/gpio
        $entityManager = $this->getDoctrine()->getRepository(Ingredient::class);
        return $this->render('assignIngredients.html.twig', [
            'ingredients' => $entityManager->findAll()
        ]);
    }
}