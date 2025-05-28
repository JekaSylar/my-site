<?php
use App\Models\Category;
use App\Models\User;


//Index Category
test('guest cannot access admin categories index', function () {
    $response = $this->get(route('category.index'));

    $response->assertRedirect(route('login'));
});


test('admin can access categories index', function () {
    $admin = User::factory()->create([
        'is_admin' => 1,
    ]);

    $response = $this->actingAs($admin)->get(route('category.index'));

    $response->assertStatus(200);
});

test('non admin cannot access admin categories index', function () {
    $user = User::factory()->create([
        'is_admin' => 0,
    ]);

    $response = $this->actingAs($user)->get(route('category.index'));

    $response->assertStatus(403);
});

//Create Category

test('admin can access category create', function () {
    $admin = User::factory()->create([
        'is_admin' => 1,
    ]);

    $response = $this->actingAs($admin)->get(route('category.create'));

    $response->assertStatus(200);
});

test('non admin cannot access admin category create', function () {
    $user = User::factory()->create([
        'is_admin' => 0,
    ]);

    $response = $this->actingAs($user)->get(route('category.create'));

    $response->assertStatus(403);
});


//Store Category
test('admin can create category', function () {

    $admin = User::factory()->create([
        'is_admin' => 1,
    ]);


    $newCategoryData = [
        'name' => 'Category',
        'description' => 'description',
        'meta_description' => 'meta_description',
        'meta_keywords'=> 'meta_keywords'
    ];

    $response = $this->actingAs($admin)->post(route('category.store'), $newCategoryData);

    $response->assertRedirect(route('category.index'));

    $this->assertDatabaseHas('categories', [
        'name' => $newCategoryData['name'],
    ]);
});

test('category creation fails with missing required fields', function () {
    $admin = User::factory()->create([
        'is_admin' => true,
    ]);

    $response = $this->actingAs($admin)->post(route('category.store'), []);

    $response->assertSessionHasErrors(['name']);
});


test('non-admin cannot create a category', function () {
    $user = User::factory()->create([
        'is_admin' => false,
    ]);

    $newCategoryData = [
        'name' => 'Category',
        'description' => 'description',
        'meta_description' => 'meta_description',
        'meta_keywords'=> 'meta_keywords'
    ];

    $response = $this->actingAs($user)->post(route('category.store'), $newCategoryData);

    $response->assertForbidden();
});

test('guest cannot create a category', function () {

    $newCategoryData = [
        'name' => 'Category',
        'description' => 'description',
        'meta_description' => 'meta_description',
        'meta_keywords'=> 'meta_keywords'
    ];

    $response = $this->post(route('category.store'), $newCategoryData);

    $response->assertRedirect(route('login'));
});

//Edit Category
test('admin can access category edit', function () {
    $admin = User::factory()->create([
        'is_admin' => 1,
    ]);

    $categoryToEdit = Category::factory()->create();

    $response = $this->actingAs($admin)->get(route('category.edit', $categoryToEdit));

    $response->assertStatus(200);
});

test('non admin cannot access admin category edit', function () {
    $user = User::factory()->create([
        'is_admin' => 0,
    ]);

    $categoryToEdit = Category::factory()->create();

    $response = $this->actingAs($user)->get(route('category.edit', $categoryToEdit));

    $response->assertStatus(403);
});

//Update Category
test('admin can update category', function () {

    $admin = User::factory()->create([
        'is_admin' => 1,
    ]);


    $categoryToEdit = Category::factory()->create([
        'name' => 'Old Category',
        'description' => 'Old description',
        'meta_description' => 'Old meta_description',
        'meta_keywords' => 'Old meta_keywords'
    ]);

    $updatedData = [
        'name' => 'Category',
        'slug' => 'category',
        'description' => 'Description',
        'meta_description' => 'meta_description',
        'meta_keywords' => 'meta_keywords'
    ];

    $response = $this->actingAs($admin)->put(
        route('category.update', $categoryToEdit),
        $updatedData
    );

    $response->assertRedirect(route('category.index'));

    $this->assertDatabaseHas('categories', [
        'id' => $categoryToEdit->id,
    ]);
});


test('non-admin cannot update  category', function () {

    $no_admin = User::factory()->create([
        'is_admin' => false,
    ]);

    $categoryToEdit = Category::factory()->create([
        'name' => 'Old Category',
        'description' => 'Old description',
        'meta_description' => 'Old meta_description',
        'meta_keywords' => 'Old meta_keywords'
    ]);

    $updatedData = [
        'name' => 'Category',
        'slug' => 'category',
        'description' => 'Description',
        'meta_description' => 'meta_description',
        'meta_keywords' => 'meta_keywords'
    ];


    $response = $this->actingAs($no_admin)->put(
        route('category.update', $categoryToEdit),
        $updatedData
    );


    $response->assertStatus(403);
});

test('category update fails with missing required fields', function () {
    $admin = User::factory()->create([
        'is_admin' => true,
    ]);

    $categoryToEdit = Category::factory()->create();

    $response = $this->actingAs($admin)->put(route('category.update', $categoryToEdit), []);

    $response->assertSessionHasErrors(['name', 'slug']);
});

//Delete Category
test('admin can delete category', function () {

    $admin = User::factory()->create([
        'is_admin' => 1,
    ]);


    $categoryToDelete = Category::factory()->create([
        'name' => 'Delete Category',
    ]);

    $response = $this->actingAs($admin)->delete(
        route('category.destroy', $categoryToDelete),
    );

    $response->assertRedirect(route('category.index'));

    $this->assertDatabaseMissing('categories', [
        'id' => $categoryToDelete->id,
    ]);

});

test('no-admin can delete category', function () {

    $no_admin = User::factory()->create([
        'is_admin' => 0,
    ]);


    $categoryToDelete = Category::factory()->create([
        'name' => 'Delete Category',
    ]);

    $response = $this->actingAs($no_admin)->delete(
        route('category.destroy', $categoryToDelete),
    );

    $response->assertStatus(403);

});

//Search Category

test('admin can search category', function () {
    $admin = User::factory()->create(['is_admin' => true]);

    Category::factory()->create([
        'name' => 'Category',
        'description' => 'description',
        'meta_description' => 'meta_description',
        'meta_keywords' => 'meta_keywords'
    ]);

    $response = $this->actingAs($admin)->get(route('category.search', ['search' => 'Cat']));

    $response->assertStatus(200);
    $response->assertSee('Category');
});

test('non-admin cannot search category', function () {
    $user = User::factory()->create(['is_admin' => false]);

    $response = $this->actingAs($user)->get(route('category.search', ['search' => 'Cat']));

    $response->assertStatus(403);
});
