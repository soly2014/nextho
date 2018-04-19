<form action="{{ route('activity-bulk-close-post', array(Auth::user()->id)) }}" method="post">
    <ul class="list-group no-margn nicescroll todo-list" style="height: 290px; overflow: hidden; outline: none; overflow-y:scroll;" id="OtherContainer">
        <?php 
            $priority = [
                "3" => "Normal",
                "5" => "Lowest",
                "4" => "Low",
                "2" => "High",
                "1" => "Highest"
            ];
            $today = date('Y-m-d');
        ?>

        @foreach($other_activities as $activity)
        <li class="list-group-item">
            <span class="checkbox custom-checkbox custom-checkbox-teal">
                <!--<input id="{{ 'activity'.$activity->id }}" name="activities[]" value="{{ $activity->id }}" type="checkbox">-->
                <label for="{{ 'activity'.$activity->id }}">&nbsp;&nbsp;
                    @if($activity->activitable_type == 'App\Models\Client')
                        <a href="{{ route('activity-view-single', array($activity->id)) }}" title="{{ 'Due Date '.$activity->due_date }}">{{ $activity->activityType->label }}</a> - 
                            @if($activity->activitable->is_customer)
                                <a href="{{ route('customers-view-single', array($activity->activitable->id)) }}">{{ $activity->activitable->name }}</a>
                            @else
                                <a href="{{ route('leads-view-single', array($activity->activitable->id)) }}">{{ $activity->activitable->name }}</a>
                            @endif
                        -   <span class="ml5 label label-success">{{ \App\Models\ActivityType::find($activity->type)->label }}</span>
                        {{ date('h:i a', strtotime($activity->due_date)) }}
                        @if($activity->due_date < $today)
                            <span class="ml5 label label-danger" title="{{ 'Due Date - '.$activity->due_date }}">Past Due</span>
                        @else
                            <span class="label label-primary" title="{{ 'Due Date - '.$activity->due_date }}"></span>
                        @endif
                    @elseif($activity->activitable_type == 'Campaign')
                    
                    @endif
                </label>
            </span>
        </li>
        @endforeach
    </ul>
</form>