@extends('layouts.metronic.app')
<!-- SUBHEADER::TITLE -->
@section('subheader-title'){{$title}}@endsection

<!-- SUBHEADER::ACTIONS -->
@section('subheader-actions')
<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
@foreach($breadcrumbs as $breadcrumb)
    @if($breadcrumb['active'])
    <li class="breadcrumb-item active">{{$breadcrumb['title']}}</li>
    @else
    <li class="breadcrumb-item">
        <a href="{{url($breadcrumb['link'])}}" class="text-muted">{{$breadcrumb['title']}}</a>
    </li>
    @endif
@endforeach
</ul>
@endsection

@section('content')
<section>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-content collapse show">
          <div class="card-body card-dashboard">
            @if($description)
            <p class="card-text">{{$description}}</p>
            @endif

            <form method="POST" action="{{url($segments[0])}}" enctype="multipart/form-data" >
              @method('POST')
              @csrf
              @foreach($forms as $fields)
              <div class="form-group row">
                @foreach($fields as $item)
                <div class="{{$item['class']}}">
                  @php ($field = $structures[$item['field']])
                  @component('forms.forms', ['field' => $field])@endcomponent
                </div>
                @endforeach
              </div>
              @endforeach
              <div class="btn-group">
                <a class="btn btn-round btn-light" href="{{url($segments[0])}}" role="button"><i class="fa fa-close"></i> Cancel</a>
                <button type="submit" class="btn btn-round btn-success"><i class="fa fa-check"></i> Create</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--/ Default ordering table -->
@endsection

@section('js')
<script>
$(document).ready(function() {

  @if (session('success'))
    toastr.success('{{session('success')}}', 'Success!');
  @endif

  @if (session('info'))
    toastr.info('{{session('info')}}', 'Info!');
  @endif

  @if (session('warning'))
    toastr.warning('{{session('warning')}}', 'Warning!');
  @endif

  @if (session('error'))
    toastr.error('{{session('error')}}', 'Error!');
  @endif
});
</script>
@endsection
