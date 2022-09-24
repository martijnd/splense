<?php

test('example', function () {
    $response = actingAs()->get('/');

    $response->assertStatus(200);
});
