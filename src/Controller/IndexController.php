<?php
/**
 * Created by PhpStorm.
 * User: jnoack
 * Date: 14.06.18
 * Time: 17:32
 */

namespace App\Controller;

use App\Entity\Cocktail;
use App\Entity\Port;
use PiPHP\GPIO\GPIO;
use PiPHP\GPIO\Pin\PinInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends Controller
{
    public function index()
    {
        // https://packagist.org/packages/piphp/gpio
        $cocktails = $this->getDoctrine()->getRepository(Cocktail::class)->findAll();

        return $this->render('index.html.twig', [
            'cocktails' => $cocktails
        ]);
    }

    public function trigger(Request $request)
    {
        $pinNumber = $request->get('pin');
        $gpio = new GPIO();
        $pin = $gpio->getOutputPin(intval($pinNumber));
        if ($request->get('on') === 'true') {
            $pin->setValue(PinInterface::VALUE_LOW);
        } else {
            $pin->setValue(PinInterface::VALUE_HIGH);
        }
    }

    public function make(Request $request)
    {
        $gpio = new GPIO();
        $cocktailRepo = $this->getDoctrine()->getRepository(Cocktail::class);
        $portRepo = $this->getDoctrine()->getRepository(Port::class);
        $ports = $portRepo->findAll();
        $id = (int) $request->get('id');


        $cocktail = $cocktailRepo->find($id);
        foreach ($cocktail->getIngredientAmount() as $ingredientValue) {
            /** @var Port $port */
            foreach ($ports as $port) {
                if ($ingredientValue->getIngredient() === $port->getIngredient()) {
                    $hwPort = $gpio->getOutputPin($port->getPin());
                    $hwPort->export();
                    $hwPort->setValue(PinInterface::VALUE_LOW);
                    sleep($ingredientValue->getIngredient()->getTime() * $ingredientValue->getAmount());
                    $hwPort->setValue(PinInterface::VALUE_HIGH);
                    $hwPort->unexport();
                }
            }
        }

    }
}