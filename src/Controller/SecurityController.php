<?php
/**
 * Created by IntelliJ IDEA.
 * User: sviktor
 * Date: 9/06/18
 * Time: 22:03
 */

namespace App\Controller;


use App\Entity\User;
use App\Form\ChangePasswordType;
use App\Form\UserNoPasswordType;
use App\Form\UserType;
use App\Repository\UserRepository;
use App\Security\ChangePassword;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


class SecurityController extends Controller
{

    /**
     * @Route("/login", name="login", methods="GET|POST")
     *
     * @param AuthenticationUtils $authenticationUtils
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(AuthenticationUtils $authenticationUtils)
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
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $encodedPassword = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
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

    /**
     * @Route("/user/profile/{id}/show", name="show_profile", methods="GET")
     *
     * @param int $id
     * @param UserRepository $userRepository
     * @return Response
     */
    public function profileShow(int $id, UserRepository $userRepository):Response
    {
        $user = $userRepository->find($id);
        if(!$user){
            throw $this->createNotFoundException();
        }

        return $this->render('security/show-profile.html.twig', ['user' => $user]);
    }

    /**
     * @Route("/user/profile/{id}/edit", name="edit_profile", methods="GET|POST")
     *
     * @param int $id
     * @param UserRepository $userRepository
     * @param Request $request
     * @return Response
     */
    public function profileEdit(int $id, UserRepository $userRepository,Request $request):Response
    {
        $user = $userRepository->find($id);
        if(!$user){
            throw $this->createNotFoundException();
        }

        $form = $this->createForm(UserNoPasswordType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user->setLastModifiedAt(new \DateTime());

            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'The user has been updated');

            return $this->redirectToRoute('show_profile');
        }

        return $this->render('security/edit-profile.html.twig', ['form' => $form->createView(), 'user' => $user]);
    }

    /**
     * @Route("/user/all-users", name="all_users", methods="GET")
     *
     * @Security("has_role('ROLE_ADMIN')")
     *
     * @param UserRepository $userRepository
     * @return Response
     */
    public function getUsers(UserRepository $userRepository):Response
    {
        return $this->render('security/users.html.twig', ['users' => $userRepository->findAll()]);
    }

    /**
     * @Route("/user/set-active/{id}", name="activate_user", methods="GET")
     *
     * @Security("has_role('ROLE_ADMIN')")
     *
     * @param int $id
     * @param UserRepository $userRepository
     * @return Response
     */
    public function setActive(int $id, UserRepository $userRepository):Response
    {
        $user = $userRepository->find($id);
        if(!$user){
            throw $this->createNotFoundException();
        }

        if($user->getIsActive()){
            $user->setIsActive(false);
            $message = 'The user '.$user->getEmail().' has been disabled.';
        } else {
            $user->setIsActive(true);
            $message = 'The user '.$user->getEmail().' has been enabled.';
        }

        $this->getDoctrine()->getManager()->flush();

        $this->addFlash('success',$message);

        return $this->redirectToRoute('all_users');
    }

    /**
     * @Route("/user/change-password", name="profile_password_edit")
     *
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return Response
     */
    public function changeUserPassword(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $changePasswordModel = new ChangePassword();
        $form = $this->createForm(ChangePasswordType::class, $changePasswordModel);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $user = $this->getUser();

            $encodedPassword = $passwordEncoder->encodePassword($user, $changePasswordModel->getNewPassword());
            $user->setPassword($encodedPassword);

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('logout');
        }

        return $this->render('security/change_password.html.twig', ['form' => $form->createView()]);
    }

    /*
     * @Route("/user/set-admin", name="set_admin", methods="GET")
     *
     * @return Response
     */
    /*
    public function setAdmin()
    {
        $user = $this->getUser();

        $user->addRole('ROLE_ADMIN');

        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('welcome');
    }*/
}