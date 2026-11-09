<?php

test('redirects guests to the MVC login page', function () {
    $this->get('/')
        ->assertRedirect('/login');
});
