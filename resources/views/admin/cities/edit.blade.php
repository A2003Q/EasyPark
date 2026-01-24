@extends('admin.layout')

@section('content')
<div class="admin-page">
    <div class="page-header">
        <h2 class="text-center mb-4">Edit City</h2>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger mb-4" style="background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 12px; border-radius: 8px;">
            <ul class="mb-0" style="padding-left: 20px; margin-bottom: 0;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card admin-card" style="max-width: 500px; margin: 0 auto; background: white; border-radius: 12px; box-shadow: 0 6px 15px rgba(0,0,0,0.1); padding: 30px;">
        <form method="POST" action="{{ route('admin.cities.update', $city) }}">
            @csrf
            @method('PUT')

            <div class="form-group mb-4">
                <label for="name" style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">City Name</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name', $city->name) }}"
                    required
                    style="width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem; transition: border-color 0.3s;"
                    onfocus="this.style.borderColor='#17a2b8'"
                    onblur="this.style.borderColor='#ddd'"
                >
            </div>

            <div class="form-actions text-end">
                <button type="submit" 
                        style="background: linear-gradient(180deg, #1f1f2e, #3a3a5e); color: white; border: none; padding: 10px 24px; border-radius: 8px; font-weight: 600; cursor: pointer; transition: 0.3s; box-shadow: 0 4px 10px rgba(0,0,0,0.2);">
                    Update City
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

