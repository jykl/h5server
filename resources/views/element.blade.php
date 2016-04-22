@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-sm-offset-2 col-sm-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                New element
            </div>

            <div class="panel-body">
                <!-- Display Validation Errors -->
                @include('common.errors')

                <!-- New Task Form -->
                <form action="publishElement" method="POST" class="form-horizontal" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <!-- Task Name -->
                    <div class="form-group">
                        <label for="task-name" class="col-sm-3 control-label">Element</label>

                        <div class="col-sm-3">
                            <input type="text" name="name" id="task-name" class="form-control">
                        </div>
                        <div class="col-sm-3">
                            <input type="text" name="parentId" id="task-name" class="form-control">
                        </div>
                        <!--选择上传文件-->
                        <div class="col-sm-3">
                            <input type="file" name='elementFile'>
                        </div>
                    </div>

                    <!-- Add Task Button -->
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">
                            <button type="submit" class="btn btn-default">
                                <i class="fa fa-btn fa-plus"></i>Add Element
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>

        <!-- Current Tasks -->
        @if (count($elements) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                Current Elements
            </div>

            <div class="panel-body">
                <table class="table table-striped task-table">
                    <thead>
                    <th>element</th>
                    <th>&nbsp;</th>
                    </thead>
                    <tbody>
                    @foreach ($elements as $element)
                    <tr>
                        <td class="table-text">
                            <div>{{ $element->name }}</div>
                        </td>

                        <!-- Task Delete Button -->
                        <td>
                            <form action="element/{{ $element->id }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                <button type="submit" id="delete-task-{{ $element->id }}" class="btn btn-danger">
                                    <i class="fa fa-btn fa-trash"></i>Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
