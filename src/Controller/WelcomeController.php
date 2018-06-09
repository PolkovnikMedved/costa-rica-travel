<?php
/**
 * Created by IntelliJ IDEA.
 * User: sviktor
 * Date: 9/06/18
 * Time: 20:31
 */

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/")
 */
class WelcomeController extends Controller
{
    /**
     * @Route("/", name="welcome")
     */
    public function index():Response
    {
        return $this->render('welcome.html.twig');
    }
}