<?php
/**
 * Created by PhpStorm.
 * User: jnoack
 * Date: 14.06.18
 * Time: 17:32
 */

namespace App\Controller;

use PiPHP\GPIO\GPIO;
use PiPHP\GPIO\Pin\PinInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends Controller
{
    public function index()
    {
        // https://packagist.org/packages/piphp/gpio
        return $this->render('index.html.twig');
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
}