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

class CocktailsController extends Controller
{
    public function index()
    {
        // https://packagist.org/packages/piphp/gpio

        return $this->render('cocktails.html.twig', [
            'activePage' => 'cocktails'
        ]);
    }

    public function trigger(Request $request)
    {

    }
}