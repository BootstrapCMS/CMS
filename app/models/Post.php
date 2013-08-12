<?php

class Post extends BaseModel implements ITitleModel, IBodyModel, IHasManyComments, IBelongsToUser {

    use TraitTitleModel, TraitBodyModel, TraitHasManyComments, TraitBelongsToUser;

    protected $table = 'posts';

    public $rules = array(
        'title'   => 'required',
        'summary'    => 'required',
        'body'    => 'required',
        'user_id' => 'required',
    );

    public $factory = array(
        'id'      => 1,
        'title'   => 'String',
        'summary'   => 'Summary of a post.',
        'body'    => 'The body of a post.',
        'user_id' => 1,
    );

    public function getSummary() {
        return $this->summary;
    }

    public function delete() {
        $this->deleteComments();

        return parent::delete();
    }
}
