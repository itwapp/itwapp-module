InterviewApp ZF2 module
=====================================

This module allows you to use the InterviewApp API from a ZF2 service.

## Installation ##

This is installable via [Composer](https://getcomposer.org/) as [assessfirst/itwapp-module](https://packagist.org/packages/assessfirst/itwapp-module).

## Usage ##

### Basic Usage ###

First, Copy the itwapp.local.php.dist in your application config and set the file with your own configuration.
Then, you can get the payline service with the following code :

```php
$this->getServiceLocator()->get('Itwapp\Service\Itwapp');
```

#### Get an interview ####

```php
$interview = $this->getServiceLocator()
    ->get('Itwapp\Service\Itwapp')
    ->getInterview($id)
;
```

#### Create an interview ####

```php
$interview = $this->getServiceLocator()
    ->get('Itwapp\Service\Itwapp')
    ->createInterview($name, array $questions)
;
```

#### Get an applicant ####

```php
$interview = $this->getServiceLocator()
    ->get('Itwapp\Service\Itwapp')
    ->getApplicant($id)
;
```

#### Create an applicant ####

```php
$interview = $this->getServiceLocator()
    ->get('Itwapp\Service\Itwapp')
    ->createApplicant($mail, $lang, $alert, $deadline, \Itwapp\DAO\Interview $interview)
;
```

### InterviewApp API informations ###
To see more informations about InterviewApp and the API, please [click here](http://api.itwapp.io/).