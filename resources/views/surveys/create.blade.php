
    <div class="modal fade" id="surveyModal" tabindex="-1" role="dialog"
         aria-labelledby="surveyModalLabel" data-backdrop="static" data-keyboard="false"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    {{--02/19/2018 Diego changed the modal title--}}
                    <h3 class="modal-title" id="surveyModalLabel"><span>Set Up a New Survey</span>
                        <a type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </a>
                    </h3>
                </div>

                <form action="" id="survey-form">
                    <div class="modal-body">
                        <div class="panel-body">

                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-users"></i>&nbsp; Client and Engagement:</span>
                                    @component('components.engagement_selector',['dom_id'=>"client-engagement",'clientIds'=>$clientIds])
                                    @endcomponent

                                    <span class="input-group-addon"><i
                                    class="fa fa-calendar"></i>&nbsp; Start Date</span>
                                    <input class="date-picker form-control" id="start-date" name="start_date"
                                    placeholder="mm/dd/yyyy" type="text" required/>
                                </div>
                            <br>
                        </div>

                        <a id="add-team-member" href="javascript:void(0)" class="label label-info"><i
                                    class="fa fa-user-plus" aria-hidden="true"></i>Add participants
                        </a>

                        <div class="panel-footer" id="member-roll">
                            <table class="table table-responsive">
                                <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Position</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody id="members-table">
                                <tr>
                                    <td>
                                        <select class="selectpicker pid" data-width="200px"
                                                data-dropup-auto="false" required>
                                            @foreach(\newlifecfo\Models\SurveyEmplcategory::all() as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select class="selectpicker pid" data-width="200px"
                                                data-dropup-auto="false" required>
                                            @foreach(\newlifecfo\Models\SurveyPosition::all() as $position)
                                                <option value="{{$position->id}}">{{$position->name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input id="first_name" type="text" class="form-control" name="first_name"
                                               value="{{ old('first_name') }}" required autofocus>
                                    </td>
                                    <td>
                                        <input id="last_name" type="text" class="form-control" name="last_name"
                                               value="{{ old('last_name') }}" required autofocus>
                                    </td>
                                    <td>
                                        <input id="email" type="email" class="form-control" name="email"
                                               value="{{ old('email') }}" required>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);"><i class="fa fa-minus-circle" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>



                    {{--</div>--}}
                    {{--@if($admin)--}}
                        {{--<div class="row"--}}
                             {{--style="width:95%;border-style: dotted;color:#33c0ff;padding: .2em .2em .2em .2em;margin-left: 1.4em">--}}
                            {{--<div class="col-md-4">--}}
                                {{--<label class="fancy-radio">--}}
                                    {{--<input name="status" value="0" type="radio">--}}
                                    {{--<span><i></i><p class="label label-warning">Pending</p></span>--}}
                                {{--</label>--}}
                            {{--</div>--}}
                            {{--<div class="col-md-4">--}}
                                {{--<label class="fancy-radio">--}}
                                    {{--<input name="status" value="1" type="radio">--}}
                                    {{--<span><i></i><p class="label label-success">Active</p></span>--}}
                                {{--</label>--}}
                            {{--</div>--}}
                            {{--<div class="col-md-4">--}}
                                {{--<label class="fancy-radio">--}}
                                    {{--<input name="status" value="2" type="radio">--}}
                                    {{--<span><i></i><p class="label label-default">Closed</p></span>--}}
                                {{--</label>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--@endif--}}
                    {{--<div class="modal-footer">--}}
                        {{--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
                        {{--<button class="btn btn-primary" id="submit-modal" type="submit"--}}
                                {{--data-loading-text="<i class='fa fa-spinner fa-spin'></i>Processing">Build--}}
                        {{--</button>--}}
                    {{--</div>--}}
                {{--</form>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
