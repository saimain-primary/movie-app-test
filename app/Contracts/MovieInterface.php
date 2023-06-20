<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface MovieInterface
{
    public function all(Request $request);

    public function get($id);

    public function store(array $data);

    public function update($id, array $data);

    public function delete($id);
}
