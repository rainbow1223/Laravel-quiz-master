@extends('layouts.app')

@section('content')
    <div id="main">

        <div id="content" class="full">
            <div class="post manage_users">
                <div class="content_header">
                    <div class="content_header_title" style="border-bottom: 0;">
                        <div style="float: left">
                            <h2>Result</h2>
                        </div>
                    </div>

                </div>


                <div class="content_body">


                    <a id="entries_container">
                        <table width="100%" cellspacing="0" cellpadding="0" border="0" id="entries_table">
                            <thead>
                            <tr>
                                <th class="me_number" scope="col">#</th>
                                <th scope="col">
                                    <div title="User Name">User Name</div>
                                </th>
                                <th scope="col">
                                    <div title="Result">Result</div>
                                </th>
                                <th scope="col">
                                    <div title="Score">Score</div>
                                </th>
                                <th scope="col">
                                    <div title="Date">Date</div>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($results as $result)
                            @php
                            $result->data = json_decode($result->result);
                            @endphp
                                <tr">
                                    <td class="me_number">{{$result->id}}</td>
                                    <td>
                                        {{$result->user->name}}
                                    </td>
                                    <td>
                                        <div>{{$result->data->result}}</div>
                                    </td>
                                    <td>
                                        <div>
                                           {{$result->data->exam_user_score}}
                                        </div>
                                    </td>
                                    <td class="active_col">
                                        {{$result->created_at}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div style="width: 100%; height: 20px;"></div>

                </div> <!-- /end of content_body -->

            </div><!-- /.post -->
        </div><!-- /#content -->


    </div>
@endsection
