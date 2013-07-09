<?php
namespace Zf2ClientMoysklad\Options;

use Zend\Stdlib\AbstractOptions;

class ModuleOptions extends AbstractOptions
    implements ModuleOptionsInterface
{
    /**
     * @var string
     */
    protected $apiUrl = '';

    /**
     * @var string
     */
    protected $userName = '';

    /**
     * @var string
     */
    protected $password = '';

    /**
     * @var string
     */
    protected $defaultEntityNamespace = 'Zf2ClientMoysklad';


    /**
     * @param string $defaultEntityNamespace
     */
    public function setDefaultEntityNamespace($defaultEntityNamespace)
    {
        $this->defaultEntityNamespace = $defaultEntityNamespace;
    }

    /**
     * @return string
     */
    public function getDefaultEntityNamespace()
    {
        return $this->defaultEntityNamespace;
    }

    public function getApiUrl()
    {
        return $this->apiUrl;
    }

    /**
     * @param string $apiUrl
     */
    public function setApiUrl($apiUrl)
    {
        $this->apiUrl = $apiUrl;
    }

    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @param string $userName
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

}
