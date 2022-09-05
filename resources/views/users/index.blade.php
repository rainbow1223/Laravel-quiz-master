@extends('layouts.app')

@section('content')
    <div id="main">

        <div id="content" class="full">
            <div class="post manage_users">
                <div class="content_header">
                    <div class="content_header_title">
                        <div style="float: left">
                            <h2>User Management</h2>
                            <p>Create, edit and manage users permissions</p>
                        </div>

                        <div style="float: right;margin-right: 5px">
                            <a href="{{ route('users.create') }}" id="button_add_user" class="bb_button bb_small bb_green">
                                <i class="fas fa-plus" style="font-size: 12px;padding-right: 5px;"></i>Create New User!
                            </a>
                        </div>
                        <div style="clear: both; height: 1px"></div>
                    </div>

                </div>


                <div class="content_body">

                    <div id="entries_actions" class="gradient_red">
                        <ul>
                            <li>
                                <a id="user_delete" href="#"><i class="fas fa-trash" style="font-size: 16px;display: block;"></i>Delete</a>
                            </li>
                            <li>
                                <div class="vline_separator" style="height: 35px;margin-top:5px"></div>
                            </li>
                            <li>
                                <a id="user_suspend" href="#"><i class="fas fa-exclamation-triangle" style="font-size: 16px;display: block;"></i>Suspend</a>
                            </li>
                        </ul>
                        <img id="entries_actions_arrow" src="images/icons/29.png"
                             style="position: absolute;left:5px;top:100%">
                    </div>

                    {{--                <div id="entries_options" class="gradient_blue" data-formid="">--}}
                    {{--                    <ul>--}}
                    {{--                        <li>--}}
                    {{--                            <a id="entry_filter" href="#"><span class="icon-binoculars"></span>Filter Users</a>--}}
                    {{--                        </li>--}}
                    {{--                    </ul>--}}
                    {{--                </div>--}}


                    <div style="clear: both"></div>

                    {{--                <div id="filter_pane" style="display: none" class="gradient_blue">--}}

                    {{--                    <h6>Display users that match--}}
                    {{--                        <select style="margin-left: 5px;margin-right: 5px" name="filter_all_any" id="filter_all_any"--}}
                    {{--                                class="element select">--}}
                    {{--                            <option value="all">all</option>--}}
                    {{--                            <option value="any">any</option>--}}
                    {{--                        </select>--}}
                    {{--                        of the following conditions:--}}
                    {{--                    </h6>--}}

                    {{--                    <ul>--}}


                    {{--                        <li id="li_1" class="filter_settings">--}}
                    {{--                            <select name="filterfield_1" id="filterfield_1" class="element select condition_fieldname"--}}
                    {{--                                    style="width: 260px">--}}
                    {{--                                <option value="user_id">User ID#</option>--}}
                    {{--                                <option value="user_fullname">Name</option>--}}
                    {{--                                <option value="user_email">Email</option>--}}
                    {{--                                <option value="priv_administer">Admin Privileges</option>--}}
                    {{--                                <option value="status">Status</option>--}}
                    {{--                            </select>--}}
                    {{--                            <select name="conditiontext_1" id="conditiontext_1" class="element select condition_text"--}}
                    {{--                                    style="width: 120px;display:none">--}}
                    {{--                                <option value="is">Is</option>--}}
                    {{--                                <option value="is_not">Is Not</option>--}}
                    {{--                                <option value="begins_with">Begins with</option>--}}
                    {{--                                <option value="ends_with">Ends with</option>--}}
                    {{--                                <option value="contains">Contains</option>--}}
                    {{--                                <option value="not_contain">Does not contain</option>--}}
                    {{--                            </select>--}}
                    {{--                            <select name="conditionnumber_1" id="conditionnumber_1"--}}
                    {{--                                    class="element select condition_number" style="width: 120px;">--}}
                    {{--                                <option value="is">Is</option>--}}
                    {{--                                <option value="less_than">Less than</option>--}}
                    {{--                                <option value="greater_than">Greater than</option>--}}
                    {{--                            </select>--}}
                    {{--                            <select name="conditionadmin_1" id="conditionadmin_1" class="element select condition_admin"--}}
                    {{--                                    style="width: 180px;display:none">--}}
                    {{--                                <option value="is_admin">Is Administrator</option>--}}
                    {{--                                <option value="is_not_admin">Is not Administrator</option>--}}
                    {{--                            </select>--}}
                    {{--                            <select name="conditionstatus_1" id="conditionstatus_1"--}}
                    {{--                                    class="element select condition_status" style="width: 180px;display:none">--}}
                    {{--                                <option value="is_active">Is Active</option>--}}
                    {{--                                <option value="is_suspended">Is Suspended</option>--}}
                    {{--                            </select>--}}

                    {{--                            <input type="text" class="element text filter_keyword" value="" id="filterkeyword_1"--}}
                    {{--                                   style="">--}}

                    {{--                            <a href="#" id="deletefilter_1" class="filter_delete_a"><img--}}
                    {{--                                    src="images/icons/51_blue_32.png" width="16" height="16"></a>--}}

                    {{--                        </li>--}}


                    {{--                        <li id="li_filter_add" class="filter_add">--}}
                    {{--                            <a href="#" id="filter_add_a"><img src="images/icons/49_blue_32.png" width="16" height="16"></a>--}}
                    {{--                        </li>--}}
                    {{--                    </ul>--}}
                    {{--                    <div id="filter_pane_apply">--}}
                    {{--                        <input type="button" id="me_filter_pane_submit" value="Apply Filter"--}}
                    {{--                               class="bb_button bb_mini bb_blue"> <span style="margin-left: 5px"--}}
                    {{--                                                                        id="cancel_filter_pane_span">or <a href="#"--}}
                    {{--                                                                                                           id="filter_pane_cancel">Cancel</a></span>--}}
                    {{--                    </div>--}}
                    {{--                    <img style="position: absolute;right:35px;top:-12px" src="images/icons/29_blue.png">--}}
                    {{--                </div>--}}

                    <a id="entries_container">
                        <table width="100%" cellspacing="0" cellpadding="0" border="0" id="entries_table">
                            <thead>
                            <tr>
                                <th class="me_action" scope="col"><input type="checkbox" value="1" name="col_select"
                                                                         id="col_select"></th>
                                <th class="me_number" scope="col">#</th>
                                <th scope="col">
                                    <div title="Name">Name</div>
                                </th>
                                <th scope="col">
                                    <div title="Email">Email</div>
                                </th>
                                <th scope="col">
                                    <div title="Admin Privileges">Admin Privileges</div>
                                </th>
                                <th scope="col">
                                    <div title="Status">Status</div>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($users as $user)
                                @if (auth()->user()->id != $user->id)
                                    <tr id="row_{{ $user->id }}">
                                        <td class="me_action"><input class="row_checkbox" type="checkbox"
                                                                     id="checkbox_{{ $user->id }}"
                                                                     name="checkbox_{{ $user->id }}"
                                                                     value="{{ $user->id }}"></td>
                                        <td class="me_number">{{$user->id}}</td>
                                        <td>
                                            <a href="{{ url('/users') }}/{{ $user->id }}/edit">{{$user->name}}</a>
                                        </td>
                                        <td>
                                            <div>{{$user->email}}</div>
                                        </td>
                                        <td>
                                            <div>
                                                @if($user->role)
                                                    Administrator
                                                @else
                                                    Student
                                                @endif
                                            </div>
                                        </td>
                                        <td class="active_col">
                                            @if($user->active)
                                                Active
                                            @else
                                                Suspend
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div style="width: 100%; height: 20px;"></div>


                    <!--                <div id="me_sort_option">-->
                    <!--                    <label class="description" for="me_sort_by">Sort By ⇢ </label>-->
                    <!--                    <select class="element select" id="me_sort_by" name="me_sort_by">-->
                    <!--                        <optgroup label="Ascending">-->
                    <!--                            <option value="user_id-asc">User ID</option>-->
                    <!--                            <option value="user_fullname-asc">Name</option>-->
                    <!--                            <option value="user_email-asc">Email</option>-->
                    <!--                            <option value="priv_administer-asc">Admin Privileges</option>-->
                    <!--                            <option value="status-asc">Status</option>-->
                    <!--                        </optgroup>-->
                    <!--                        <optgroup label="Descending">-->
                    <!--                            <option selected="selected" value="user_id-desc">User ID</option>-->
                    <!--                            <option value="user_fullname-desc">Name</option>-->
                    <!--                            <option value="user_email-desc">Email</option>-->
                    <!--                            <option value="priv_administer-desc">Admin Privileges</option>-->
                    <!--                            <option value="status-desc">Status</option>-->
                    <!--                        </optgroup>-->
                    <!--                    </select>-->
                    <!--                </div>-->

                </div> <!-- /end of content_body -->

            </div><!-- /.post -->
        </div><!-- /#content -->

        <div id="dialog-warning" title="Error Title" class="buttons" style="display: none">
            <span class="icon-bubble-notification"></span>
            <p id="dialog-warning-msg">
                Error
            </p>
        </div>
        <div id="dialog-confirm-user-delete" title="Are you sure you want to delete selected users?" class="buttons"
             style="display: none">
            <span class="icon-bubble-notification"></span>
            <p id="dialog-confirm-user-delete-msg">
                This action cannot be undone.<br>
                <strong id="dialog-confirm-user-delete-info">The user will be deleted permanently and no longer has
                    access
                    to MachForm.</strong><br><br>

            </p>
        </div>
        <div id="dialog-confirm-user-suspend" title="Are you sure you want to suspend selected users?" class="buttons"
             style="display: none">
            <span class="icon-bubble-notification"></span>
            <p id="dialog-confirm-user-suspend-msg">

                <strong id="dialog-confirm-user-suspend-info">The user will be suspended and no longer has access to
                    MachForm.</strong><br><br>

            </p>
        </div>

        <div class="clear"></div>

    </div>
    <script src="{{ asset('js/user_crud.js') }}"></script>
@endsection
