<?php
/**
 * Created by PhpStorm.
 * User: jnoack
 * Date: 14.06.18
 * Time: 17:32
 */

namespace App\Controller;

use App\Entity\Ingredient;
use App\Entity\Port;
use PiPHP\GPIO\GPIO;
use PiPHP\GPIO\Pin\PinInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PumpPortController extends Controller
{
    public function index()
    {
        // https://packagist.org/packages/piphp/gpio
        $ingredients = $this->getDoctrine()->getRepository(Ingredient::class);
        $ports = $this->getDoctrine()->getRepository(Port::class);
        return $this->render('assignIngredients.html.twig', [
            'ingredients' => $ingredients->findAll(),
            'ports' => $ports->findAll()
        ]);
    }

    public function create(Request $request)
    {
        $manager = $this->getDoctrine()->getManager();
        $ingredients = $this->getDoctrine()->getRepository(Ingredient::class);
        $pin = (int)$request->get('pin');
        $ingredient = (int)$request->get('ingredient');

        $port = new Port();
        $port->setPin($pin);
        $port->setIngredient($ingredients->find($ingredient));

        $manager->persist($port);
        $manager->flush();

        return $this->json([]);
    }

    public function remove(Request $request)
    {
        $manager = $this->getDoctrine()->getManager();
        $ports = $this->getDoctrine()->getRepository(Port::class);
        $id = (int)$request->get('id');

        $port = $ports->find($id);
        $port->setIngredient(new Ingredient());
        $manager->remove($port);
        $manager->flush();

        return $this->json([]);
    }
}