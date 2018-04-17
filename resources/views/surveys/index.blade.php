<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <h3 class="page-title"
                style="margin: auto;">Vision Goal Survey
                (total {{$engagements->total()}})</h3>
        </div>
        <div class="col-md-8">
            <div class="form-inline pull-right" style="font-family:FontAwesome;" id="filter-selection">
                @if($manage)
                    <a href="javascript:void(0)" class="btn btn-success" id="build-engagement"><i
                                class="fa fa-cubes">&nbsp;
                            Build</i></a>
                    <i>&nbsp;</i>
                @endif
                <a href="#" type="button" class="btn btn-default reset-btn" title="Reset all condition"><i
                            class="fa fa-refresh" aria-hidden="true"></i></a>
                <select class="selectpicker show-tick" data-width="fit" id="client-filter"
                        data-live-search="true" title="&#xf06c; All Clients">
                    @foreach($clients as $client)
                        <option value="{{$client['id']}}"
                                data-content="<strong>{{$client['name']}}</strong>" {{Request('cid')==$client['id']?'selected':''}}></option>
                    @endforeach
                </select>
                @if(!$manage)
                    <select class="selectpicker show-tick" data-width="fit" id="leader-filter"
                            data-live-search="true" title="&#xf2be; Leader">
                        @foreach($leaders as $leader)
                            <option value="{{$leader->id}}" {{Request('lid')==$leader->id?'selected':''}}>{{$leader->fullname()}}</option>
                        @endforeach
                    </select>
                @endif
                <select class="selectpicker form-control" data-width="fit"
                        id="status-select"
                        data-live-search="true" title="&#xf024; Status">
                    {{--02/19/2018 Diego changed the order--}}
                    <option value="1" {{Request('status')=="1"?'selected':''}}>Active</option>
                    <option value="2" {{Request('status')=="2"?'selected':''}}>Closed</option>
                    <option value="0" {{Request('status')=="0"?'selected':''}}>Pending</option>

                </select>
                <input class="date-picker form-control" size=10 id="start-date-filter"
                       placeholder="&#xf073; Start after"
                       value="{{Request('start')}}"
                       type="text"/>
                <a href="javascript:void(0)" type="button" class="btn btn-info"
                   id="filter-button">Filter</a>
            </div>
        </div>
    </div>
    <hr>
    @foreach($engagements as $engagement)
        @if($loop->index%2==0)
            <div class="row">
                @endif
                <div class="col-md-6">
                    <div class="panel">
                        <div class="panel-heading engagement-table">
                            <h3 class="panel-title">Name: <strong>{{$engagement->name}}</strong>
                                @if($manage||$admin)
                                    <div class="pull-right">
                                        <a href="javascript:void(0)" class="eng-edit"
                                           data-id="{{$engagement->id}}"><i
                                                    class="fa fa-pencil-square-o"
                                                    aria-hidden="true"></i></a>
                                        <span>&nbsp;|&nbsp;</span>
                                        <a href="javascript:void(0)" class="eng-delete"
                                           data-del="{{!$engagement->isPending()&&$manage?'0':'1'}}"
                                           data-id="{{$engagement->id}}"><i
                                                    class="fa fa-trash-o" aria-hidden="true"></i></a>
                                    </div>
                                @endif
                            </h3>
                            <div class="panel-subtitle">Client:
                                <strong>{{$engagement->client->name}}</strong>
                                <span class="label label-info pull-right">Total Members: <strong>{{$engagement->arrangements->count()}}</strong></span>
                            </div>
                            {{--02/22/2018 Diego changed to content to be viewed differently by the role of viewer--}}

                            <table class="table table-striped table-bordered table-responsive">
                                <thead>
                                <tr>
                                    <th>Leader</th>
                                    <th>Started</th>
                                    @if($manage||$admin)
                                        <th>Biz Dev Share</th>@endif
                                    <th>Billed Type</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{$engagement->leader->fullname()}}</td>
                                    <td>{{(new DateTime($engagement->start_date))->format('m/d/Y')}}</td>
                                    @if($manage||$admin)
                                        <td>{{number_format($engagement->buz_dev_share*100,1).'%'}}</td>@endif
                                    <td>{{str_limit($engagement->clientBilledType(),11)}}</td>
                                    <td><i class="fa fa-flag {{$engagement->state()}}"
                                           aria-hidden="true"></i>{{$engagement->state()}}</td>
                                </tr>
                                </tbody>
                            </table>

                        </div>
                        @if(!$admin)
                            <div class="panel-body slim-scroll arrangement-table">
                                @php $hourly = $engagement->clientBilledType() == 'Hourly'; @endphp
                                <table class="table table-sm">
                                    <thead>
                                    <tr>
                                        <th>Consultant</th>
                                        <th>Position</th>
                                        @if($manage && $hourly)
                                            <th>Billing Rate</th>
                                            <th>Firm Share</th>
                                        @endif
                                        <th>Pay Rate</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($engagement->arrangements as $arrangement)
                                        <tr>
                                            <td>{{$arrangement->consultant->fullname()}}</td>
                                            <td> {{$arrangement->position->name}}</td>
                                            @if($manage && $hourly)
                                                <td>
                                                    @can('view',$arrangement)
                                                        ${{$hourly?number_format($arrangement->billing_rate,2):'-'}}
                                                    @endcan
                                                </td>
                                                <td>
                                                    @can('view',$arrangement)
                                                        {{$hourly? number_format($arrangement->firm_share*100,1).'%':'-'}}
                                                    @endcan
                                                </td>
                                            @endif
                                            <td>
                                                @can('view',$arrangement)
                                                    ${{number_format($hourly?$arrangement->billing_rate*(1-$arrangement->firm_share):$arrangement->pay_rate,2)}}
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
                @if($loop->index%2==1||$loop->last)
            </div>
        @endif
    @endforeach
</div>