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
    protected $sourceStoreId = '';

    /**
     * @var string
     */
    protected $sourceAgentId = '';

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

    /**
     * @return string
     */
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

    /**
     * @return string
     */
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

    /**
     * @return string
     */
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

    /**
     * @param string $sourceAgentId
     */
    public function setSourceAgentId($sourceAgentId)
    {
        $this->sourceAgentId = $sourceAgentId;
    }

    /**
     * @return string
     */
    public function getSourceAgentId()
    {
        return $this->sourceAgentId;
    }

    /**
     * @param string $sourceStoreId
     */
    public function setSourceStoreId($sourceStoreId)
    {
        $this->sourceStoreId = $sourceStoreId;
    }

    /**
     * @return string
     */
    public function getSourceStoreId()
    {
        return $this->sourceStoreId;
    }
}
