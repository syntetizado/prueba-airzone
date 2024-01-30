<?php

it('returns not found response', function () {
    $response = $this->get('/random-route');

    $response->assertExactJson(["Route not found"]);
    $response->assertStatus(404);
});
