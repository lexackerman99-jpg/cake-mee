<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AdminProductController extends Controller
{
    public function index(Request $request): View
    {
        $validated = $request->validate([
            'search' => ['nullable', 'string', 'max:100'],
        ]);
        $search = $validated['search'] ?? null;

        $products = Product::query()
            ->when($search, fn ($query) => $query->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%");
            }))
            ->orderBy('category')
            ->orderBy('name')
            ->paginate(12)
            ->withQueryString();

        return view('admin.products.index', compact('products', 'search'));
    }

    public function create(): View
    {
        return view('admin.products.form', ['product' => new Product()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedProduct($request);
        $image = $data['image'] ?? null;
        unset($data['image']);

        if ($image) {
            $data['image'] = $this->storeImage($image);
        }

        Product::create($data);

        return redirect()->route('admin.products.index')->with('ok', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product): View
    {
        return view('admin.products.form', compact('product'));
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $data = $this->validatedProduct($request, true);
        $image = $data['image'] ?? null;
        $removeImage = (bool) ($data['remove_image'] ?? false);
        unset($data['image'], $data['remove_image']);

        if ($image) {
            $newImage = $this->storeImage($image);
            $this->deleteManagedImage($product->image);
            $data['image'] = $newImage;
        } elseif ($removeImage) {
            $this->deleteManagedImage($product->image);
            $data['image'] = null;
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('ok', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $this->deleteManagedImage($product->image);
        $product->delete();

        return redirect()->route('admin.products.index')->with('ok', 'Produk berhasil dihapus.');
    }

    private function validatedProduct(Request $request, bool $updating = false): array
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'size' => ['required', 'integer', 'min:1', 'max:150'],
            'price' => ['required', 'integer', 'min:1000', 'max:100000000'],
            'note' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        if ($updating) {
            $request->validate(['remove_image' => ['sometimes', 'boolean']]);
            $data['remove_image'] = $request->boolean('remove_image');
        }

        return $data;
    }

    private function storeImage(UploadedFile $image): string
    {
        $directory = public_path('images/produk');
        File::ensureDirectoryExists($directory);

        $filename = 'admin-'.Str::uuid().'.'.$image->extension();
        $image->move($directory, $filename);

        return $filename;
    }

    private function deleteManagedImage(?string $filename): void
    {
        if (! $filename || ! preg_match('/\Aadmin-[0-9a-f-]+\.(jpg|jpeg|png|webp)\z/i', $filename)) {
            return;
        }

        $path = public_path('images/produk/'.$filename);

        if (File::exists($path)) {
            File::delete($path);
        }
    }
}
