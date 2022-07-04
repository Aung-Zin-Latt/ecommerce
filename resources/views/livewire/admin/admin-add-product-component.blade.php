<div>
    <div class="container" style="padding: 30px 0">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                Add New Product
                            </div>

                            <div class="col-md-6">
                                <a href="{{ route('admin.products') }}" class="btn btn-success pull-right">All Products</a>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                        @if (Session::has('message'))
                            <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                        @endif
                        <form wire:submit.prevent='storeProduct()' action="" class="form-horizontal" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">Product Name</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder="Product Name" class="form-control input-md" wire:model='name' wire:keyup='autoGenerateSlug()'>
                                    @error('name') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="slug" class="col-md-4 control-label">Product Slug</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder="Product Name" class="form-control input-md" wire:model='slug'>
                                    @error('slug') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="short_description" class="col-md-4 control-label">Shortort Description</label>
                                <div class="col-md-4" wire:ignore>
                                    <textarea name="short_description" id="short_description" class="form-control" placeholder="Short Description" wire:model='short_description'></textarea>
                                    @error('short_description') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="description" class="col-md-4 control-label">Description</label>
                                <div class="col-md-4" wire:ignore>
                                    <textarea name="description" id="description" class="form-control" placeholder="Description" wire:model='description'></textarea>
                                    @error('description') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="regular_price" class="col-md-4 control-label">Regular Price</label>
                                <div class="col-md-4" wire:ignore>
                                    <input type="text" placeholder="Regular Price" class="form-control input-md" wire:model='regular_price'>
                                    @error('regular_price') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="sale_price" class="col-md-4 control-label">Sale Price</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder="Sale Price" class="form-control input-md" wire:model='sale_price'>
                                    @error('sale_price') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="sku" class="col-md-4 control-label">SKU</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder="SKU" class="form-control input-md" wire:model='SKU'>
                                    @error('SKU') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="stock" class="col-md-4 control-label">Stock</label>
                                <div class="col-md-4">
                                    <select class="form-control" wire:model='stock_status'>
                                        <option value="instock">Instock</option>
                                        <option value="outofstock">Out of Stock</option>
                                    </select>
                                    @error('stock_status') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="featured" class="col-md-4 control-label">Featured</label>
                                <div class="col-md-4">
                                    <select class="form-control" wire:model='featured'>
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="qty" class="col-md-4 control-label">Quantity</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder="Quantity" class="form-control input-md" wire:model='quantity'>
                                    @error('quantity') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="p_image" class="col-md-4 control-label">Product Image</label>
                                <div class="col-md-4">
                                    <input type="file" class="input-file" wire:model='image'>
                                    @if ($image)
                                        <img src="{{ $image->temporaryUrl() }}" width="120" />
                                    @endif
                                    @error('image') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>


                            {{-- Add Product Gallery --}}
                            <div class="form-group">
                                <label for="p_image" class="col-md-4 control-label">Product Gallery</label>
                                <div class="col-md-4">
                                    <input type="file" class="input-file" wire:model='images' multiple>
                                    @if ($images)
                                        @foreach ($images as $image)
                                            <img src="{{ $image->temporaryUrl() }}" width="120">
                                        @endforeach
                                    @endif
                                    @error('images') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>
                            {{-- Add Product Gallery --}}


                            <div class="form-group">
                                <label for="category" class="col-md-4 control-label">Category</label>
                                <div class="col-md-4">
                                    <select class="form-control" wire:model='category_id' wire:change='changeSubcategory()'>
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            {{-- Add Subcategory On Edit and Add Product Page --}}
                            <div class="form-group">
                                <label for="scategory" class="col-md-4 control-label">Sub Category</label>
                                <div class="col-md-4">
                                    <select class="form-control" wire:model='scategory_id'>
                                        <option value="0">Select Category</option>
                                        @foreach ($scategories as $scategory)
                                            <option value="{{ $scategory->id }}">{{ $scategory->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('scategory_id') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            {{-- Add Attribute Option on Add New Product Page --}}
                            <div class="form-group">
                                <label for="pattribute" class="col-md-4 control-label">Product Attributes</label>
                                <div class="col-md-3">
                                    <select class="form-control" wire:model='attr'>
                                        <option value="0">Select Attribute</option>
                                        @foreach ($pattributes as $pattribute)
                                            <option value="{{ $pattribute->id }}">{{ $pattribute->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{--Start Add Attribute Option on Add New Product Page --}}
                                <div class="col-md-1">
                                    <button wire:click.prevent='add()' type="button" class="btn btn-info">Add</button>
                                </div>
                            </div>
                            @foreach ($inputs as $key => $value)
                                <div class="form-group">
                                    <label for="add_attribute" class="col-md-4 control-label">{{ $pattributes->where('id', $attribute_arr[$key])->first()->name }}</label>
                                    <div class="col-md-3">
                                        <input type="text" placeholder="{{ $pattributes->where('id', $attribute_arr[$key])->first()->name }}" class="form-control input-md" wire:model='attribute_values.{{ $value }}'>
                                    </div>
                                    <div class="col-md-1">
                                        <button wire:click.prevent='remove({{ $key }})' type="button" class="btn btn-danger btn-sm">Remove</button>
                                    </div>
                                </div>
                            @endforeach
                            {{--End Add Attribute Option on Add New Product Page --}}


                            <div class="form-group">
                                <label for="p_image" class="col-md-4 control-label"></label>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(function(){
            // for short_description
            tinymce.init({
                selector: '#short_description',
                setup: function(editor){
                    editor.on('Change', function(e){
                        tinyMCE.triggerSave();
                        var sd_data = $('#short_description').val();
                        @this.set('short_description', sd_data);
                    });
                }
            });

            // for description
            tinymce.init({
                selector: '#description',
                setup: function(editor){
                    editor.on('Change', function(e){
                        tinyMCE.triggerSave();
                        var sd_data = $('#description').val();
                        @this.set('description', sd_data);
                    });
                }
            });
        });
    </script>
@endpush
