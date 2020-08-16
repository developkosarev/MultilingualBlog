<?php

namespace App\Pagination;

use Doctrine\ORM\QueryBuilder as DoctrineQueryBuilder;
use Doctrine\ORM\Tools\Pagination\CountWalker;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrinePaginator;
use Symfony\Component\Serializer\Annotation\Groups;

class Paginator
{
    private const PAGE_SIZE = 25;
    private $queryBuilder;
    private $currentPage;
    private $pageSize;
    private $results;
    private $totalCount;

    public function __construct(DoctrineQueryBuilder $queryBuilder, int $pageSize = self::PAGE_SIZE)
    {
        $this->queryBuilder = $queryBuilder;
        $this->pageSize = $pageSize;
    }

    public function paginate(int $page = 1): self
    {
        $this->currentPage = max(1, $page);
        $firstResult = ($this->currentPage - 1) * $this->pageSize;

        $query = $this->queryBuilder
            ->setFirstResult($firstResult)
            ->setMaxResults($this->pageSize)
            ->getQuery();

        if (0 === \count($this->queryBuilder->getDQLPart('join'))) {
            $query->setHint(CountWalker::HINT_DISTINCT, false);
        }

        $paginator = new DoctrinePaginator($query, true);

        $useOutputWalkers = \count($this->queryBuilder->getDQLPart('having') ?: []) > 0;
        $paginator->setUseOutputWalkers($useOutputWalkers);

        $this->results = $paginator->getIterator();
        $this->totalCount = $paginator->count();

        return $this;
    }

    /**
     * @Groups({"ref:default"})
     */
    public function getCurrentPage(): int
    {
        return $this->currentPage;
    }

    /**
     * @Groups({"ref:default"})
     */
    public function getLastPage(): int
    {
        return (int) ceil($this->totalCount / $this->pageSize);
    }

    /**
     * @Groups({"ref:default"})
     */
    public function getPageSize(): int
    {
        return $this->pageSize;
    }

    public function hasPreviousPage(): bool
    {
        return $this->currentPage > 1;
    }

    public function getPreviousPage(): int
    {
        return max(1, $this->currentPage - 1);
    }

    public function hasNextPage(): bool
    {
        return $this->currentPage < $this->getLastPage();
    }

    public function getNextPage(): int
    {
        return min($this->getLastPage(), $this->currentPage + 1);
    }

    public function hasToPaginate(): bool
    {
        return $this->totalCount > $this->pageSize;
    }

    /**
     * @Groups({"ref:default"})
     */
    public function getTotalCount(): int
    {
        return $this->totalCount;
    }

    /**
     * @Groups({"ref:default"})
     */
    public function getResults(): \Traversable
    {
        return $this->results;
    }
}
