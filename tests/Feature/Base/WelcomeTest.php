<?php

it('returns a successful response', function () {
    $response = $this->get('/');

    $response->assertExactJson(["Welcome to my API !"]);
    $response->assertStatus(200);
});
