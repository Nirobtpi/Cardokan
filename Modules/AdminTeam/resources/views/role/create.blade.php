@extends('layout.admin-app')
@section('title_text', 'Create Role')
@section('page_title', 'Create Role')
@section('content')

<section class="crancy-adashboard crancy-show">
    <div class="container container__bscreen">
        <div class="row">
            <div class="col-12">
                <div class="crancy-body">
                    <!-- Dashboard Inner -->
                    <div class="crancy-dsinner">
                        <form action="{{ route('adminteam.storeRole') }}" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col-12 mg-top-30">
                                    <!-- Product Card -->
                                    <div class="crancy-product-card">
                                        <div class="create_new_btn_inline_box">
                                            <h4 class="crancy-product-card__title">{{ __('Create Role') }}</h4>

                                            {{-- <a href="{{ route('admin.roles.index') }}" class="crancy-btn "><i
                                                class="fa fa-list"></i> {{ __('Role List') }}</a> --}}
                                        </div>


                                        <div class="row mg-top-30">

                                            <div class="col-12">
                                                <div class="crancy__item-form--group mt-2">
                                                    <label class="form-label">{{ __('Name') }} * </label>
                                                    <input class="form-control" type="text" name="name" id="name"
                                                        value="{{ old('name') }}">
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="crancy__item-form--group mt-2">
                                                    <label class="form-label">{{ __('Display Name') }} * </label>
                                                    <input class="form-control" type="text" name="display_name"
                                                        id="display_name" value="{{ old('display_name') }}">
                                                </div>
                                            </div>


                                            <div class="col-12">
                                                <div class="crancy__item-form--group mt-2">
                                                    <label class="form-label">{{ __('Description') }} *</label>

                                                    <textarea class="form-control crancy__item-textarea"
                                                        name="description"
                                                        id="description">{{ old('description') }}</textarea>
                                                </div>
                                            </div>

                                            <div class="col-12 mb-5">
                                                <div class="crancy__item-form--group mt-2">
                                                    <label class="form-label">{{ __('Status') }} </label>
                                                    <select class="form-control" name="status" id="status">
                                                        <option value="active"
                                                            {{ old('status') == 'active' ? 'selected' : '' }}>
                                                            {{ __('Active') }}</option>
                                                        <option value="inactive"
                                                            {{ old('status') == 'inactive' ? 'selected' : '' }}>
                                                            {{ __('Inactive') }}</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>


                                        <!-- Access Permission Section -->
                                        <div id="accessPermission" class="mb-4">
                                            <div class="card">
                                                <div class="card-header bg-light">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <h5 class="mb-0">{{ __('Access Permissions') }}</h5>
                                                        <div class="form-check">
                                                            <input type="checkbox" id="masterCheckbox"
                                                                class="form-check-input">
                                                            <label for="masterCheckbox"
                                                                class="form-check-label fw-bold">
                                                                {{ __('Select All Permissions') }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <ul class="list-unstyled mb-0" id="permissionGroups">
                                                        @foreach ($permissions as $group)
                                                        <li class="border rounded mb-3">
                                                            <!-- Permission Group Header -->
                                                            <div class="bg-light p-3 border-bottom">
                                                                <div class="form-check">
                                                                    <input type="checkbox"
                                                                        id="groupCheckbox{{ $group->id }}"
                                                                        name="permissions[groups][]"
                                                                        value="{{ $group->id }}"
                                                                        class="form-check-input group-checkbox"
                                                                        data-group="{{ $group->id }}">
                                                                    <label for="groupCheckbox{{ $group->id }}"
                                                                        class="form-check-label fw-bold">
                                                                        {{ $group->display_name }}
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <!-- Permission Group Children -->
                                                            <div class="p-3">
                                                                <div class="row">
                                                                    @foreach ($group->children as $child)
                                                                    <div class="col-md-3 col-sm-6 mb-2">
                                                                        <div class="form-check">
                                                                            <input type="checkbox"
                                                                                id="childCheckbox{{ $child->id }}"
                                                                                name="permissions[children][]"
                                                                                value="{{ $child->id }}"
                                                                                class="form-check-input child-checkbox"
                                                                                data-group="{{ $group->id }}">
                                                                            <label for="childCheckbox{{ $child->id }}"
                                                                                class="form-check-label">
                                                                                {{ $child->display_name }}
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary" type="submit">{{ __('Create Role') }}</button>
                                    </div>
                                    <!-- End Product Card -->
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- End Dashboard Inner -->
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('js')

<script>
    $(document).ready(function() {
         // Group parent click: check/uncheck all children
    $('.group-checkbox').on('change', function() {
        var groupId = $(this).data('group');
        var checked = $(this).is(':checked');
        $('.child-checkbox[data-group="' + groupId + '"]').prop('checked', checked).trigger('change');
    });

    // Child click: if all children checked, check parent; else uncheck parent
    $('.child-checkbox').on('change', function() {
        var groupId = $(this).data('group');
        var $children = $('.child-checkbox[data-group="' + groupId + '"]');
        var $parent = $('.group-checkbox[data-group="' + groupId + '"]');

        if ($children.length === $children.filter(':checked').length) {
            $parent.prop('checked', true);
        } else {
            $parent.prop('checked', false);
        }
        updateMasterCheckbox();
    });

    // Master checkbox: check/uncheck all
    $('#masterCheckbox').on('change', function() {
        var checked = $(this).is(':checked');
        $('.group-checkbox, .child-checkbox').prop('checked', checked).trigger('change');
    });

    // Update master checkbox based on all group/child checkboxes
    function updateMasterCheckbox() {
        var all = $('.group-checkbox, .child-checkbox');
        var checked = all.length === all.filter(':checked').length;
        $('#masterCheckbox').prop('checked', checked);
    }

    // When group checkbox changes, update master
    $('.group-checkbox').on('change', function() {
        updateMasterCheckbox();
    });

    // On page load, sync parent/child/master states
    $('.group-checkbox').each(function() {
        var groupId = $(this).data('group');
        var $children = $('.child-checkbox[data-group="' + groupId + '"]');
        if ($children.length && $children.length === $children.filter(':checked').length) {
            $(this).prop('checked', true);
        }
    });
    updateMasterCheckbox();
    })
</script>

@endpush
