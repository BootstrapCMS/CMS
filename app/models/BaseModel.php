<?php

class BaseModel extends Ardent {

    protected $guarded = array('_token', 'id');

    /**
     * Get formatted creation date.
     *
     * @return string
     */
    public function createdAt() {
        return $this->_formatDate($this->created_at);
    }

    /**
     * Get formatted last modified date.
     *
     * @return string
     */
    public function updatedAt(){
        return $this->_formatDate($this->updated_at);
    }

    /**
     * Get the formatted date from input.
     *
     * @return string
     */
    protected function _formatDate($date_obj) {
        if (is_string($date_obj)) {
            $date_obj =  DateTime::createFromFormat('Y-m-d H:i:s', $date_obj);
        }
        return $date_obj->format('d/m/Y');
    }
}
