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
                                    <h4 class="card-title" id="basic-layout-form"> اداره المستودع </h4>
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
                                        <form class="form" action="{{route('admin.product.storeStock')}}"
                                              method="POST"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" value="{{$product_id}} "name="product_id">



                                            <div class="form-body">

                                                <h4 class="form-section"><i class="ft-home"></i> بيانات القسم </h4>




                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1"> كود المنتج  </label>
                                                                    <input type="text" value="{{old('sku')}}" id="sku"
                                                                           class="form-control"
                                                                           placeholder="  "
                                                                           name="sku">
                                                                    @error("sku")
                                                                    <span class="text-danger"> {{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                        </div>


                                                <div class="row" >
                                                    <div style="width: 100%; "  class="col-md-6" >
                                                        <label for="projectinput1"> تتبع المستودع  </label>
                                                        <div  style="width: 100%; "  class="form-group mt-1">
                                                            <label for="projectinput1">
                                                            </label>

                                                            <select  style="width: 70%" type="text"
                                                                     class="select2 form-control"
                                                                     name="manage_stock" id="managestock" >
                                                                <optgroup  label="من فضلك اختر القسم">
                                                                    <option value="1">اتاحه التتبع</option>
                                                                    <option  value="0" selected>عدم اتاحه التتبع</option>


                                                                </optgroup>
                                                            </select>

                                                            @error("manage_stock")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror

                                                        </div>
                                                    </div>

                                                    <div class="col-md-4 " style="display: none" id="qntity">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> الكميه  </label>
                                                            <input type="text" id="qty"
                                                                   class="form-control "
                                                                   placeholder="  "
                                                                   value="{{old('qty')}}"
                                                                   name="qty">

                                                            @error("qty")
                                                            <span class="text-danger"> {{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div style="width: 100%; "   class="row "  >
                                                    <div style="width: 100%; "  class="col-6" >
                                                        <label for="projectinput1"> حاله المنتج  </label>
                                                        <div  style="width: 100%; "  class="form-group mt-1">
                                                            <label for="projectinput1">
                                                            </label>

                                                            <select  style="width: 60%" type="text"
                                                                     class="select2 form-control"
                                                                     name="in_stock" >
                                                                <optgroup  label="من فضلك اختر القسم">
                                                                    <option value="1">متاح</option>
                                                                    <option value="0">غير متتاح</option>


                                                                </optgroup>
                                                            </select>

                                                            @error("in_stock")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror

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

                </section>
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>



@endsection
@section('script')
    <script>
        $(document).on('change','#managestock',function (){
           if($(this).val()==1){
               $('#qntity').show();

           }
           else {
               $('#qntity').hide();
           }
        })




    </script>
@stop

