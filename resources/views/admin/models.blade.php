<!-- Domain Modal -->
<div class="modal fade" id="cityModal" role="dialog" aria-labelledby="categoryModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="post" id="add_edit_city_form" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="cityModalTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="city_name">City Name</label>
                        <input type="text" id="city_name" name="name" class="form-control" required />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Domain Modal -->
<div class="modal fade" id="domainModal" role="dialog" aria-labelledby="categoryModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="post" id="add_edit_domain_form" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="domainModalLongTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="domain_name">Domain Name</label>
                        <input type="text" id="domain_name" name="domain_name" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label for="urdu_domain_name" class="w-100 text-right">(اردو) ڈومین نام</label>
                        <input type="text" id="urdu_domain_name" name="urdu_domain_name" dir="rtl"
                            class="form-control" required />
                    </div>
                    @include('admin.city_partial')
                    <div class="w-100 d-flex" id="image_preview">
                        <div class="form-group w-50 d-flex justify-content-around align-items-center">
                            <div>
                                <label for="domain_image" class="btn btn-primary"> Chose Image to Upload </label>
                                <input type="file" name="image" id="domain_image" class="d-none" required
                                    onchange="previewImage(event, '#domain_image_preview')" />
                            </div>
                        </div>
                        <div class="form-group w-50 d-flex justify-content-around align-items-center">
                            <div>
                                <img class="d-none preview_image" id="domain_image_preview" src="#"
                                    style="max-width:150px; max-height: 100px" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Category Modal -->
<div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="categoryModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="add_edit_category_form" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryModalLongTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Domain</label>
                        <select name="domain" class="form-control" id="domains_dropdown">
                            @isset($domains)
                                @foreach($domains as $domain)
                                    <option value="{{ $domain->id }}">{{ $domain->name }}</option>
                                @endforeach
                            @endisset
                        </select>
                    </div>
                    @include('admin.city_partial')
                    <div class="form-group">
                        <label for="category__name">Category Name</label>
                        <input type="text" name="name" id="category__name" class="form-control" required />
                    </div>
                    <div class="w-100 d-flex" id="image_preview">
                        <div class="form-group w-50 d-flex justify-content-around align-items-center">
                            <div>
                                <label for="category-image" class="btn btn-primary"> Chose Image to Upload </label>
                                <input type="file" name="category_image" id="category-image" class="d-none" onchange="previewImage(event, '#category_image_preview')" />
                            </div>
                        </div>
                        <div class="form-group w-50 d-flex justify-content-around align-items-center">
                            <div>
                                <img class="d-none preview_image" id="category_image_preview" src="#" style="max-width:150px; max-height: 100px" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Sub Category  -->
<div class="modal fade" id="subcategoryModal" tabindex="-1" role="dialog"
    aria-labelledby="subcategoryModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form id="add_edit_sub_category_form" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="subcategoryModalLongTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Category</label>
                        <select name="category" class="form-control" disabled>
                            @isset($cat)
                            <option value="{{ $cat->id }}">
                                {{ $cat->name }}
                            </option>
                            @endisset
                        </select>
                    </div>
                    @include('admin.city_partial')
                    <div class="form-group">
                        <label for="title">Subcategory Name</label>
                        <input type="text" name="name" class="form-control" required />
                    </div>
                    <div class="w-100 d-flex" id="image_preview">
                        <div class="form-group w-50 d-flex justify-content-around align-items-center">
                            <div>
                                <label for="sub-category-image" class="btn btn-primary"> Chose Image to Upload </label>
                                <input type="file" name="sub_category_image" id="sub-category-image" class="d-none" onchange="previewImage(event, '#sub_category_image_preview')"  />
                            </div>
                        </div>
                        <div class="form-group w-50 d-flex justify-content-around align-items-center">
                            <div>
                                <img class="d-none preview_image" id="sub_category_image_preview" src="#" style="max-width:150px; max-height: 100px" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Banner Modal -->
<div class="modal fade" id="serviceModal" tabindex="-1" role="dialog" aria-labelledby="serviceModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="add_edit_service_form" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="serviceModalLongTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Subcategory</label>
                        <select name="Subcategory" class="form-control" disabled>
                            @isset($sub_category)
                            <option value="{{ $sub_category->id }}">
                                {{ $sub_category->name }}
                            </option>
                            @endisset
                        </select>
                    </div>
                    @include('admin.city_partial')
                    <div class="form-group">
                        <label for="title">Service Name</label>
                        <input type="text" name="name" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label for="title">Price Types</label>
                        <select name="pricetype" class="form-control">
                            <option value="fixed"> fixed </option>
                            <option value="variable"> variable </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="title">Service Price</label>
                        <input type="text" name="price" class="form-control" required />
                    </div>

                    <div class="form-group">
                        <label for="title">Service Old Price</label>
                        <input type="text" name="old_price" class="form-control" />
                    </div>


                    <div class="form-group">
                        <label for="title">Short Description</label>
                        <textarea class="form-control" placeholder="description" name="description"></textarea>
                    </div>
                    <div class="w-100 d-flex" id="image_preview">
                        <div class="form-group w-50 d-flex justify-content-around align-items-center">
                            <div>
                                <label for="service-image" class="btn btn-primary"> Chose Image to Upload </label>
                                <input type="file" name="service_image" id="service-image" class="d-none" onchange="previewImage(event, '#service_image_preview')" />
                            </div>
                        </div>
                        <div class="form-group w-50 d-flex justify-content-around align-items-center">
                            <div>
                                <img class="d-none preview_image" id="service_image_preview" src="#" style="max-width:150px; max-height: 100px" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Category Modal -->
<div class="modal fade" id="bannerModal" tabindex="-1" role="dialog" aria-labelledby="categoryModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="add_edit_banner_form" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="bannerModalTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Domain</label>
                        <select name="domain" class="form-control">
                            @isset($domains)
                                @foreach($domains as $domain)
                                    <option value="{{ $domain->id }}">{{ $domain->name }}</option>
                                @endforeach
                            @endisset
                        </select>
                    </div>
                    @include('admin.city_partial')
                    <div class="w-100 d-flex" id="image_preview">
                        <div class="form-group w-50 d-flex justify-content-around align-items-center">
                            <div>
                                <label for="banner-image" class="btn btn-primary"> Chose Image to Upload </label>
                                <input type="file" name="banner_image" id="banner-image" class="d-none" onchange="previewImage(event, '#banner_image_preview')" />
                            </div>
                        </div>
                        <div class="form-group w-50 d-flex justify-content-around align-items-center">
                            <div>
                                <img class="d-none preview_image" id="banner_image_preview" src="#" style="max-width:150px; max-height: 100px" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
