<?php

namespace Tests\Unit\Repositories;

use App\Models\Category;
use App\Repositories\CategoryRepository;
use Tests\TestCase;


class CategoryTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();


    }

    public function tearDown(): void
    {
        parent::tearDown();
    }

    /**
     * A basic unit test example.
     */
    public function testStoreCategory()
    {
        Category::query()->delete();
        // chuẩn bị dữ liệu test
        $categoryStub = [
            'name' => 'category 1',
            'description' => 'description 1',
        ];
        // khởi tạo lớp CategoryRepository
        $categoryRepository = new CategoryRepository();

        // Gọi hàm tạo
        $category = $categoryRepository->storeCategory($categoryStub);

        // Kiểm tra xem kết quả trả về có là thể hiện của lớp Category hay không
        $this->assertInstanceOf(Category::class, $category);

        // Kiểm tra data trả về
        $this->assertEquals($categoryStub['name'], $category->name);
        $this->assertEquals($categoryStub['description'], $category->description);

        // Kiểm tra dữ liệu có tồn tại trong cơ sở dữ liệu hay không
        $this->assertDatabaseHas('categories', $categoryStub);
    }

    public function testUpdateCategory()
    {
        Category::query()->delete();
        // chuẩn bị dữ liệu test
        $categoryStub = [
            'name' => 'category 1',
            'description' => 'description 123',
        ];

        // khởi tạo lớp CategoryRepository
        $categoryRepository = new CategoryRepository();

        // Tạo dữ liệu mẫu
        $category = Category::factory()->create();
        $newCategory = $categoryRepository->updateCategory($categoryStub, $category);

        // Kiểm tra dữ liệu trả về
        $this->assertTrue($newCategory);

        // Kiểm tra xem cơ sở dữ liệu đã được cập nhập hay chưa
        $this->assertDatabaseHas('categories', $categoryStub);
    }

    public function testShowCategory()
    {
        Category::query()->delete();
        // khởi tạo lớp CategoryRepository
        $categoryRepository = new CategoryRepository();

        $category = [
            'name' => 'category 3',
            'description' => 'description 3',
        ];

        // Lưu dữ liệu mẫu vào db
        $categoryStored = $categoryRepository->storeCategory($category);

        // Tìm kiếm dữ liệu vừa lưu
        $found = $categoryRepository->showCategory($categoryStored->id);

        // Kiểm tra xem dữ liệu trả về có phải là thể hiện của lớp Category hay không
        $this->assertInstanceOf(Category::class, $found);

        // Kiểm tra xem dữ liệu trả về có đúng với dữ liệu đã lưu hay không
        $this->assertEquals($found->name, $categoryStored->name);
        $this->assertEquals($found->description, $categoryStored->description);
    }
}
