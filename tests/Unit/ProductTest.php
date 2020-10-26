<?php

namespace Tests\Unit;

use App\User;
use App\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_subscribed_user_can_register_a_product()
    {
        $user = factory(User::class)->create([
            'is_admin' => false,
            'is_subscribed' => true,
        ]);

        $product = factory(Product::class)->create();

        $this->assertTrue($user->can('register', $product));
    }

    /** @test */
    public function an_unsubscribed_user_cannot_register_a_product()
    {
        $user = factory(User::class)->create([
            'is_admin' => false,
            'is_subscribed' => false,
        ]);

        $product = factory(Product::class)->create();

        $this->assertFalse($user->can('register', $product));
    }

    /** @test */
    public function an_admin_user_can_create_a_product()
    {
        $user = factory(User::class)->create([
            'is_admin' => true,
            'is_subscribed' => false,
        ]);

        $this->assertTrue($user->can('create', Product::class));
    }

    /** @test */
    public function a_non_admin_user_cannot_create_a_product()
    {
        $user = factory(User::class)->create([
            'is_admin' => false,
            'is_subscribed' => false,
        ]);

        $this->assertfalse($user->can('create', Product::class));
    }
}
