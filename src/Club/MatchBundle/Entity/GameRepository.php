<?php

namespace Club\MatchBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * GameRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class GameRepository extends EntityRepository
{
  public function getTopLists($limit=10)
  {
    $games = $this->_em->getRepository('ClubMatchBundle:Game', 'g')->findAll();

    foreach ($games as $game) {
      $matches = $this->_em->createQueryBuilder()
        ->select('m')
        ->from('ClubMatchBundle:Match', 'm')
        ->where('m.game = :game')
        ->orderBy('m.id', 'DESC')
        ->setMaxResults($limit)
        ->setParameter('game', $game->getId())
        ->getQuery()
        ->getResult();

      $game->setMatches($matches);
    }

    return $games;
  }
}