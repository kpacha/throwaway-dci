# throwaway-dci [![Build Status](https://secure.travis-ci.org/kpacha/throwaway-dci.png?branch=master)](http://travis-ci.org/kpacha/throwaway-dci)
-
[Throw Away Framework](https://github.com/kpacha/throwaway) version implementing a pseudo-dci pattern based on the [Dion Moult's post] (http://thinkmoult.com/2012/08/24/a-dci-architecture-implementation-in-php/)

There are two use cases:

- Romeo And Juliet (from the [Dion Moult's post] (http://thinkmoult.com/2012/08/24/a-dci-architecture-implementation-in-php/))
- The well-known money transfer (with some from https://github.com/DCI/dci-examples/blob/master/moneytransfer/php/risto-valimaki/) 

Get the required vendors with composer:

    $ curl -sS https://getcomposer.org/installer | php
    $ php composer.phar update

###TO-DO

- remove the wrapper for the persistent entities
- decouple the Core from Doctrine ORM
- improve namespaces of the sample app
- log the transactions of the money transfer use case

[![Bitdeli Badge](https://d2weczhvl823v0.cloudfront.net/kpacha/throwaway-dci/trend.png)](https://bitdeli.com/free "Bitdeli Badge")

