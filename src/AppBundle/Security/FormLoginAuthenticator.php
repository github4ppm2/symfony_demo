<?php
namespace AppBundle\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;
use Symfony\Component\Security\Core\Security;

class FormLoginAuthenticator extends AbstractFormLoginAuthenticator
{
    private $router;
    private $encoder;

    public function __construct(RouterInterface $router, UserPasswordEncoderInterface $encoder)
    {
        $this->router = $router;
        $this->encoder = $encoder;
    }
    /**
     * Get user credentials by http request, posted from login form.
     * @return array
     */
    public function getCredentials(Request $request)
    {
        if ($request->getPathInfo() != '/login_check') {
          return;
        }

        $username = $request->request->get('_username');
        $request->getSession()->set(Security::LAST_USERNAME, $username);
        $password = $request->request->get('_password');

        return [
            'username' => $username,
            'password' => $password,
        ];
    }
    /**
     * Get user object by passed credentials.
     * @return object
     */
    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $username = $credentials['username'];

        return $userProvider->loadUserByUsername($username);
    }

    /**
     * Check user credentials.
     * @return true or BadCredentialsException
     */
    public function checkCredentials($credentials, UserInterface $user)
    {
        $plainPassword = $credentials['password'];
        if ($this->encoder->isPasswordValid($user, $plainPassword)) {
            return true;
        }

        throw new BadCredentialsException();
    }
    /**
     * Implement on successful authentication redirect.
     * @return string
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        $url = $this->router->generate('welcome');

        return new RedirectResponse($url);
    }
    /**
     * Implement on authentication failure redirect.
     * @return string
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
       $request->getSession()->set(Security::AUTHENTICATION_ERROR, $exception);

       $url = $this->router->generate('login');

       return new RedirectResponse($url);
    }
    /**
     * Get login URL.
     * @return string
     */
    protected function getLoginUrl()
    {
        return $this->router->generate('login');
    }
    /**
     * Get default successful authentication redirect URL.
     * @return string
     */
    protected function getDefaultSuccessRedirectUrl()
    {
        return $this->router->generate('welcome');
    }
    /**
     * Set remember me support for login.
     * @return boolean
     */
    public function supportsRememberMe()
    {
        return false;
    }
}
