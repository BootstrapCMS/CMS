<?php

class EloquentSlugRepository extends EloquentBaseRepository implements SlugRepositoryInterface {

    public function findBySlug($slug, $columns = array('*')) {
        return $this->model->where('slug', '=', $slug)->first($columns);
    }
}
