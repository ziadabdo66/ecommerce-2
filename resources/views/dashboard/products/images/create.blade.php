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
                                        <form class="form" action="{{route('admin.product.storeImages_DB')}}"
                                              method="POST"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" value="{{$product_id}}" name="product_id">

                                            <div class="form-group">
                                                <label> صور المنتج </label>
                                                <div style="margin-top: 50px">

                                                    <table style="background-color: whitesmoke">
                                                          <tr>
                                                            @isset($images)
                                                                @foreach($images as $image)
                                                                    <td style="height: 100px;margin: auto">
                                                                        <img style="margin-right: 15px " height="150px" width="150px" src="{{$image->photo}}"><br>
                                                                        <a style="margin-right: 30px;margin-top: 9px;border-radius: 5px" href="{{route('admin.product.DeleteImages',$image -> id)}}"
                                                                           class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">حذف</a>

                                                                    </td>
                                                                @endforeach
                                                            @endisset
                                                          </tr>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="form-body">

                                                <h4 class="form-section"><i class="ft-home"></i> بيانات القسم </h4>
                                                <div class="form-group">
                                                    <div id="dpz-multiple-files" class="dropzone dropzone-area">
                                                        <div class="dz-message">يمكنك رفع اكثر من صوره هنا
                                                        </div>
                                                    </div>

                                                    <br><br><br><br>
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


@endsection
@section('script')

    <script>

var uploadedDocumentMap={}

Dropzone.options.dpzMultipleFiles= {
    paramName: "dzfile",
    maxFilesize: 5,
    clickable: true,
    addRemoveLinks: true,
    acceptedFiles: 'image/*',
    dictFallbackMessage: "المتصفح الخاص بكم لا يدعم السحب",
    dictInvalidFileType: 'لا يمكن رفع هذا النوع من الملفات',
    dictCancelUpload: "الغاء الرفع",
    dictCancelUploadConfirmation: "هل انت متاكد من الالغاء",
    dictRemoveFile: "حذف الصوره",
    dictMaxFilesExceeded: "لا يمكنك رفع اكثر من 5",
    headers: {
        'X-CSRF-TOKEN': "{{csrf_token()}}"

    },
    url: "{{route('admin.product.storeImages')}}",
    success: function (file, response) {
        $('form').append('<input type="hidden" name="document[]" value="' + response.name + '">')
        uploadedDocumentMap[file.name] = response.name

    },
    removedfile: function (file) {
        file.previewElement.remove();
        var name = ''
        if (typeof file.file_name !== 'undefined') {
            name = file.file_name
        } else {
            name = uploadedDocumentMap[file.name]
        }
        $('form').find('input[name="document[]"][value="' + name + '"]').remove()
    }
    ,
    init: function () {
        @if(isset($event) && $event->document)
        var files =
        {!! json_encode($event->document) !!}
            for (var i in files) {
            var file = files[i]
            this.options.addedfile.call(this, file)
            file.previewElement.classList.add('dz-complete')
            $('form').append('<input type="hidden" name="document[]" value="' + file.file_name + '">')
        }
        @endif
    }
}



    </script>
@stop

