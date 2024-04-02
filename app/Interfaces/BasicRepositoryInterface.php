<?php

namespace App\Interfaces;

interface BasicRepositoryInterface
{
    public function all();
    public function create();
    public function update();
    public function delete();
    public function show();
}
