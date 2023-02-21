<div>
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            @if(count($notifications) > 0)
            <span class="badge badge-warning navbar-badge">{{ count($notifications) }}</span>
            @endif
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            @if(count($notifications) > 0)
            <span class="dropdown-item dropdown-header">{{ count($notifications) }} Notifications</span>
            @foreach($notifications as $notification)
{{--            <div class="dropdown-divider"></div>--}}
{{--            <a href="#" class="dropdown-item">--}}
{{--                <i class="fas fa-envelope mr-2"></i> 4 new messages--}}
{{--                <span class="float-right text-muted text-sm">3 mins</span>--}}
{{--            </a>--}}
            <div class="dropdown-divider"></div>
            <a href="" wire:click.prevent="marked('{{ $notification['id'] }}')"   class="dropdown-item">
                @if($notification['type'] == 'App\Notifications\UserNotification')
                    <i class="fas fa-user mr-2"></i> {{ $notification['data']['name'] }} <i>зарегистрирован</i>
                @endif
                @if($notification['type'] == 'App\Notifications\debtor\DebtorNotification')
                    <i class="fas fa-users mr-2" style="color: blue"></i><i style="color: green">{{ ($notification['data']['debtor_name']) }} было создано</i>
                @endif
                @if($notification['type'] == 'App\Notifications\debtor\DeleteDebtorNotification')
                    <i class="fas fa-users mr-2" style="color: red"></i><i style="color: red">{{ ($notification['data']['debtor_name']) }} было удалено</i>
                @endif
                <span class="float-right text-muted text-sm">{{ \Carbon\Carbon::parse($notification['created_at'])->diffForHumans() }}</span>
            </a>
            @endforeach
{{--            <div class="dropdown-divider"></div>--}}
{{--            <a href="#" class="dropdown-item">--}}
{{--                <i class="fas fa-file mr-2"></i> 3 new reports--}}
{{--                <span class="float-right text-muted text-sm">2 days</span>--}}
{{--            </a>--}}
            <div class="dropdown-divider"></div>
            <a href="{{ route('notifications') }}" class="dropdown-item dropdown-footer">See All Notifications</a>
            @else
                <span class="dropdown-item dropdown-header">No notifications</span>
            @endif
        </div>

    </li>
</div>
