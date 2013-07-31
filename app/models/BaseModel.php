<?php

abstract class BaseModel extends Eloquent {

    protected $guarded = array('_token', '_method', 'id');

    /**
     * Get the formatted creation date.
     *
     * @return string
     */
    public function createdAt() {
        $value = $this->_formatDate($this->created_at);

        return $value;
    }

    /**
     * Get the formatted last modified date.
     *
     * @return string
     */
    public function updatedAt(){
        $value = $this->_formatDate($this->updated_at);

        return $value;
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

        $value = $date_obj->format('d/m/Y');

        return $value;
    }
}
