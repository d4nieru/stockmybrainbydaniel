<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Workspace;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;


class WorkspaceTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    use InteractsWithDatabase;
    
    /**
     * A basic feature test example.
     *
     * @return void
    */

    /** @test */
    public function workspace_can_be_created()
    {
        // Create a user
        $user = User::factory()->create();

        // Log the user in
        $this->actingAs($user);

        // Prepare the workspace data
        $workspaceData = [
            'workspace_name' => $this->faker->name,
            'workspace_cover' => UploadedFile::fake()->image('workspace_cover.jpg')
        ];

        // Submit the form to create the workspace
        $response = $this->post('/workspace', $workspaceData);

        // Check that the workspace was created successfully
        $response->assertStatus(302);
        $response->assertRedirect('/dashboard');

        $workspace = Workspace::first();

        $this->assertNotNull($workspace);
        $this->assertEquals($workspaceData['workspace_name'], $workspace->workspace_name);
        $this->assertNotNull($workspace->workspace_cover_name);
        $this->assertNotNull($workspace->workspace_cover_path);

        // Check that the workspace cover was saved correctly
        Storage::disk('public')->assertExists('/workspaceimgs/'.$workspace->workspace_cover_name);
    }

    /** @test */
    public function workspace_can_be_deleted()
    {
        // Crée un utilisateur de test et connecte l'utilisateur
        $user = User::factory()->create();
        $this->actingAs($user);

        // Crée un espace de travail de test
        $workspace = factory(Workspace::class)->create(['workspace_name' => 'Workspace de test']);

        // Supprime l'espace de travail créé
        $response = $this->delete('/workspace/' . $workspace->id);

        // Vérifie si la réponse est une redirection
        $response->assertRedirect();

        // Vérifie si l'espace de travail a été supprimé de la base de données
        $this->assertDatabaseMissing('workspaces', ['id' => $workspace->id]);

        // Vérifie si le fichier de couverture de l'espace de travail a été supprimé
        $this->assertFalse(File::exists('workspaceimgs/' . $workspace->workspace_cover_name));
    }
}
