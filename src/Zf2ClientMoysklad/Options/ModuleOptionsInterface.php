<?php
namespace Zf2ClientMoysklad\Options;

interface ModuleOptionsInterface
{
    public function getApiUrl();
    public function setApiUrl($apiUrl);

    public function getPassword();
    public function setPassword($password);

    public function getUserName();
    public function setUserName($userName);
}