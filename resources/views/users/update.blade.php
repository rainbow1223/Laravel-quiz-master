@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">{{ __('Update User') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('/users') }}/{{ $user->id }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') !== null ? old('name') : $user->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') !== null ? old('email') : $user->email }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row" style="align-items: center;">
                            <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>

                            <div class="col-md-6">
                                <select name="role">
                                    <option value="1" {{ $user->roles[0]->id == 1 ? 'selected' : '' }}>Admin</option>
                                    <option value="2" {{ $user->roles[0]->id == 2 ? 'selected' : '' }}>Student</option>
                                </select>

                                @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row" style="align-items: center">
                            <label for="active" class="col-md-4 col-form-label text-md-right">{{ __('Active') }}</label>

                            <div class="col-md-1">
                                <input id="active" type="checkbox" class="form-control @error('active') is-invalid @enderror" name="active" value="active" autocomplete="active" style="height: 18px;" {{ $user->active == '1' ? 'checked' : '' }}>

                                @error('active')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <hr/>
                        <div class="row">
                            <h4 style="padding-left: 30px;">Approved Exams</h4>
                        </div>

                        <table width="100%" cellspacing="0" cellpadding="0" border="0" class="table table-striped">
                            <tbody>
                                @foreach($exam_list as $exam)
                                <tr>
                                    <td>{{ $exam->name }}</td>
                                    <td style="width: 20px;"><input id="exam_{{ $exam->id }}" type="checkbox" class="exam_checkbox form-control @error('exam_{{ $exam->id }}') is-invalid @enderror" name="exam_{{ $exam->id }}" value="{{ $exam->id }}" autocomplete="exam_{{ $exam->id }}" style="height: 18px;width: 18px;" {{ $exam->approved ? 'checked' : '' }} {{ $user->roles[0]->id == 1 ? 'checked' : '' }} {{ $user->roles[0]->id == 1 ? 'disabled' : '' }}></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <input type="text" id="approved_exams" name="approved_exams" value="{{ $user->approved_exams }}" hidden>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update User') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center" style="padding-top: 10px;">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">{{ __('Change Password') }}</div>

                @if(session()->has('error'))
                    <span class="alert alert-danger">
                        <strong>{{ session()->get('error') }}</strong>
                    </span>
                @endif
                @if(session()->has('success'))
                    <span class="alert alert-success">
                        <strong>{{ session()->get('success') }}</strong>
                    </span>
                @endif

                <div class="card-body">
                    <form method="POST" action="{{ route('change.password') }}">
                        @csrf

                        <input name="user_id" value="{{ $user->id }}" hidden>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="password" autofocus>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password_confirmation" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required autocomplete="password_confirmation" autofocus>

                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Change Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('.exam_checkbox').change(function() {
        result = '';
        for (let index = 0; index < $('.exam_checkbox').length; index++) {
            const element = $('.exam_checkbox').eq(index);
            if (element.is(':checked')) result += element.val() + '@';
        }

        $('#approved_exams').val(result);
    });
    $('select[name="role"]').change(function() {
        console.log($(this).val());
        if ($(this).val() == 1) {
            $('table input[type="checkbox"]').prop('checked', true);
            $('table input[type="checkbox"]').prop('disabled', true);
        } else {
            $('table input[type="checkbox"]').prop('disabled', false);
        }
    });
</script>
@endsection
