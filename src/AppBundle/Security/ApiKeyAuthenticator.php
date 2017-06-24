<?php

namespace AppBundle\Security;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Http\Authentication\SimplePreAuthenticatorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Authentication\Token\PreAuthenticatedToken;
use Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use AppBundle\Entity\User;

/**
 * Class ApiKeyAuthenticator
 * @package AppBundle\Security
 */
class ApiKeyAuthenticator implements SimplePreAuthenticatorInterface, AuthenticationFailureHandlerInterface
{

    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * ApiKeyAuthenticator constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * @param TokenInterface $token
     * @param UserProviderInterface $userProvider
     * @param $providerKey
     * @throws \Symfony\Component\Security\Core\Exception\AuthenticationException
     * @return PreAuthenticatedToken
     */
    public function authenticateToken(TokenInterface $token, UserProviderInterface $userProvider, $providerKey)
    {
        $apiKey = $token->getCredentials();

        /** @var $user User */
        $user = $this->getUserForApiKey($apiKey);

        /** @var Request $request */
        $request = Request::createFromGlobals();
        if(null == $user && Request::METHOD_GET == $request->getMethod()) {
            $user = $this->saveUser($apiKey);
        }

        if(null == $user) {
            throw new AuthenticationException(
                sprintf("API Key '%s' does not exist.", $apiKey)
            );
        }

        return new PreAuthenticatedToken(
            $user,
            $apiKey,
            $providerKey,
            ['IS_AUTHENTICATED_FULLY']
        );
    }

    /**
     * @param TokenInterface $token
     * @param $providerKey
     * @return bool
     */
    public function supportsToken(TokenInterface $token, $providerKey)
    {
        return $token instanceof PreAuthenticatedToken && $token->getProviderKey() === $providerKey;
    }

    public function createToken(Request $request, $providerKey)
    {
        $sessionKey = $request->headers->get('x-npo-session');

//        if (!$sessionKey) {
//            throw new BadCredentialsException('No x-npo-session key found');
//        }

        return new PreAuthenticatedToken(
            'anon.',
            $sessionKey,
            $providerKey
        );
    }

    /**
     * @param Request $request
     * @param AuthenticationException $exception
     * @return Response
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        $response = [
            'statusCode' => Response::HTTP_UNAUTHORIZED,
            'error'      => [
                'message' => $exception->getMessage()
            ]
        ];

        $jsonResponse = new JsonResponse($response, Response::HTTP_UNAUTHORIZED);
        return $jsonResponse;
    }

    /**
     * @param $apiKey
     * @return User
     */
    private function getUserForApiKey($apiKey) {
        /** @var $userRep ObjectRepository */
        $userRep = $this->em->getRepository(User::_CLASS);

        /** @var $user User */
        $user = $userRep->findOneBy(['userToken' => $apiKey]);

        return $user;
    }

    private function saveUser($apiKey)
    {
        $user = new User();
        $user->setUserToken($apiKey);
        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }
}