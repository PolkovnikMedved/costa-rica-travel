<?php
/**
 * Created by IntelliJ IDEA.
 * User: sviktor
 * Date: 9/06/18
 * Time: 22:03
 */

namespace App\Controller;


use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller
{

    /**
     * @Route("/login", name="login", methods="GET|POST")
     *
     * @param Request $request
     * @param AuthenticationUtils $authenticationUtils
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request, AuthenticationUtils $authenticationUtils)
    {
        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }

    /**
     * @Route("/register", name="register", methods="GET|POST")
     *
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return Response
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder):Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $encodedPassword = $passwordEncoder->encodePassword($user, $user->getPassword());
            $user->setPassword($encodedPassword);

            $user->addRole("ROLE_USER");

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'The user has been created. Now he has to be activated by the administrator.');

            return $this->redirectToRoute('welcome');
        }

        return $this->render('security/register.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
}