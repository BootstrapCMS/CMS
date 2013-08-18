<?php namespace GrahamCampbell\BootstrapCMS\Providers\Common;

trait TraitBaseProvider {

    public function create(array $input) {
        $model = $this->model;
        return $model::create($input);
    }

    public function findById($id, array $columns = array('*')) {
        $model = $this->model;
        return $model::find($id, $columns);
    }

    protected function goGet($name) {
        // if caching is enabled
        if (Config::get('cms.cache') === true) {
            // check if the cache needs regenerating
            if ($this->validCache($name)) {
                // if not, then pull from the cache
                $value = $this->getCache($name);
            } else {
                // if regeneration is needed, do the work
                $value = $this->sendGet($name);
                // add the value from the work to the cache
                $this->setCache($name, $value);
            }
        } else {
            // do the work because caching is disabled
            $value = $this->sendGet($name);
        }

        // spit out the value
        return $value;
    }

    protected function getCache($name) {
        // pull from model(s) from the cache
        return json_decode(Cache::section(md5($this->model))->get($name), true);
    }

    protected function setCache($name, $value) {
        // cache the model(s) until another event resets it
        return Cache::section(md5($this->model))->forever($name, json_encode($value));
    }

    protected function flushCache() {
        // actually purge the entire section
        return Cache::section(md5($this->model))->flush();
    }

    protected function purgeCache($name) {
        // actually purge the model cache
        return Cache::section(md5($this->model))->forget($name);
    }

    protected function validCache($name) {
        // check if the cache needs regenerating
        return Cache::section(md5($this->model))->has($name);
    }

    public function flush() {
        if (Config::get('cms.cache') === true) {
            return $this->flushCache();
        }
    }

    public function purge($name = 'index') {
        if (Config::get('cms.cache') === true) {
            return $this->purgeCache($name);
        }
    }

    public function refresh($name = 'index') {
        if (Config::get('cms.cache') === true) {
            return $this->setCache($name, $this->sendGet($name));
        }
    }
}
