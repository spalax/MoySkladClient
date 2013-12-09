Client for http://www.moysklad.ru/
===================

To setup library you have to had composer.phar.
You can download it using this command:
```
php -r "eval('?>'.file_get_contents('https://getcomposer.org/installer'));"
```
or you can follow the instructions on http://getcomposer.org/download/

Composer will install all required Zend libraries. 

After the composer has been downloaded, you should run it:
```
chmod a+x composer.phar && ./composer.phar install
```
or 
```
./composer.phar update
```

Simple usage examples you can found in demo/ folder.

If your project already includes Zend Framework 2, this module could be installed as Zend Framework 2 module.
You should only copy config/zf2clientmoysklad.global.php to your config/autoload and change commented line with your connection credentials.
