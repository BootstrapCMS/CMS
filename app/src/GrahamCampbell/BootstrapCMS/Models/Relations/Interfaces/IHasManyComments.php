<?php namespace GrahamCampbell\BootstrapCMS\Models\Relations\Interfaces;

interface IHasManyComments {

    /**
     * Get the comment relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOneOrMany
     */
    public function comments();

    /**
     * Get the comment collection.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getComments();

    /**
     * Get the specified comment.
     *
     * @return \GrahamCampbell\BootstrapCMS\Models\Comment
     */
    public function findComment($id, $columns = array('*'));

    /**
     * Delete all comments.
     *
     * @return void
     */
    public function deleteComments();

}
