<?php


namespace SfDoctrineBundle\Repository;


use Doctrine\ORM\EntityRepository;
use SfDoctrineBundle\Entity\Genus;

class GenusNoteRepository extends EntityRepository
{
    public function findAllRecentNotesForGenius(Genus $genus)
    {
        return $this->createQueryBuilder('genus_note')
            ->andWhere('genus_note.genus = :genus')
            ->setParameter('genus', $genus)
            ->andWhere('genus_note.createdAt > :recentDate')
            ->setParameter('recentDate', new \DateTime('- 3 months'))
            ->getQuery()
            ->execute();
    }
}