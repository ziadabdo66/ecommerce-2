@extends('layouts.admin')

@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">الرئيسية </a>
                                </li>
                                <li class="breadcrumb-item"><a href=""> الاقسام الرئيسية </a>
                                </li>
                                <li class="breadcrumb-item active">إضافة قسم رئيسي
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form"> إضافة قسم رئيسي </h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                @include('dashboard.includes.alerts.success')
                                @include('dashboard.includes.alerts.errors')
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form" action="{{route('admin.product.store')}}"
                                              method="POST"
                                              enctype="multipart/form-data">
                                            @csrf



                                            <div class="form-body">

                                                <h4 class="form-section"><i class="ft-home"></i> بيانات القسم </h4>




                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1"> اسم المنتج  </label>
                                                                    <input type="text" value="{{old('name')}}" id="name"
                                                                           class="form-control"
                                                                           placeholder="  "
                                                                           name="name">
                                                                    @error("name")
                                                                    <span class="text-danger"> {{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>


                                                            <div class="col-md-6 ">
                                                                <div class="form-group">
                                                                    <label for="projectinput1"> الاسم بالرابط  </label>
                                                                    <input type="text" id="abbr"
                                                                           class="form-control"
                                                                           placeholder="  "
                                                                           value="{{old('slug')}}"
                                                                           name="slug">

                                                                    @error("slug")
                                                                    <span class="text-danger"> {{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> الوصف </label>
                                                            <input type="text" value="{{old('name')}}" id="description"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   name="description">
                                                            @error("name")
                                                            <span class="text-danger"> {{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>


                                                    <div class="col-md-6 ">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> الوصف المختصر  </label>
                                                            <input type="text" id="sh_description"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   value="{{old('slug')}}"
                                                                   name="short_description">

                                                            @error("slug")
                                                            <span class="text-danger"> {{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="width: 100%; "   class="row "  id="cats_list">
                                                    <div style="width: 100%; "  class="col-4" >
                                                        <div  style="width: 100%; "  class="form-group mt-1">
                                                            <label for="projectinput1">
                                                            </label>

                                                            <select  style="width: 60%" type="text"
                                                                     class="select2 form-control"
                                                                     name="categories[]" multiple>
                                                                <optgroup label="من فضلك اختر القسم">
                                                                    @if($categories && $categories->count()>0)
                                                                        @foreach($categories as $category)
                                                                            <option value="{{$category->id }}" style="font-size: large">{{$category->name }}
                                                                                </li></option>



                                                                        @endforeach
                                                                    @endif


                                                                </optgroup>
                                                            </select>

                                                            @error("categories")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror

                                                        </div>
                                                    </div>
                                                    <div style="width: 100%; "  class="col-4" >
                                                        <div  style="width: 100%; "  class="form-group mt-1">
                                                            <label for="projectinput1">
                                                            </label>

                                                            <select  style="width: 60%" type="text"
                                                                     class="select2 form-control"
                                                                     name="tags[]" multiple>
                                                                <optgroup label="من فضلك اختر العلامه الدلاليه">
                                                                    @if($tags && $tags->count()>0)
                                                                        @foreach($tags as $tag)
                                                                            <option value="{{$tag->id }}" style="font-size: large">{{$tag->name }}
                                                                                </li></option>



                                                                        @endforeach
                                                                    @endif


                                                                </optgroup>
                                                            </select>

                                                            @error("tags")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror

                                                        </div>
                                                    </div>
                                                    <div style="width: 100%; "  class="col-4" >
                                                        <div  style="width: 100%; "  class="form-group mt-1">
                                                            <label for="projectinput1">
                                                            </label>

                                                            <select  style="width: 60%" type="text"
                                                                     class="select2 form-control"
                                                                     name="brands" >
                                                                <optgroup label="من فضلك اختر القسم">
                                                                    @if($brands && $brands->count()>0)
                                                                        @foreach($brands as $brand)
                                                                            <option value="{{$brand->id }}" style="font-size: large">{{$brand->name }}
                                                                                </li></option>



                                                                        @endforeach
                                                                    @endif


                                                                </optgroup>
                                                            </select>

                                                            @error("brands")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror

                                                        </div>
                                                    </div>


                                                </div>




                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox" value="1"
                                                                   name="is_active"
                                                                   id="switcheryColor4"
                                                                   class="switchery" data-color="success"
                                                                   checked/>
                                                            <label for="switcheryColor4"
                                                                   class="card-title ml-1">الحالة   </label>

                                                            @error("is_active")
                                                            <span class="text-danger"> </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>







</div>
                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1"
                                                        onclick="history.back();">
                                                    <i class="ft-x"></i> تراجع
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> حفظ
                                                </button>
                                            </div>

                                        </form>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>


@endsection

