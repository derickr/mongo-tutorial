==============
Tutorial Setup
==============

To be able to do the exercises in this tutorial, you need to have the
following things set-up on your machine:

#. Composer
#. MongoDB 3.2 (or later)
#. PHP 7.0 (or later)
#. The MongoDB PHP extension 1.2 (or later)

It is expected that you know how to edit PHP files, and run them on the
command line. All exercises will revolve around writing command line scripts.

If you have questions related to any of the installation instructions below,
please email me at derick@mongodb.com, or find me (Derick) on IRC's Freenode
network.

Composer
========

Make sure you can call Composer through either just ``composer``, or by
calling ``php /path/to/composer.phar``. I would recommend that you
follow the instructions at https://getcomposer.org/download/ by running the
4 PHP commands, and then copy the installed ``composer.phar`` file to
``/usr/local/bin/composer``::

	sudo cp composer.phar /usr/local/bin/composer

Now verify whether Composer works by running::

	composer --version

MongoDB 3.2
===========

Find the appropriate file at https://www.mongodb.com/download-center and
download the recommended download. When you have selected a download package,
a link to install instructions appears underneath. 

For example, for Ubuntu 16.04, a link to
https://docs.mongodb.com/master/tutorial/install-mongodb-on-ubuntu/ appears.
Install the ``mongodb-org`` package.

After installation of the package, you should be able to start MongoDB on
Linux with ``sudo service mongod start``. You can verify that the server runs,
by running ``mongo local`` (the MongoDB Shell) and then running on its prompt
``show collections``. If you do **not** get a ``exception: connect failed``,
all is well.

PHP 7.0
=======

Please install the PHP **and** PHP development packages through your package
manager. Make sure that you do *not* have older PHP versions and headers of
PHP installed on your system. For Debian and Ubuntu, these are ``php``,
``php-dev``, and ``php-pear``. You will also need to install the OpenSSL
development package ``libssl-dev``.

To verify whether your installation worked, run the following commands::

	php --version
	pecl -V
	phpize -v

Running these command should output something like this (pay attention to the
version numbers)::

	PHP 7.0.13-dev (cli) (built: Oct 30 2016 14:53:59) ( NTS DEBUG )
	Copyright (c) 1997-2016 The PHP Group
	Zend Engine v3.0.0, Copyright (c) 1998-2016 Zend Technologies
		with Xdebug v2.6.0-dev, Copyright (c) 2002-2017, by Derick Rethans
		with Zend OPcache v7.0.13-dev, Copyright (c) 1999-2016, by Zend Technologies

	PEAR Version: 1.10.1
	PHP Version: 7.0.13-dev
	Zend Engine Version: 3.0.0
	Running on: Linux whisky 4.5.0-2-amd64 #1 SMP Debian 4.5.3-2 (2016-05-08) x86_64

	Configuring for:
	PHP Api Version:         20151012
	Zend Module Api No:      20151012
	Zend Extension Api No:   320151012

The MongoDB PHP extension
=========================

Now install the MongoDB PHP extension by running::

	pecl install mongodb

After installation, add ``extension=mongodb.so`` to your ``php.ini`` file (``php
--ini`` will tell you which file). If the "Scan for additional .ini
files in:" part of ``php --ini`` is not empty, you can also create a new file
``50-mongodb.ini`` with as contents ``extension=mongodb.so``.

Now verify that the extension loads, and works, and connects to MongoDB, by
running the following PHP script::

	<?php
	$a = new MongoDB\Driver\Manager("mongodb://localhost/");
	$a->executeCommand( 'demo', new MongoDB\Driver\Command( [ 'ping' => 1 ] ) );
	var_dump( $a->getServers()[0]->getHost() );
	?>

This should output ``string(9) "localhost"``. If you have that, you're ready
to go.
