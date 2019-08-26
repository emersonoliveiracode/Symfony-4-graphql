<?php
/**
 * Created by Emerson Oliveira
 * Date: 26/08/2019
 * Time: 10:15
 */

namespace App\GraphQL\Resolver;

use Doctrine\ORM\EntityManager;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;


class ProductCollectionResolver implements ResolverInterface,  AliasedInterface {

    /**
     * @var EntityManager
     */
    private $em;

    public  function __construct(EntityManager $em)
    {

        $this->em = $em;
    }

    public function resolve(Argument $argument){
        $products = $this->em->getRepository('App:Product')
            ->findBy(
                ['price'=> $argument['price'], 'name'=> $argument['name']],
                [], $argument['limit'], 0);

        return ['products' => $products];
    }

    public static function getAliases(): array
    {

        return [
            'resolve' => 'ProductCollection'
        ];
    }
}