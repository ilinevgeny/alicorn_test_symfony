<?php

namespace App\Controller;
//use Doctrine\Tests\Common\Annotations\Fixtures\Controller;
use App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
//use Doctrine\Migrations\Configuration\EntityManager;
use App\Entity\Pizza;
use App\Entity\Ingredient;
use App\Entity\IngredientCollection;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManager;

class AlicornController extends AbstractController
{
    /**
     * @Route("/api/posts/{id}", methods={"GET","HEAD"})
     */
    public function index(ManagerRegistry $doctrine): Response
    {
        $pizzaCatalog = [];

        $pizzaObjects = $doctrine->getRepository(Pizza::class)->findAll();
        foreach ($pizzaObjects as $pizza)
            $pizzaCatalog[$pizza->getName()] = $this->getIngredientsCollection($doctrine, $pizza->getId());

       // print_r($pizzaCatalog);
        $str = '';
        foreach($pizzaCatalog as $pizzaName => $ingredients)
            {
                $str .= $pizzaName . ' --> ' . implode(', ', array_column($ingredients, 'name')) . '<br>';
            }
        $response = new Response();
        $response->setContent('<html><body>Start pizzas catalog <br>'. $str  . '</body></html>');
        return $response;
    }

    /**
     * @param int $pizzaId
     * @return array
     */
    private function getIngredientsCollection(ManagerRegistry $doctrine, int $pizzaId): array
    {
        $em = $doctrine->getManager();
        $query = $em->createQuery("SELECT i.name FROM App\Entity\Ingredient i 
                                        LEFT JOIN App\Entity\IngredientsCollection ic  
                                        WITH ic.ingredient_id = i.id
                                        WHERE  ic.pizza_id = :id")->setParameter('id', $pizzaId);

        return $query->getArrayResult();
    }
}