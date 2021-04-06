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
                                        <form class="form" action="{{route('admin.product.storePrice')}}"
                                              method="POST"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" value="{{$product_id}} "name="product_id">



                                            <div class="form-body">

                                                <h4 class="form-section"><i class="ft-home"></i> بيانات القسم </h4>




                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1"> سعر المنتج  </label>
                                                                    <input type="text" value="{{$price->price}}" id="name"
                                                                           class="form-control"
                                                                           placeholder="  "
                                                                           name="price" >
                                                                    @error("price")
                                                                    <span class="text-danger"> {{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>


                                                            <div class="col-md-6 ">
                                                                <div class="form-group">
                                                                    <label for="projectinput1"> السعر الخاص  </label>
                                                                    <input type="text" id="abbr"
                                                                           class="form-control"
                                                                           placeholder="  "
                                                                           value="{{$price->special_price}}"
                                                                           name="special_price">

                                                                    @error("special_price")
                                                                    <span class="text-danger"> {{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                <div class="row">

                                                    <div style="width: 100%; "  class="col-4" >
                                                        <label for="projectinput1"> نوع السعر  </label>
                                                        <div  style="width: 100%; "  class="form-group mt-1">
                                                            <label for="projectinput1">
                                                            </label>

                                                            <select  style="width: 60%" type="text"
                                                                     class="select2 form-control"
                                                                     name="special_price_type" >
                                                                <optgroup  label="من فضلك اختر القسم">
                                                                   <option value="fixed"  @if($price->special_price_type=='fixed') selected @endif>fixed</option>
                                                                   <option value="percent" @if($price->special_price_type=='percent') selected @endif>percent</option>


                                                                </optgroup>
                                                            </select>

                                                            @error("special_price_type")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror

                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="width: 100%; "   class="row "  id="cats_list">
                                                    <div class="col-md-6 ">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> تاريخ البدايه </label>
                                                            <input type="date" id="special_price_start"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   value="{{$price->special_price_start}}"
                                                                   name="special_price_start">

                                                            @error("special_price_start")
                                                            <span class="text-danger"> {{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 ">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> تاريخ النهايه  </label>
                                                            <input type="date" id="special_price_end"
                                                                   class="form-control"
                                                                   placeholder=" "
                                                                   value="{{$price->special_price_end}}"
                                                                   name="special_price_end">

                                                            @error("special_price_end")
                                                            <span class="text-danger"> {{$message}}</span>
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

