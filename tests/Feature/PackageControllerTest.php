<?php

namespace Tests\Feature\Admin\Api;

use App\Models\Package;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PackageControllerTest extends TestCase
{
    use DatabaseMigrations;
    use WithFaker;

    public function test_index()
    {
        Package::factory(3)->create();

        $response = $this->getJson('/api/admin/packages');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',

                        'price',
                        'features',
                        // Add other package properties you want to test
                    ],
                ],
            ]);
    }

    public function test_store()
    {
        $packageData = Package::factory()->raw();
        $packageData['features'] = [$this->faker->words(5, true)];

        $response = $this->postJson('/api/admin/packages', $packageData);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'id',

                    'price',
                    'features',
                    // Add other package properties you want to test
                ],
            ]);

        $this->assertDatabaseHas('packages', ['id' => $response['data']['id']]);
    }

    public function test_show()
    {
        $package = Package::factory()->create();

        $response = $this->getJson("/api/admin/packages/{$package->id}");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'price',
                    'features',
                    // Add other package properties you want to test
                ],
            ]);
    }

    public function test_update()
    {
        $package = Package::factory()->create();
        $updatedPackageData = Package::factory()->raw();
        $updatedPackageData['features'] = [$this->faker->words(5, true)];

        $response = $this->putJson("/api/admin/packages/{$package->id}", $updatedPackageData);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'price',
                    'features',
                    // Add other package properties you want to test
                ],
            ]);

        $this->assertDatabaseHas('packages', [
            'id' => $package->id,
            // Add other package properties you want to test
        ]);
    }

    public function test_destroy()
    {
        $package = Package::factory()->create();

        $response = $this->deleteJson("/api/admin/packages/{$package->id}");

        $response->assertStatus(200);

        $this->assertDatabaseMissing('packages', ['id' => $package->id]);
    }
}
