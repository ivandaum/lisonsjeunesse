<?php
namespace Humanoid\Core\Utils;

class Pagination {
    public $page;
    public $pageNumber = 3;

    public function __construct($count, $max, $paged) {
        $this->paged = $paged;
        $this->maxPage = $max / $count;
        $this->count = $count;
        $this->pages = array();
        $this->baseUrl = preg_replace('/\/page\/[0-9]/', '', $_SERVER['REQUEST_URI']);

        if ($this->paged === 0) {
            $this->paged = 1;
        }

        if ($this->maxPage === 1) {
            return false;
        }

        $from = $this->paged - $this->pageNumber;
        $to = $this->paged + $this->pageNumber;

        for ($i = $from; $i < $this->paged; $i++) {
            if ($i > 0) {
                $this->pages[] = $i;
            }
        }

        $this->pages[] = $this->paged;

        for ($i = $this->paged+1; $i < $to; $i++) {
            if ($i < $this->maxPage+1) {
                $this->pages[] = $i;
            }
        }
    }
}