<?php

class EloquentPageRepository extends EloquentSlugRepository implements PageRepositoryInterface {

    public function __construct(Page $page) {
        $this->model = $page;
    }
}
