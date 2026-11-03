<?php

test('redirects guests to the admin login page', function () {
    $this->get('/')
        ->assertRedirect('/admin/login');
});
