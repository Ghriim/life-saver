<?php

namespace App\Infrastructure\Repository\Traits;

use DateTimeImmutable;
use Doctrine\ORM\QueryBuilder;

trait AddCriteriaDateOfTheDayTrait
{
    public function addCriteriaDate(QueryBuilder $queryBuilder, DateTimeImmutable $date, string $alias): QueryBuilder
    {
        $dateStart = $date->setTime(0,0,0);
        $dateEnd = $date->setTime(23,59,59);


        return $queryBuilder->andWhere($alias.'.createDate >= :dateStart')
                             ->setParameter('dateStart', $dateStart)
                             ->andWhere($alias.'.createDate <= :dateEnd')
                             ->setParameter('dateEnd', $dateEnd);
    }
}
