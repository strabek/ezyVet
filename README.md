# ezyVet

Test.

Assumptions:

1. I treat products array index as product index - in real life scenario each product would come with its unique index

Notes:

Solution built with Symfony 3.4. To use please insta all dependencies first and set appropriate permissions as in documentation (https://symfony.com/doc/3.4/setup/file_permissions.html)

1. List of products and shoping cart are placed on the same page
2. To access the page got to / e.g. http://ezyvet.local/
3. Cart implemented as a Service
4. Solution bundle => AppBundle
5. Main Controller => AppBundle\Controller|DefaultController
6. Cart Service => AppBundle\Service\Cart
7. CartItem Model => AppBundle\Model\CartItem
